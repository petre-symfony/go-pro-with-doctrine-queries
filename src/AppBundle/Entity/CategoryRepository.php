<?php

namespace AppBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;

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
      ->leftJoin('cat.fortuneCookies', 'fc')
      ->addSelect('fc')      
      ->addOrderBy('cat.name', 'ASC');
    $query = $qb->getQuery();
    
    return $query->execute();
  }
  
  public function search($term){
    return $this->createQueryBuilder('cat')
      ->andWhere('cat.name LIKE :searchTerm 
        OR cat.iconKey LIKE :searchTerm
        OR fc.fortune LIKE :searchTerm')
      ->leftJoin('cat.fortuneCookies', 'fc')
      ->addSelect('fc')      
      ->setParameter('searchTerm', '%'.$term.'%')
      ->getQuery()
      ->execute();
  }
  
  public function findWithFortunesJoin($id){
    return $this->createQueryBuilder('cat')
      ->andWhere('cat.id = :id')
       ->leftJoin('cat.fortuneCookies', 'fc')     
      ->addSelect('fc')      
      ->setParameter('id', $id)
      ->getQuery()
      ->getOneOrNullResult();
  }
  
  /**
   * 
   * @param QueryBuilder $qb
   * @return QueryBuilder
   */
  private function addFortuneCookieJoinAndSelect(QueryBuilder $qb){
    return $qb->leftJoin('cat.fortuneCookies', 'fc')->addSelect('fc');
  }
}
