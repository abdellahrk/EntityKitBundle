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

namespace Rami\EntityKitBundle\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;

trait TranslatableTrait
{
    #[ORM\Column(type: 'string', length: 10, nullable: true)]
    public ?string $locale = null;

    #[ORM\Column(type: Types::JSON, nullable: false, options: ['default' => '{}'])]
    public array $translations = [];

    #[ORM\Column(type: Types::JSON, nullable: true)]
    public ?array $availableLocales = null;

    public function getLocale(): string
    {
        return $this->locale;
    }

    public function setLocale(string $locale): static
    {
        $this->locale = $locale;
        return $this;
    }

    public function getTranslations(): array
    {
        return $this->translations;
    }

    public function setTranslations(array $translations): static
    {
        $this->translations = $translations;
        return $this;
    }

    public function getAvailableLocales(): array
    {
        return $this->availableLocales;
    }

    public function setAvailableLocales(array $availableLocales): static
    {
        $this->availableLocales = $availableLocales;
        return $this;
    }
}