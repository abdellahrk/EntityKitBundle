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

use Rami\EntityKitBundle\Common\Doctrine\SoftDeleteFilter;
use Symfony\Bridge\Doctrine\ManagerRegistry;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\HttpKernel\Event\FinishRequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;

readonly class SoftDeleteFilterListener
{
    final const string FILTER_NAME = 'soft_delete';

    public function __construct(
        private ManagerRegistry $managerRegistry,
        private ParameterBagInterface $parameterBag,
    ) {
    }

    public function onKernelController(ControllerEvent $event): void
    {
        $softDelete = $this->parameterBag->has('entity_kit.'.self::FILTER_NAME) ? $this->parameterBag->get('entity_kit.'.self::FILTER_NAME) : null;

        if (null === $softDelete) {
            return;
        }

        if (false === $softDelete['enabled']) {
            return;
        }

        if (null === $event->getRequest()) return;

        $uri = $event->getRequest()->getRequestUri();

        if (\in_array($uri, $softDelete['excludeUris'], true)) {
            return;
        }

        $em = $this->managerRegistry->getManager();
        $em->getConfiguration()->addFilter(self::FILTER_NAME, SoftDeleteFilter::class);
        $em->getFilters()->enable('soft_delete');
    }

    public function cleanupOnRequestFinish(FinishRequestEvent $event): void 
    {
        $request = $event->getRequest();

        if (null === $request) return;
        
        $em = $this->managerRegistry->getManager();

        if ($em->getFilters()->isEnable(self::FILTER_NAME)) {
            $em->getFilters()->disable(self::FILTER_NAME);
        }

    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::CONTROLLER => 'onKernelController',
            KernelEvents::FINISH_REQUEST => 'cleanupOnRequestFinish'
        ];
    }
}