<?php


/**
 * Description of FinalJogo
 *
 * @author pedrodata
 */
class FinalJogo {
    private $conn;
    var $home;
    var $visitor;
    var $resultado;
    private $teste;
    
    function FinalJogo($home, $visitor, $game, $resultado) {
        $this->db = new Ispecifico();
        $this->conn = & DatabaseFactory::getInstance();
        $this->conn->SetFetchMode(ADODB_FETCH_ASSOC);
        
        $this->home = $home;
        $this->visitor = $visitor;
        $this->game = $game;
        $this->resultado = $resultado;
    }
    public function insert_eleven_team() {
        #$sql_select_titulares = "select situation from players where ";
        $sql = "update jogos set home_formation_jogos = ?, visitor_formation_jogos = ?, result_jogos = ? WHERE id_jogos= ?";
        $db_convocados = $this->conn->prepare($sql);
        $this->conn->Execute($db_convocados, array($this->home, $this->visitor, $this->resultado, $this->game));
        $this->fadiga();
    }
    private function fadiga() {
        $home = explode(",", $this->home);
        $visitor = explode(",", $this->visitor);
        foreach ($home as $h){
            //TODO Filtrar por titulares
            $sql = "update players set condition_player = condition_player - 50, forma_player = forma_player + 1 WHERE id_player = ?";
            $db_convocados = $this->conn->prepare($sql);
            $this->conn->Execute($db_convocados, array($h));
        }
        foreach ($visitor as $v){
            $sql = "update players set condition_player = condition_player - 50, forma_player = forma_player + 1 WHERE id_player = ?";
            $db_convocados = $this->conn->prepare($sql);
            $this->conn->Execute($db_convocados, array($v));
        }
    }
}
