<?php

use Doctrine\Persistence\ManagerRegistry;
use Rami\EntityKitBundle\EventListener\Authored\AuthoredListener;
use Rami\EntityKitBundle\EventListener\IpTagged\IpTaggedListener;
use Rami\EntityKitBundle\EventListener\Slugged\SluggedListener;
use Rami\EntityKitBundle\EventListener\TimeStamped\TimeStampedListener;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

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

    $services
        ->set(AuthoredListener::class)
        ->args([new Reference(TokenStorageInterface::class)])
        ->tag('doctrine.event_listener', ['event' => 'prePersist'])
        ->tag('doctrine.event_listener', ['event' => 'preUpdate']);

    $services
        ->set(IpTaggedListener::class)
        ->args([new Reference(RequestStack::class)])
        ->tag('doctrine.event_listener', ['event' => 'prePersist'])
        ->tag('doctrine.event_listener', ['event' => 'preUpdate']);
};