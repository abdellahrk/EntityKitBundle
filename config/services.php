<?php

use Doctrine\Persistence\ManagerRegistry;
use Rami\EntityKitBundle\EventListener\Slugged\SluggedListener;
use Rami\EntityKitBundle\EventListener\TimeStamped\TimeStampedListener;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\String\Slugger\SluggerInterface;

return static function (ContainerConfigurator $container) {
    $services = $container->services()
        ->defaults()
        ->autowire()
        ->autoconfigure();

    $services
        ->set(TimeStampedListener::class)
        ->tag('doctrine.event_listener', ['event' => 'prePersist'])
        ->tag('doctrine.event_listener', ['event' => 'preUpdate']);

    $services
        ->set(SluggedListener::class)
        ->args([
            new Reference(ManagerRegistry::class)
        ])
        ->tag('doctrine.event_listener', ['event' => 'prePersist'])
        ->tag('doctrine.event_listener', ['event' => 'preUpdate']);
};