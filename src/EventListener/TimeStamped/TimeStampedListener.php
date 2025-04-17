<?php

namespace Rami\EntityKitBundle\EventListener\TimeStamped;

use Doctrine\ORM\Event\PrePersistEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Rami\EntityKitBundle\Common\Interfaces\TimeStamped\TimeStampedInterface;
use Symfony\Component\PropertyAccess\PropertyAccess;

readonly class TimeStampedListener
{
    public function preUpdate(PreUpdateEventArgs $args): void
    {
        $entity = $args->getObject();
        $propertyAccessor = PropertyAccess::createPropertyAccessor();

        if (!($entity instanceof TimeStampedInterface)) {
            return;
        }

        if (!$propertyAccessor->isReadable($entity, 'updated_at')) {
            return;
        }

        $entity->setUpdatedAt(new \DateTimeImmutable());
    }

    public function prePersist(PrePersistEventArgs $args): void
    {
        $propertyAccessor = PropertyAccess::createPropertyAccessor();

        $entity = $args->getObject();
        if (!($entity instanceof TimeStampedInterface)) {
            return;
        }

        if (!$propertyAccessor->isReadable($entity, 'updated_at') || !$propertyAccessor->isReadable($entity, 'created_at')) {
            return;
        }

        $now = new \DateTimeImmutable();

        $entity->setCreatedAt($now);
        $entity->setUpdatedAt($now);
    }
}