<?php

namespace AppBundle\Repository;
use Doctrine\ORM\EntityRepository;
use AppBundle\Entity\Player;

class PlayerRepository extends EntityRepository {

    public function findTeam($team) {
        $p = $this->getEntityManager()
            ->createQuery(
                'SELECT p FROM AppBundle:Player p WHERE p.id_team_player = :team '
            )->setParameter('team', $team)
            ->getResult();
            return $p;
    }
}