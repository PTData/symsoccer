<?php

namespace AppBundle\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
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

    /**
     * @Route("/player", name="Player")
     */
    public function ajax_player(Request $request) {
        // is it an Ajax request?
        //extract($_POST);
        $isAjax = $request->isXmlHttpRequest();
        if(!$isAjax) {
            return new Response(json_encode('NO AJAX'));
        }
        $request = $this->container->get('request');
        $data = $request->query->get('resquest');
        $response = array("success" => $request);
        //you can return result as JSON
        return new Response(json_encode($data));
    }
    

}
