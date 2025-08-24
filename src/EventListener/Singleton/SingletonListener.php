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

namespace Rami\EntityKitBundle\EventListener\Singleton;

use Doctrine\ORM\Event\PrePersistEventArgs;
use Doctrine\Persistence\ManagerRegistry;
use JetBrains\PhpStorm\NoReturn;
use Rami\EntityKitBundle\Common\Attributes\Singleton;
use Rami\EntityKitBundle\Exceptions\EntityCountException;

class SingletonListener
{

    public function __construct(private ManagerRegistry $managerRegistry)
    {
    }

    /**
     * @throws EntityCountException
     */
    #[NoReturn] public function prePersist(PrePersistEventArgs $args): void
    {
        $entity = $args->getObject();

        $reflection = new \ReflectionObject($entity);
        $attributes = $reflection->getAttributes(Singleton::class);

        if (count($attributes) === 0) {
            return;
        }

        $existingEntity = $this->managerRegistry->getManager()->getRepository(get_class($entity))->findOneBy([]);

        if (null !== $existingEntity) {
            throw new EntityCountException();
        }
    }
}