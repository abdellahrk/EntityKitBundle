<?php

use Symfony\Component\Config\Definition\Configurator\DefinitionConfigurator;

return static function (DefinitionConfigurator $definition) {
    $definition->rootNode()
        ->children()
            ->arrayNode('soft_delete')
                ->children()
                    ->booleanNode('enabled')->defaultTrue()->end()
                    ->arrayNode('excludeUris')->scalarPrototype()->end()
                ->end()
            ->end()
        ->end();
};