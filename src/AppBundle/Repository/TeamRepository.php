<?php

namespace AppBundle\Repository;
use Doctrine\ORM\EntityRepository;
use AppBundle\Entity\Team;

class TeamRepository extends EntityRepository {
    /*
    public function find($id) {
        return $this
            ->select('name_team')
            ->from('Team', 't');
            
            
            #teste
    }*/
    public function selectAll()
    {
        $t = $this->getEntityManager()
            ->createQuery(
                'SELECT t FROM AppBundle:Team t ORDER BY t.name_team ASC'
            )
            ->getSingleResult();
            
        var_dump($t);    
        return $t;
    }
    
}