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

namespace Rami\EntityKitBundle\EventListener\IpTagged;

use Doctrine\ORM\Event\PrePersistEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Rami\EntityKitBundle\Common\Interfaces\IpTagged\IpTaggedInterface;
use Symfony\Component\HttpFoundation\RequestStack;

readonly class IpTaggedListener
{
    public function __construct(
        private RequestStack $requestStack,
    ) {

    }
    public function prePersist(PrePersistEventArgs $args): void
    {
        $entity = $args->getObject();

        if (!$entity instanceof IpTaggedInterface) {
            return;
        }

        $request = $this->requestStack->getCurrentRequest();

        $entity->setCreatedFromIp($request->getClientIp());
    }

    public function preUpdate(PreUpdateEventArgs $args): void
    {
        $entity = $args->getObject();

        if (!$entity instanceof IpTaggedInterface) {
            return;
        }

        $request = $this->requestStack->getCurrentRequest();

        $entity->setUpdatedFromIp($request->getClientIp());
    }
}