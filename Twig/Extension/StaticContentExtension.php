<?php

namespace QualityPress\Bundle\StaticContentBundle\Twig\Extension;

use \Twig_Extension;
use Symfony\Component\DependencyInjection\ContainerInterface;
use QualityPress\Bundle\StaticContentBundle\Templating\ContentRendererInterface;
use QualityPress\Bundle\StaticContentBundle\Handler\ContentHandlerInterface;
use QualityPress\Bundle\StaticContentBundle\Handler\ContextHandlerInterface;
use QualityPress\Bundle\StaticContentBundle\Exception\ContentNotFoundException;

/**
 * StaticContentExtension
 * 
 * @copyright (c) 2013, Quality Press
 * @author Jorge Vahldick <jvahldick@gmail.com>
 */
class StaticContentExtension extends Twig_Extension
{
    
    protected $container;
    
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }
    
    public function getContainer()
    {
        return $this->container;
    }

    public function getFunctions()
    {
        return array(
            'qp_get_content'                => new \Twig_Function_Method($this, 'getContent', array("is_safe" => array("html"))),
            'qp_get_contents_by_context'    => new \Twig_Function_Method($this, 'getContentsByContext', array("is_safe" => array("html"))),
        );
    }
    
    public function getName()
    {
        return 'qp_static_content_extension';
    }
    
    public function getContent($name, $template = null, $options = array())
    {
        $contentHandler = $this->getContentHandler();
        $content = $contentHandler->get($name);
        
        if (null == $content) {
            throw new ContentNotFoundException(sprintf(
                'The valid contents obtained are:',
                join(',', array_keys($contentHandler->getContents()))
            ));
        }
        
        $template = (null === $template) ? $this->getContextHandler()->get($content->getContext())->getTemplate() : $template;
        if (false === isset($options['translationDomain'])) {
            $options = array_merge(
                array('translationDomain' => $this->getContextHandler()->get($content->getContext())->getTranslationDomain()),
                $options
            );
        }
        
        return $this->getTemplateRenderer()->render($template, array_merge(array('content' => $content), $options));
    }
    
    public function getContentsByContext($name, $template = null, $options = array())
    {
        $result = '';
        $contextHandler = $this->getContextHandler();
        if ($contextHandler->has($name)) {
            $contents = $this->getContentHandler()->getByContext($name);            
            foreach ($contents as $content) {
                $result .= $this->getContent($content->getIdentity(), $template, $options);
            }
        }
        
        return $result;
    }
    
    /**
     * Get content handler object
     * @return ContentHandlerInterface
     */
    protected function getContentHandler()
    {
        return $this->getContainer()->get('qp.static_content.content_handler');
    }
    
    /**
     * Get context handler object
     * @return ContextHandlerInterface
     */
    protected function getContextHandler()
    {
        return $this->getContainer()->get('qp.static_content.context_handler');
    }
    
    /**
     * Get content render object
     * @return ContentRendererInterface
     */
    protected function getTemplateRenderer()
    {
        return $this->getContainer()->get('qp.static_content.renderer');
    }
    
}