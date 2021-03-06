<?php

namespace AppBundle\Controller;
use AppBundle\Livraria\Teste;
use AppBundle\Entity\Task;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use AppBundle\Entity\Team;

class TeamController extends Controller
{
    
    protected $objecto = false;
    /**
     * @Route("/teams", name="Equipas")
     */
    public function teams() {

        $home = $this->t2(1);
        $visitor = $this->t2(2);
        $t = new Teste($home, $visitor);

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

    private function t2($team){
        $data = $this->getDoctrine()->getManager();
        $player = $data->getRepository('AppBundle:Player')->findTeam($team);

        $pl = array();
        foreach($player as $key=>$p) {
            $pl[$key]['qualidade'] = $p->getQualityPlayer();
            $pl[$key]['forma'] = $p->getFormaPlayer();
        }

        return $player;
    }

    /**
     * @Route("/team/show/{teamId}", name="Equipa")
     */
    public function team($teamId) {
        
        $data = $this->getDoctrine()->getManager();
        $team = $data->getRepository('AppBundle:Team')->find($teamId);
        $equipa = array(
          "nome" =>  $team->getNameTeam(),
          "id" => $team->getIdteam() 
        );
        
        $data = $this->getDoctrine()->getManager();
        
        
        $pl = array();
        if(!$this->objecto) {
            $player = $data->getRepository('AppBundle:Player')->findTimeArray($teamId);
            foreach ($player as $key=>$p) {
                $pl[$key]['nome'] = $p['name_player'];
                $pl[$key]['idade'] = $p['age_player'];
                $pl[$key]['posicao'] = $p['position_player'];
                $pl[$key]['qualidade'] = $p['quality_player'];
                $pl[$key]['numero'] = $p['number_player'];
                $pl[$key]['forma'] = $p['forma_player'];
                $pl[$key]['condicao'] = $p['position_player'];
                $pl[$key]['form'] = $p['situation'];
            }
        } elseif($this->objecto) {
            $player = $data->getRepository('AppBundle:Player')->findTeamObject($teamId);
            foreach($player as $key=>$p) {
                $pl[$key]['nome'] = $p->getNamePlayer();
                $pl[$key]['idade'] = $p->getAgePlayer();
                $pl[$key]['posicao'] = $p->getPositionPlayer();
                $pl[$key]['qualidade'] = $p->getQualityPlayer();
                $pl[$key]['numero'] = $p->getNumberPlayer();
                $pl[$key]['forma'] = $p->getFormaPlayer();
                $pl[$key]['condicao'] = $p->getConditionPlayer();
                $pl[$key]['form'] = $this->_form($p);
            }
        }
        
         
        $equipa["jogadores"] = $pl;

        //$equipa["form"] = $this->_form($pl);

        return $this->render('team.html.twig', $equipa);
    }
    
    /**
    * Creates a ajax.
    *
    * @Route("/team/add/{team}", name="demo_create")
    *
    */
    public function ajaxAction(Request $request,  $team) {
        if ($request->isXMLHttpRequest()) {         
            return new JsonResponse(array('data' => 'this is a json response'));
        }

        return new Response('This is not ajax!', 400);
    }
    
    private function _form($pl) {

        $form = $this->createFormBuilder($pl, ['attr' => ['id' => 'id_'.$pl->getNumberPlayer()]])
            ->add('situation', 'choice', array(

                    'choices'  => array(
                        'Titular' => 1,
                        'Suplente' => 2,
                        'N Convocado' => 0,
                    ),
                    // *this line is important*
                    'choices_as_values' => true,
                ))
            
            #->add('save', 'submit', array('label' => 'Create Task'))
            ->getForm();

        /*return $this->render('default/new.html.twig', array(
            'form' => $form->createView(),
        ));*/
        return $form->createView();
    }

    /**
     * @param string $all
     * @return float|int|null
     */
    public function eleven_team_strong($all = "") {
        # all, gk, df, md, av
        $strong = 0;
        $condition = 0;
        $forma = 0;
        $pos;
        if (empty($all)) {
            foreach ($this->players as $str) {
                /*
                 * condicao e forma deveriam ser tratados com calculos diferentes
                 */
                $condition = $str['condition_player'] + $condition;
                $forma = $str['forma_player'] + $forma;
                $strong = $str['quality_player'] + $strong;
            }
            $cond = ($condition * 2) / 5;
            //return round($strong + (($condition/5) / $forma));
            return round(($strong / $forma) + $cond);
            //return $cond;
        } else if ($all == 'GR') {
            $strong = $this->get_position_eleven($this->team, $all);
            $this->gr = $strong[0]['quality_player'];
            return $this->gr;
        } else {
            $pos = $this->get_position_eleven($this->team, $all);
            $count = count($pos);
            for ($i = 0; $i < $count; $i++) {
                $strong     = $pos[$i]['quality_player'] + $strong;
                $condition  = $pos[$i]['condition_player'] + $condition;
                $forma      = $pos[$i]['forma_player'] + $forma;
            }
            switch ($all) {
                case 'DF':
                    $this->df = $strong ;
                    return $this->df;
                    break;
                case 'MD':
                    $this->md = $strong ;
                    return $this->md;
                    break;
                case 'AV':
                    $this->av = $strong ;
                    return $this->av;
                    break;
            }
        }

        return null;
    }

}
