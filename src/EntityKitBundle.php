<?php

namespace Rami\EntityKitBundle;

use Psr\Log\LoggerInterface;
use Rami\EntityKitBundle\DependencyInjection\Compiler\DoctrineEventSubscriberPass;
use Symfony\Component\Config\Definition\Configurator\DefinitionConfigurator;
use Symfony\Component\DependencyInjection\Compiler\PassConfig;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Bundle\AbstractBundle;
use Symfony\Component\HttpKernel\Log\Logger;

class EntityKitBundle extends AbstractBundle
{
//    public function getPath(): string
//    {
//        return __DIR__;
//    }

    public function getPath(): string
    {
        $reflected = new \ReflectionObject($this);

        return \dirname($reflected->getFileName(), 2);
    }
    
    public function loadExtension(array $config, ContainerConfigurator $container, ContainerBuilder $builder): void
    {
        $container->import('../config/services.php');
    }
    
    public function configure(DefinitionConfigurator $definition): void
    {
        $definition->import('../config/definition.php');
    }

    public function build(ContainerBuilder $container): void
    {
        parent::build($container);

        //$container->addCompilerPass(new DoctrineEventSubscriberPass(), PassConfig::TYPE_BEFORE_OPTIMIZATION, 10);
    }
}