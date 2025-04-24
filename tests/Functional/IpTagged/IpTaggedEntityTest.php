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

namespace Rami\EntityKitBundle\Tests\Functional\IpTagged;

use Rami\EntityKitBundle\Tests\Util\App\BaseKernel;
use Rami\EntityKitBundle\Tests\Util\Entity\IpTagged\Product;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

class IpTaggedEntityTest extends BaseKernel
{
    public function testIpTaggedEntity(): void
    {
        $request = new Request();
        $request->server->set('REMOTE_ADDR', '123.123.123.123');

        $requestStack = $this->container->get(RequestStack::class);
        $requestStack->push($request);

        $product = new Product();
        $product->setTitle('Awesome Product');
        $this->entityManager->persist($product);
        $this->entityManager->flush();

        $this->assertInstanceOf(Product::class, $product);
        $this->assertNotNull($product->getCreatedFromIp());

        $request->server->set('REMOTE_ADDR', '123.123.123.10');

        $requestStack = $this->container->get(RequestStack::class);
        $requestStack->push($request);

        $product->setTitle('new title');

        $this->entityManager->flush();

        $this->assertEquals('123.123.123.10', $product->getUpdatedFromIp());
    }
}