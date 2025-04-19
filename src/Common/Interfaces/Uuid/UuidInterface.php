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

namespace Rami\EntityKitBundle\Common\Interfaces\Uuid;

use Symfony\Component\Uid\Uuid;

interface UuidInterface
{
    public function getUuid(): ?Uuid;

    public function setUuid(Uuid $uuid): static;
}