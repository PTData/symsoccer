<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use AppBundle\Entity\Team;
class TeamController extends Controller
{
    /**
     * @Route("/teams", name="Equipas")
     */
    public function teams() {
        
        return $this->render('team.html.twig');
    }
    /**
     * @Route("/team/create")
     */
    public function createAction(){
        $team = new Team();
        $team->setNameTeam("Viveres");
        $team->setStatus(1);
        $em = $this->getDoctrine()->getManager();
        $em->persist($team);
        $em->flush();
        
        return new Response('Create Team id' . $team->getIdteam());
    }
    
    private function showAction($id) {
        
        $team = $this->getDoctrine()
        ->getRepository('AppBundle:Team')
        ->find($id);
        
        if(!$team) {
            throw $this->createNotFoundException(
               //'Nao ha equipa com este id: ' . $id;
            );
            return 0;
        }
        return $team;
    }
    
    /**
     * @Route("/team/show/{team}", name="Equipa")
     */
    public function team($team) {
        
        $id = $this->showAction($team);
        
        return new JsonResponse($id);
    }
    

}
