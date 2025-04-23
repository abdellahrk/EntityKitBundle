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

namespace Rami\EntityKitBundle\Tests\Util\Entity\Authored;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Rami\EntityKitBundle\Common\Interfaces\Authored\AuthoredInterface;
use Rami\EntityKitBundle\Entity\Traits\AuthoredTrait;

#[ORM\Entity]
class Blog implements AuthoredInterface
{
    use AuthoredTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    public ?int $id = null;

    #[ORM\Column(type: Types::STRING, length: 255)]
    public ?string $title = null;
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
     * @return Blog
     */
    public function setTitle(?string $title): Blog
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
     * @return Blog
     */
    public function setContent(?string $content): Blog
    {
        $this->content = $content;
        return $this;
    }
}