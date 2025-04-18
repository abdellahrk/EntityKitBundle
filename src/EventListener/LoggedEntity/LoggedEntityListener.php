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

namespace Rami\EntityKitBundle\EventListener\Logged;

use Doctrine\ORM\Event\PostPersistEventArgs;
use Psr\Log\LoggerInterface;
use Rami\EntityKitBundle\Common\Attributes\LoggedEntity;
use Rami\EntityKitBundle\Common\Attributes\LoggedProperty;

final readonly class LoggedListener
{
    public function __construct(
        private LoggerInterface $logger,
    ) {}

    public function postPersist(PostPersistEventArgs $event): void
    {
        $entity = $event->getObject();
        $relectionClass = new \ReflectionClass($entity);

        $loggedAttributes = $relectionClass->getAttributes(LoggedEntity::class);

        if (!$loggedAttributes) {
            return;
        }

        $entityAttribute = $loggedAttributes[0]->newInstance();

        $changes = $event->getObjectManager()->getUnitOfWork()->getEntityChangeSet($entity);

        foreach ($changes as $change => [$old, $new]) {

        }
    }
}