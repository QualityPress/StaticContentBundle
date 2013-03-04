<?php

namespace QualityPress\Bundle\StaticContentBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('quality_press_static_content');
        
        $rootNode
            ->children()
                // EntityManager
                ->scalarNode('manager')
                    ->defaultValue('site')
                ->end()
                
                // Classes definition
                ->arrayNode('classes')
                    ->children()
                        ->scalarNode('content')->cannotBeEmpty()->end()
                        ->scalarNode('context')->defaultValue('QualityPress\Bundle\StaticContentBundle\Model\Context')->end()
                        ->scalarNode('content_manager')->defaultValue('QualityPress\Bundle\StaticContentBundle\Manager\ContentManager')->end()
                        ->scalarNode('context_manager')->defaultValue('QualityPress\Bundle\StaticContentBundle\Manager\ContextManager')->end()
                    ->end()
                ->end()
                
                // Contexts
                ->arrayNode('contexts')
                    ->useAttributeAsKey('id')
                    ->prototype('array')
                        ->children()
                            ->scalarNode('default_description')->defaultValue(null)->end()
                            ->scalarNode('translation_domain')->defaultValue(null)->end()
                            ->scalarNode('content_view')->defaultValue(null)->end()
                        ->end()
                    ->end()
                ->end()
                
                // Content
                ->arrayNode('contents')
                    ->useAttributeAsKey('id')
                    ->prototype('array')
                        ->children()
                            ->scalarNode('description')->defaultValue(null)->end()
                            ->scalarNode('context')->defaultValue(null)->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
