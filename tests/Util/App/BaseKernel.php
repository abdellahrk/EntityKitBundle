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

namespace Rami\EntityKitBundle\Tests\Util\App;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\SchemaTool;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\Filesystem\Filesystem;

class BaseKernel extends KernelTestCase
{
    protected Container $container;
    protected EntityManager $entityManager;

    public function setUp(): void
    {
        self::bootKernel();
        $this->container = static::getContainer();
        $doctrine = $this->container->get('doctrine');
        $this->entityManager = $doctrine->getManager();
        $metaData = $this->entityManager->getMetadataFactory()->getAllMetadata();
        $schemaTool = new SchemaTool($this->entityManager);
        $schemaTool->updateSchema($metaData);
    }

    public function tearDown(): void
    {
        parent::tearDown();

        $filesystem = new Filesystem();
        $filesystem->remove('var/database.db3');
    }
}