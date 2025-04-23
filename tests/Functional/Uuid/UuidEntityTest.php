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

namespace Rami\EntityKitBundle\Tests\Functional\Uuid;

use Rami\EntityKitBundle\Tests\Util\App\BaseKernel;
use Rami\EntityKitBundle\Tests\Util\Entity\Uuid\User;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Uid\Uuid;

class UuidEntityTest extends BaseKernel
{

    public function setUp(): void
    {
        parent::setUp();
    }

    public function testUuid() : void
    {
        $user = new User();

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        $this->assertNotNull($user->getId());
        $this->assertNotNull($user->getUuid());

        $this->assertInstanceOf(User::class, $user);
        $this->assertInstanceOf(Uuid::class, $user->getUuid());

        $filesystem = new Filesystem();
        $filesystem->remove('var/database.db3');
    }

}