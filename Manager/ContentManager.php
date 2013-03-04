<?php

namespace QualityPress\Bundle\StaticContentBundle\Manager;

use Doctrine\ORM\EntityManager;

/**
 * ContentManager
 * 
 * @copyright (c) 2013, Quality Press
 * @author Jorge Vahldick <jvahldick@gmail.com>
 */
class ContentManager implements ContentManagerInterface
{
    
    protected $class;
    protected $entityManager;
    protected $repository;
    
    function __construct(EntityManager $em, $class)
    {
        $this->class = $class;
        $this->entityManager = $em;
        $this->repository = $this->entityManager->getRepository($this->class);
    }
    
    protected function getRepository()
    {
        return $this->repository;
    }
    
    public function getEntityManager()
    {
        return $this->entityManager;
    }
    
    public function findOne($identity)
    {
        return $this->getRepository()->findOneBy(array(
            'identity' => $identity
        ));
    }
    
    public function findBy(array $params)
    {
        return $this->getRepository()->findBy($params);
    }
    
    public function findAll()
    {
        return $this->getRepository()->findAll();
    }
    
    public function getClass()
    {
        return $this->class;
    }
    
    public function create()
    {
        $class = $this->getClass();
        return new $class;
    }

    public function persist(\QualityPress\Bundle\StaticContentBundle\Model\ContentInterface $content, $flush = true)
    {
        $this->entityManager->persist($content);
        if (true === $flush) {
            $this->entityManager->flush();
        }
    }
    
}
