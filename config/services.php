<?php

use Doctrine\ORM\Configuration;
use Doctrine\Persistence\ManagerRegistry;
use Psr\Log\LoggerInterface;
use Rami\EntityKitBundle\EventListener\Authored\AuthoredListener;
use Rami\EntityKitBundle\EventListener\IpTagged\IpTaggedListener;
use Rami\EntityKitBundle\EventListener\LoggedEntity\LoggedEntityListener;
use Rami\EntityKitBundle\EventListener\Slugged\SluggedListener;
use Rami\EntityKitBundle\EventListener\SoftDelete\SoftDeleteFilterListener;
use Rami\EntityKitBundle\EventListener\TimeStamped\TimeStampedListener;
use Rami\EntityKitBundle\EventListener\Uuid\UuidListener;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
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
        ->tag('doctrine.event_listener', ['event' => 'kernel.controller']);

    $services
        ->set(LoggedEntityListener::class)
        ->args([new Reference(LoggerInterface::class)])
        ->tag('doctrine.event_listener', ['event' => 'postPersist']);

    $services
        ->set(UuidListener::class)
        ->tag('doctrine.event_listener', ['event' => 'prePersist']);

    $services
        ->set(SoftDeleteFilterListener::class)
        ->args([new Reference(ManagerRegistry::class), new Reference(ParameterBagInterface::class)])
        ->tag('kernel.event_listener', ['event' => 'kernel.controller', 'method' => 'onKernelController']);
};