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

namespace Rami\EntityKitBundle\Infra\Interfaces\Authored;

interface AuthoredInterface
{
    public function getCreatedBy(): ?string;

    public function setCreatedBy(string $createdBy): static;

    public function getUpdatedBy(): ?string;

    public function setUpdatedBy(string $updatedBy): static;
}