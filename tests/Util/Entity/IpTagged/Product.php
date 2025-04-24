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

namespace Rami\EntityKitBundle\Tests\Util\Entity\IpTagged;

use Doctrine\ORM\Mapping as ORM;
use Rami\EntityKitBundle\Common\Interfaces\IpTagged\IpTaggedInterface;
use Rami\EntityKitBundle\Entity\Traits\IpTaggedTrait;
use Rami\EntityKitBundle\Entity\Traits\MappedIpTaggedTrait;

#[ORM\Entity]
class Product implements IpTaggedInterface
{
    use MappedIpTaggedTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    public ?int $id = null;

    #[ORM\Column(type: 'string', length: 255)]
    public ?string $title = null;

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
     * @return Product
     */
    public function setTitle(?string $title): Product
    {
        $this->title = $title;
        return $this;
    }

}