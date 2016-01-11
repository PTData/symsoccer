<?php

namespace AppBundle\Repository;
use Doctrine\ORM\EntityRepository;
use AppBundle\Entity\Player;
use Doctrine\ORM\Query\ResultSetMapping;

class PlayerRepository extends EntityRepository {

    
    public function findTeam($team) {
        $p = $this->getEntityManager()
            ->createQuery(
                'SELECT p FROM AppBundle:Player p WHERE p.id_team_player = :team '
            )->setParameter('team', $team)
            ->getResult();

            return $p;

    }

    public function getStrong($team){
        $string = "select p";
        $t = $this->getEntityManager()
            ->createQuery();
        return $t;
    }
    
    public function findTeamObject($t) {
        
        $p = $this->getEntityManager()
            ->createQuery(
                "SELECT p FROM AppBundle:Player p WHERE p.id_team_player = :team  "
            )->setParameter('team', $t)
            ->getResult();
         return $p;
         
    }
    public function findTimeArray($t) {
        $query = "SELECT * 
                     FROM player WHERE id_team_player  = :t
            order by field(situation, 1, 2,0) ,  
            field(position_player, 'GR', 'DF', 'MD', 'AV')";
        $q = "select * from player where id_team_player = :t";
        $stmt = $this->getEntityManager()
                   ->getConnection()
                   ->prepare($query);
      $stmt->bindValue('t', $t);
      $stmt->execute();
      return $stmt->fetchAll();

            return $p;

    }

    public function getStrong($team){
        $string = "select p";
        $t = $this->getEntityManager()
            ->createQuery();
        return $t;

    }
}