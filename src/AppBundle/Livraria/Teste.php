<?php
/**
 * Created by PhpStorm.
 * User: pedro.data
 * Date: 23/12/2015
 * Time: 16:28
 */

namespace AppBundle\Livraria;


class Teste {

    private $equipas = array();
    private $home;
    private $visitor;

    function __construct($eq1, $eq2) {
        $this->equipas['home'] = $eq1;
        $this->equipas['visitor'] = $eq2;

        $this->forca();
    }

    private function forca() {

        $home =  $this->equipas['home'];
        foreach($home as $h) {
            print $h->getQualityPlayer();
            print '<br/>';
        }
    }

}