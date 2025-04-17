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

namespace Rami\EntityKitBundle\EventListener\Authored;

use Doctrine\ORM\Event\PrePersistEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Rami\EntityKitBundle\Common\Interfaces\Authored\AuthoredInterface;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Security\Core\User\UserInterface;

readonly class AuthoredListener
{
    public function __construct(
        private Security $security,
    ) {}
    public function prePersist(PrePersistEventArgs $args): void
    {
        $entity = $args->getObject();

        if (!$entity instanceof AuthoredInterface) {
            return;
        }

        if (null === $this->getCurrentUserIdentifier()) {
            return;
        }

        $entity->setCreatedBy($this->getCurrentUserIdentifier());
    }

    public function preUpdate(PreUpdateEventArgs $args): void
    {
        $entity = $args->getObject();

        if (!$entity instanceof AuthoredInterface) {
            return;
        }

        if (null === $this->getCurrentUserIdentifier()) {
            return;
        }

        $entity->setUpdatedBy($this->getCurrentUserIdentifier());
    }

    private function getCurrentUserIdentifier(): string|null
    {
        $user = $this->security->getUser();

        if (!$user instanceof UserInterface) {
            return null;
        }

        return $user->getUserIdentifier();
    }
}