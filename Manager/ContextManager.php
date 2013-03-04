<?php

namespace QualityPress\Bundle\StaticContentBundle\Manager;

/**
 * ContextManager
 * 
 * @copyright (c) 2013, Quality Press
 * @author Jorge Vahldick <jvahldick@gmail.com>
 */
class ContextManager implements ContextManagerInterface
{
    
    protected $class;
    protected $contexts;
    
    public function __construct($class, $contexts)
    {
        $this->class = $class;
        $this->contexts = array();
        $this->mount($contexts);
    }
    
    public function has($context)
    {
        return (true === key_exists($context, $this->contexts));
    }
    
    public function get($context)
    {
        return ($this->has($context)) ? $this->contexts[$context] : null;
    }
    
    public function getContexts()
    {
        return $this->contexts;
    }
    
    protected function mount($contexts)
    {
        foreach ($contexts as $ident => $config) {
            $class  = $this->getClass();
            $object = new $class;
            $object->setTemplate($config['view']);
            $object->setTranslationDomain($config['translation_domain']);
            
            $this->contexts[$ident] = $object;
        }
    }
    
    protected function getClass()
    {
        return $this->class;
    }
    
}