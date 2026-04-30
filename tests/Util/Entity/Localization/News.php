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

namespace Rami\EntityKitBundle\Tests\Util\Entity\Localization;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Rami\EntityKitBundle\Common\Attributes\Localization;
use Rami\EntityKitBundle\Common\Attributes\Localize;
use Rami\EntityKitBundle\Entity\Traits\LocalizationTrait;

#[Localization(defaultLocale: "en", locales: ["en", "fr", "es"])]
#[ORM\Entity]
class News
{
    use LocalizationTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    public ?int $id = null;

    #[Localize]
    #[ORM\Column(type: Types::STRING, length: 255)]
    public ?string $title = null;

    #[Localize]
    #[ORM\Column(type: Types::TEXT)]
    public ?string $content = null;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string|null $title
     * @return static
     */
    public function setTitle(?string $title): static
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * @param string|null $content
     * @return static
     */
    public function setContent(?string $content): static
    {
        $this->content = $content;
        return $this;
    }
}
