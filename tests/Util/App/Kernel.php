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

declare(strict_types=1);

namespace Rami\EntityKitBundle\Tests\Util\App;

use Doctrine\Bundle\DoctrineBundle\DoctrineBundle;
use Rami\EntityKitBundle\EntityKitBundle;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Bundle\SecurityBundle\SecurityBundle;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\HttpKernel\Kernel as HttpKernel;

class Kernel extends HttpKernel
{

    public function registerBundles(): iterable
    {
        return [
            new EntityKitBundle(),
            new FrameworkBundle(),
            new DoctrineBundle(),
            new SecurityBundle(),
        ];
    }

    public function registerContainerConfiguration(LoaderInterface $loader): void
    {
        $loader->load(__DIR__ . '/config/config.yaml');
    }

    public function getCacheDir(): string
    {
        return 'var/cache';
    }

    public function getLogDir(): string
    {
        return 'var/logs';
    }

    public function getProjectDir(): string
    {
        return __DIR__.'/../';
    }
}
