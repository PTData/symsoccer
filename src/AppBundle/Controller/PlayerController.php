<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use AppBundle\Entity\Team;
use AppBundle\Entity\Player;
class PlayerController extends Controller
{
 
    
    /**
     * #@Route("/team/show/{team}", name="Equipa")
     */
    /*public function team($team) {
        
        $data = $this->getDoctrine()->getManager();
        $team = $data->getRepository('AppBundle:Team')->find($team);
        $equipa = array(
          "nome" =>  $team->getNameTeam(),
          "id" => $team->getIdteam() 
        );
        $t = $data->getRepository('AppBundle:Team');
        $player = $data->getRepository('AppBundle:Player');
        dump($player);
        dump($t);
        return $this->render('team.html.twig', $equipa);
        //return new JsonResponse($player);
    }*/
    

}
