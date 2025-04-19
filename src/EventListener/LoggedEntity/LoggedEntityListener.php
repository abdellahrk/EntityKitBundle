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

namespace Rami\EntityKitBundle\EventListener\LoggedEntity;

use Doctrine\ORM\Event\PostPersistEventArgs;
use Psr\Log\LoggerInterface;
use Rami\EntityKitBundle\Common\Attributes\LoggedEntity;

final readonly class LoggedEntityListener
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

        foreach ($changes as $field => [$old, $new]) {
            $this->logger->notice(sprintf('%s of %s changed from %s to %s', $field, get_class($entity), $old, $new));
        }
    }
}