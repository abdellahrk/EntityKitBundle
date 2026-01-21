<?php
/*
 * Copyright (c) 2025.
 *
 * This file is part of the Entity Kit Bundle project
 * @author Abdellah Ramadan <ramadanabdel24@gmail.com>
 *
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed with this source code.
 */

namespace Rami\EntityKitBundle\Repository\Traits;

use Doctrine\ORM\Query;
use Doctrine\ORM\Tools\Pagination\Paginator;

trait EntityPaginationTrait
{
    /**
     * @param Query $query
     * @param int $page
     * @param int $nbPerPage
     * @param array|null $options ['useOutputWalkers' => bool, 'fetchJoinCollection' => bool]
     * @return array
     */
    public function paginateResult(Query $query, int $page = 1, int $nbPerPage = 15, ?array $options = []): array
    {
        $paginator = new Paginator($query);

        if (array_key_exists('fetchJoinCollection', $options) && is_bool($options['fetchJoinCollection'])) {
            $paginator = new Paginator($query, $options['fetchJoinCollection']);
        }
        
        if (array_key_exists('useOutputWalkers', $options) && is_bool($options['useOutputWalkers'])) {
            $paginator->setUseOutputWalkers($options['useOutputWalkers']);
        }

        $results = $paginator
            ->getQuery()
            ->setFirstResult($nbPerPage * ($page - 1))
            ->setMaxResults($nbPerPage)
            ->getResult();

        return [
            "total_items" => $paginator->count(),
            "data" => $results,
            "current_page" => $page,
            "pages" => (int)ceil($paginator->count()/$nbPerPage),
            "has_previous_page" => $page - 1 !== 0,
            "has_next_page" => !($page == ceil($paginator->count() / $nbPerPage)),
            "items_per_page" => $nbPerPage,
        ];
    }
}