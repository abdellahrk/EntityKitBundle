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

namespace Rami\EntityKitBundle\EventListener\SoftDelete;

use Doctrine\ORM\Configuration;
use Doctrine\ORM\EntityManager;
use Rami\EntityKitBundle\Common\Doctrine\SoftDeleteFilter;
use Symfony\Bridge\Doctrine\ManagerRegistry;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\HttpKernel\KernelEvents;

readonly class SoftDeleteFilterListener
{
    public function __construct(
        private ManagerRegistry $managerRegistry,
        private ParameterBagInterface $parameterBag,
    ) {
    }

    public function onKernelController(ControllerEvent $event): void
    {
        $softDelete = $this->parameterBag->has('entity_kit.soft_delete') ? $this->parameterBag->get('entity_kit.soft_delete') : null;

        if (null === $softDelete) {
            return;
        }

        if (false === $softDelete['enabled']) {
           return;
        }

        $uri = $event->getRequest()->getRequestUri();

        if (\in_array($uri, $softDelete['excludeUris'], true)) {
            return;
        }

        $em = $this->managerRegistry->getManager();
        $em->getConfiguration()->addFilter('soft_delete', SoftDeleteFilter::class);
        $em->getFilters()->enable('soft_delete');
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::CONTROLLER => 'onKernelController',
        ];
    }
}