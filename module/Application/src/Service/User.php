<?php
/**
 * Created by PhpStorm.
 * User: unochapeco
 * Date: 09/04/18
 * Time: 21:03
 */

namespace Application\Service;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Pagination\Paginator;
use \Zend\Paginator\Paginator as ZFPaginator;
use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator;

class User
{

    protected $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function getAll()
    {
        return $this->provider();
    }

    public function pagination($page, $itemPerPage = 10)
    {
        $select = $this->em->createQueryBuilder()
            ->select('User')
            ->from('\Application\Entity\User', 'User');
        $adapter = new DoctrinePaginator(new Paginator($select));
        $paginator = new ZFPaginator($adapter);
        $paginator->setCacheEnabled(true);
        $paginator->setCurrentPageNumber($page);
        $paginator->setItemCountPerPage($itemPerPage);

        return $paginator;
    }


    private function provider()
    {
       $data = [];

       for ($i = 0; $i < 9; $i++) {
           $user = new \Application\Entity\User();
           $user->id = $i;
           $user->name = "João $i";
           $data[] = $user;
       }

       return $data;
    }
}