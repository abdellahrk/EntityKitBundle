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

namespace Rami\EntityKitBundle\EventListener\Translatable;

use Doctrine\ORM\Event\PrePersistEventArgs;
use Rami\EntityKitBundle\Entity\Traits\TranslatableTrait;

class TranslationListener
{
    public function persistTranslations(PrePersistEventArgs $eventArgs): void
    {
        $entity = $eventArgs->getObject();

        if (!$this->entityUsesTranslation($entity)) {
            return;
        }


    }

    public function entityUsesTranslation(object $entity): bool
    {
        $traits = class_uses($entity);

        if (false === $traits) {
            return false;
        }

        return in_array(TranslatableTrait::class, $traits, true);
    }
}