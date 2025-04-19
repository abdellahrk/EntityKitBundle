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

namespace Rami\EntityKitBundle\DependencyInjection\CompilerPasses;

use Doctrine\DBAL\Exception;
use Doctrine\DBAL\Types\DateTimeImmutableType;
use Doctrine\DBAL\Types\Type;
use Doctrine\DBAL\Types\Types;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;

class DoctrineTypesCompilerPass implements CompilerPassInterface
{
    /**
     * @throws Exception
     */
    public function process(ContainerBuilder $container): void
    {
        if (!Type::hasType(Types::DATETIME_IMMUTABLE)) {
            Type::addType(Types::DATETIME_IMMUTABLE, DateTimeImmutableType::class);
        }

    }
}
