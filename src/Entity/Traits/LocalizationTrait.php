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
use Rami\EntityKitBundle\Common\Attributes\Localization;
use Rami\EntityKitBundle\Common\Attributes\Localize;
use ReflectionClass;

trait LocalizationTrait
{
    #[ORM\Column(type: "string", length: 10, nullable: true)]
    public ?string $locale = null;

    #[ORM\Column(type: Types::JSON)]
    public ?array $localizations = [];

    #[ORM\Column(type: Types::JSON, nullable: true)]
    public ?array $availableLocales = null;

    public function getLocale(): ?string
    {
        $reflection = new ReflectionClass($this);
        $localization = $reflection->getAttributes(Localization::class)[0]?->newInstance();
        return $this->locale ?? $localization->defaultLocale;
    }

    public function setLocale(string $locale): static
    {
        $this->syncCurrentValuesToStorage();

        $this->locale = $locale;

        $data = $this->localizations[$locale] ?? [];
        $reflection = new ReflectionClass($this);

        foreach ($reflection->getProperties() as $prop) {
            if ($prop->getAttributes(Localize::class)) {
                $name = $prop->getName();

                $value = $data[$name] ?? null;
                $prop->setValue($this, $value);
            }
        }

        return $this;
    }

    public function getLocalizations(): array
    {
        return $this->localizations ?? [];
    }

    /**
     * @param array $localizations
     * @return static
     */
    public function setLocalizations(array $localizations): static
    {
        $this->localizations = $localizations;
        return $this;
    }

    /**
     * @@return array $availableLocales
     */
    public function getAvailableLocales(): array
    {
        return $this->availableLocales;
    }

    /**
     * @param array $availableLocales
     * @return static
     */
    public function setAvailableLocales(array $availableLocales): static
    {
        $this->availableLocales = $availableLocales;
        return $this;
    }

    public function getLocalizedField(string $field, string $locale): ?string
    {
        return $this->localizations[$locale][$field] ?? null;
    }

    private function syncCurrentValuesToStorage(): void
    {
        if (null === $this->locale) {
            return;
        }

        $reflection = new ReflectionClass($this);
        $localizations = $this->getLocalizations();

        foreach ($reflection->getProperties() as $prop) {
            $attribute = $prop->getAttributes(Localize::class)[0] ?? null;

            if ($attribute) {
                $name = $prop->getName();
                $value = $prop->getValue($this);
                $localizations[$this->locale][$name] = $value;
            }
        }

        $this->setLocalizations($localizations);
    }
}
