<?php

namespace AppBundle\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use AppBundle\Entity\Player;
class PlayerController extends Controller {
 
    
    public function playersAction($team) {
        $data = $this->getDoctrine()->getManager();
        $player = $data->getRepository('AppBundle:Player')->findTeam($team);

        $pl = array();
        foreach($player as $key=>$p) {
            $pl[$key]['nome'] = $p->getNamePlayer();
            $pl[$key]['idade'] = $p->getAgePlayer();
            $pl[$key]['posicao'] = $p->getPositionPlayer();
            $pl[$key]['qualidade'] = $p->getQualityPlayer();
            $pl[$key]['numero'] = $p->getNumberPlayer();
            $pl[$key]['forma'] = $p->getFormaPlayer();
            $pl[$key]['condicao'] = $p->getConditionPlayer();
            $pl[$key]['situacao'] = $p->getSituation();
        }
        return new JsonResponse(array('jogadores'=>$pl));
        //return new Response($pl);
    }
    

}
