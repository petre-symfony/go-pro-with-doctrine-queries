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
    //$dql = 'SELECT cat FROM AppBundle\Entity\Category cat ORDER BY cat.name DESC';
    //$query = $this->getEntityManager()->createQuery($dql);
    
    $qb = $this->createQueryBuilder('cat')
      ->addOrderBy('cat.name', 'ASC');
    $query = $qb->getQuery();
    
    return $query->execute();
  }
  
  public function search($term){
    return $this->createQueryBuilder('cat')
      ->andWhere('cat.name LIKE :searchTerm OR cat.iconKey LIKE :searchTerm')
      ->leftJoin('cat.fortuneCookies', 'fc')      
      ->setParameter('searchTerm', '%'.$term.'%')
      ->getQuery()
      ->execute();
  }
}
