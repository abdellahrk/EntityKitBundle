<?php

namespace Rami\EntityKitBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class DoctrineEventSubscriberPass implements CompilerPassInterface
{

    /**
     * @inheritDoc
     */
    public function process(ContainerBuilder $container): void
    {
//        if ($container->hasDefinition('doctrine.event_manager')) {
//            return;
//        }
//
//        $definition = $container->getDefinition('doctrine.event_manager');
//
//        foreach ($container->findTaggedServiceIds('doctrine.event_subscriber') as $id => $tags) {
//            $definition->addMethodCall('addEventSubscriber', [new Reference($id)]);
//        }

        $definition = $container->getDefinition('doctrine.orm.entity_manager');

        // Add your event subscriber manually to Doctrine
        $definition->addMethodCall('addEventSubscriber', [
            new Reference('Rami\EntityKitBundle\TimeStamp\EventSubscribers\TimeStampSubscriber'),
        ]);
    }
}