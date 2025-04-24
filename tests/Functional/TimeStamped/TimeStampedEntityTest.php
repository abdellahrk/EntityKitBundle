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

namespace Rami\EntityKitBundle\Tests\Functional\TimeStamped;

use Rami\EntityKitBundle\Tests\Util\App\BaseKernel;
use Rami\EntityKitBundle\Tests\Util\Entity\TimeStamped\Article;
use Symfony\Component\Filesystem\Filesystem;

class TimeStampedEntityTest extends BaseKernel
{
    public function setUp(): void
    {
        parent::setUp();
    }

    public function testTimeStampedEntity(): void
    {
        $blog = new Article();

        $blog->setTitle('Blog title');
        $blog->setContent('Blog content');

        $this->entityManager->persist($blog);
        $this->entityManager->flush();

        $this->assertNotNull($blog->getId());
        $this->assertEquals('Blog title', $blog->getTitle());
        $this->assertEquals('Blog content', $blog->getContent());

        $this->assertNotNull($blog->getCreatedAt());
        $this->assertNotNull($blog->getUpdatedAt());

        $this->assertInstanceOf(\DateTimeImmutable::class, $blog->getCreatedAt());
        $this->assertInstanceOf(\DateTimeImmutable::class, $blog->getUpdatedAt());

    }
}