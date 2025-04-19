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

namespace Rami\EntityKitBundle\Entity\Traits;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

trait MappedIpTaggedTrait
{
    #[ORM\Column(type: Types::STRING, nullable: true)]
    protected ?string $createdFromIp = null;

    #[ORM\Column(type: Types::STRING, nullable: true)]
    protected ?string $updatedFromIp = null;

    /**
     * @return string|null
     */
    public function getCreatedFromIp(): ?string
    {
        return $this->createdFromIp;
    }

    /**
     * @param string|null $createdFromIp
     * @return $this
     */
    public function setCreatedFromIp(?string $createdFromIp): static
    {
        $this->createdFromIp = $createdFromIp;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getUpdatedFromIp(): ?string
    {
        return $this->updatedFromIp;
    }

    /**
     * @param string|null $updatedFromIp
     * @return $this
     */
    public function setUpdatedFromIp(?string $updatedFromIp): static
    {
        $this->updatedFromIp = $updatedFromIp;
        return $this;
    }
}