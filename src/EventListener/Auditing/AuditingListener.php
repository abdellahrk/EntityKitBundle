<?php

namespace Rami\EntityKitBundle\EventListener\Auditing;

use Doctrine\ORM\Event\PrePersistEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Rami\EntityKitBundle\Contract\Auditing\AuditingInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\User\UserInterface;

final class AuditingListener
{
    public function __construct(
        private ?TokenStorageInterface $tokenStorage = null,
    ) {
    }

    public function prePersist(PrePersistEventArgs $prePersist): void
    {
        $entity = $prePersist->getObject();

        if (!$entity instanceof AuditingInterface) {
            return;
        }

        $now = new \DateTimeImmutable();

        $entity->setCreatedAt($now);
        $entity->setUpdatedAt($now);

        if (null === $this->getCurrentUserIdentifier()) {
            return;
        }

        $entity->setCreatedBy($this->getCurrentUserIdentifier());
    }

    public function preUpdate(PreUpdateEventArgs $args): void
    {

        $entity = $args->getObject();
        if (!($entity instanceof AuditingInterface)) {
            return;
        }

        $now = new \DateTimeImmutable();

        $entity->setUpdatedAt($now);

        if (null === $this->getCurrentUserIdentifier()) {
            return;
        }

        $entity->setUpdatedBy($this->getCurrentUserIdentifier());
    }

    private function getCurrentUserIdentifier(): ?string
    {
        if (null === $this->tokenStorage) {
            return null;
        }

        $user = $this->tokenStorage?->getToken()?->getUser();

        if (!$user instanceof UserInterface) {
            return null;
        }

        return $user->getUserIdentifier();
    }
}
