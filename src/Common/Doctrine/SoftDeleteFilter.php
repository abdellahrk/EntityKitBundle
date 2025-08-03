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

namespace Rami\EntityKitBundle\Common\Doctrine;

use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\Query\Filter\SQLFilter;
use Rami\EntityKitBundle\Entity\Traits\SoftDeleteTrait;

class SoftDeleteFilter extends SQLFilter
{

    /**
     * @inheritDoc
     */
    public function addFilterConstraint(ClassMetadata $targetEntity, string $targetTableAlias): string
    {
        if (\in_array(SoftDeleteTrait::class, $targetEntity->reflClass->getTraits())) {
            return '';
        }

        if (!$targetEntity->reflClass->getTraits()[SoftDeleteTrait::class]) {
            return '';
        }

        return $targetTableAlias . '.deleted_at IS NULL';
    }
}