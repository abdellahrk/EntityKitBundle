<?php

/*
 * Copyright (c) 2026.
 *
 * This file is part of the Entity Kit Bundle project
 * @author Abdellah Ramadan <ramadanabdel24@gmail.com>
 *
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed with this source code.
 */

namespace Rami\EntityKitBundle\EventListener\Localization;

use Doctrine\ORM\Event\OnFlushEventArgs;
use Rami\EntityKitBundle\Common\Attributes\Localization;
use Rami\EntityKitBundle\Common\Attributes\Localize;
use ReflectionClass;

class LocalizedEntityListener
{
    public function onFlush(OnFlushEventArgs $event): void
    {
        $entityManager = $event->getObjectManager();
        $unitOfWork = $entityManager->getUnitOfWork();

        $entities = array_merge(
            $unitOfWork->getScheduledEntityInsertions(),
            $unitOfWork->getScheduledEntityUpdates(),
        );

        foreach ($entities as $entity) {
            $reflection = new ReflectionClass($entity);
            $classAttribute = $reflection->getAttributes(Localization::class)[0] ?? null;

            if (!$classAttribute) {
                continue;
            }

            $localizationInstance = $classAttribute->newInstance();

            $this->processEntityTranslation(
                $entity,
                $reflection,
                $localizationInstance->locales,
                $localizationInstance,
            );

            $unitOfWork->recomputeSingleEntityChangeSet(
                $entityManager->getClassMetadata(get_class($entity)),
                $entity,
            );
        }
    }

    private function processEntityTranslation(
        object $entity,
        ReflectionClass $reflection,
        array $acceptedLocales,
        Localization $localizationInstance,
    ): void {
        $currentLocale = $entity->getLocale() ?? $localizationInstance->defaultLocale;

        if (
            !in_array($currentLocale, $acceptedLocales) &&
            $currentLocale !== $localizationInstance->defaultLocale
        ) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Locale %s not allowed. Activate it on %s",
                    $currentLocale,
                    get_class($entity),
                ),
            );
        }
        if (null === $entity->getLocale()) {
            $entity->setLocale($localizationInstance->defaultLocale);
        }

        $allData = $entity->getLocalizations();

        foreach ($reflection->getProperties() as $prop) {
            if ($prop->getAttributes(Localize::class)) {
                $propName = $prop->getName();
                $allData[$currentLocale][$propName] = $prop->getValue($entity);
            }
        }

        $entity->setLocalizations($allData);
        $entity->setAvailableLocales($acceptedLocales);

        $defaultLocale = $localizationInstance->defaultLocale;
        $currentLocale = $entity->getLocale();

        if ($defaultLocale !== $currentLocale) {
            foreach ($reflection->getProperties() as $property) {
                if ($property->getAttributes(Localize::class)) {
                    $name = $property->getName();
                    if (null !== $name) {
                        $defaultValue = $allData[$defaultLocale][$name] ?? null;
                        $property->setValue($entity, $defaultValue);
                    }
                }
            }
        }
    }
}
