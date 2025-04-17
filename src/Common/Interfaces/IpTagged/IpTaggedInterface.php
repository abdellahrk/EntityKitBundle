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

namespace Rami\EntityKitBundle\Common\Interfaces\IpTagged;

interface IpTaggedInterface
{
    public function getCreatedFromIp(): ?string;

    public function setCreatedFromIp(?string $createdFromIp): static;

    public function getUpdatedFromIp(): ?string;

    public function setUpdatedFromIp(?string $updatedFromIp): static;
}