<?php
// src/AppBundle/Controller/HomeController.php
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends Controller {
    
    protected $number;
    
    /**
     * @Route("/home")
     */
    public function index()  {
        /*return new Response(
            "<h3>My Home</h3>"               
            );*/
        
        $data = $this->numberAction();
        
        return $this->render('home.html.twig', array("data" => $data));
    }
    
    private function numberAction() {
        return $this->number = rand(0, 10);
    }
    
}


?>