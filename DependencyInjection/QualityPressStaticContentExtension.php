<?php

namespace QualityPress\Bundle\StaticContentBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class QualityPressStaticContentExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);
        
        $container->setParameter('quality_press_static_content.manager', $config['manager']);
        
        $classes = $config['classes'];
        $this->prepareClasses($container, $classes);
        
        $contexts = $config['contexts'];
        $container->setParameter('quality_press_static_content.contexts', $contexts);
        
        $contents = $config['contents'];
        $container->setParameter('quality_press_static_content.contents', $contents);

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('config.xml');
        $loader->load('twig.xml');
    }
    
    protected function prepareClasses(ContainerBuilder $container, $classes)       
    {
        foreach ($classes as $name => $class)
            $container->setParameter("quality_press_static_content.{$name}.class", $class);
    }
}
