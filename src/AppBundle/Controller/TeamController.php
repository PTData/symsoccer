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
        
        $data = $this->getDoctrine()->getManager();
        $teams = $data->getRepository('AppBundle:Team')->selectAll();
        $arr = array();
        foreach($teams as $key=>$team) {
            $arr[$team->getIdteam()] = $team->getNameTeam();
        }
        dump($arr);
        return $this->render('teams.html.twig', array("data" => $arr));
        
        #return $this->render('team.html.twig');
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
    
    private function showAction($id = null) {
        
        $team = $this->getDoctrine()
        ->getRepository('AppBundle:Team');
        
        if(!empty($id)) $team->find($id);
        else $team->findAll();
        /*
        if(!$team) {
            throw $this->createNotFoundException(
               #'Nao ha equipa com este id: ' . $id;
            );
            return 0;
        }*/
        return $team;
    }
    
    /**
     * @Route("/team/show/{team}", name="Equipa")
     */
    public function team($team) {
        
        $data = $this->getDoctrine()->getManager();
        $team = $data->getRepository('AppBundle:Team')->find($team);
        $equipa = array(
          "nome" =>  $team->getNameTeam(),
          "id" => $team->getIdteam() 
        );
        return $this->render('team.html.twig', $equipa);
        //return new JsonResponse($id);
    }
    

}
