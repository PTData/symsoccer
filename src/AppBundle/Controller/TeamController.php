<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Task;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use AppBundle\Entity\Team;
use AppBundle\Entity\Player;

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
#        dump($arr);
        return $this->render('teams.html.twig', array("data" => $arr));
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
        
        /*$player = $this->forward('AppBundle:Player:players', array(
        'team'  => $team,
        ));*/
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
            //$pl[$key]['situacao'] = $p->getSituation();
            $pl[$key]['form'] = $this->_form($p);
        }
        $equipa["jogadores"] = $pl;
        //$equipa["form"] = $this->_form($pl);
        //dump($pl);
        return $this->render('team.html.twig', $equipa);
        //return new JsonResponse($equipa);
    }
    private function _form($pl) {
        $form = $this->createFormBuilder($pl)
            ->add('situation', 'choice', array(
                    'choices'  => array(
                        'Titular' => 1,
                        'Suplente' => 2,
                        'N Convocado' => 0,
                    ),
                    // *this line is important*
                    'choices_as_values' => true,
                ))
            
            ->add('save', 'submit', array('label' => 'Create Task'))
            ->getForm();

        /*return $this->render('default/new.html.twig', array(
            'form' => $form->createView(),
        ));*/
        return $form->createView();
    }

}
