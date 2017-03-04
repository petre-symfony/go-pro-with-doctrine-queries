<?php

namespace AppBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * CategoryRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CategoryRepository extends EntityRepository
{
  public function findAllOrdered(){
    $dql = 'SELECT cat FROM AppBundle\Entity\Category cat';
    $query = $this->getEntityManager()->createQuery($dql);
    
    return $query->execute();
  }
}
