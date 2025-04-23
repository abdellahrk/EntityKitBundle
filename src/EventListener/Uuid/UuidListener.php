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

namespace Rami\EntityKitBundle\EventListener\Uuid;

use Doctrine\ORM\Event\PrePersistEventArgs;
use Rami\EntityKitBundle\Common\Interfaces\Uuid\UuidInterface;
use Symfony\Component\Uid\Uuid;

class UuidListener
{
    public function prePersist(PrePersistEventArgs $event): void
    {
        $entity = $event->getObject();
        
        if (!$entity instanceof UuidInterface) {
            return;
        }
        
        $entity->setUuid(Uuid::v4());
    }
}