<?php

class Jogo {
    
    private $conn;
    private $home, $visitor;
    public $dados;
    private $forcaOne, $forcaTwo;
    private $one_fromation, $two_fromation;

    function __construct($jogo) {
        
        $this->db = new Ispecifico();
        $this->conn = & DatabaseFactory::getInstance();
        $this->conn->SetFetchMode(ADODB_FETCH_ASSOC);
        /* JOGO COMEÇA COM QUERY À JORNADA
         * BUSCANDO A PARTIR DO ID DO JOGO, AS EQUIPAS EM DISPUTA PARA ESSE JOGO.
         * */
        $teams = $this->jornada($jogo);
        $this->home = $this->convocados($teams[0]);
        $this->visitor = $this->convocados($teams[1]);
        
        $homeattacking = ($this->medefielding($this->home['team']) / 2) + $this->attacking($this->home['team']);
        $homedeffending = ($this->medefielding($this->home['team']) / 2) + $this->defending($this->home['team']);
        $visitorattacking = ($this->medefielding($this->visitor['team']) / 2) + $this->attacking($this->visitor['team']);
        $visitordeffending = ($this->medefielding($this->visitor['team']) / 2) + $this->defending($this->visitor['team']);
        
        $this->dados = array(
            'home' => array(
                'titulares' => $this->home['titulares'],
                'id' => $this->home['idTeam'],
                'nome' => $this->home['teamName'],
                'strong' => $this->home['teamStrong'],
                'idconvocados' => $this->home['ids'],
                'convocados' => $this->home['convocados'],
                'attack' => $homeattacking,
                'defend' => $homedeffending,
             ),
            'visitor' => array(
                'titulares' => $this->visitor['titulares'],
                'id' => $this->visitor['idTeam'],
                'nome' => $this->visitor['teamName'],
                'strong' => $this->visitor['teamStrong'],
                'idconvocados' => $this->visitor['ids'],
                'convocados' => $this->visitor['convocados'],
                'attack' => $visitorattacking,
                'defend' => $visitordeffending,
            )
        );
        $this->condicao();
    }

    private function convocados($equipa) {
        $arr = array();
        $team = new Team();
        
        $arr['idTeam'] = $equipa;
        $arr['team'] = $team;
        $arr['convocados'] = $team->select_convocados($equipa);
        $arr['teamName'] = $team->select_team($equipa);
        $arr['teamStrong'] = $team->eleven_team_strong();
        $arr['ids'] = $team->convodadisID();
        $arr['titulares'] = $team->titularesId();
        
        return $arr;
    }
    
    private function condicao() {
        $players = $this->home['ids'] . $this->visitor['ids'];
        $explode = explode(",",$players); 
        $cond = array();
        foreach ($explode as $p) {
            $sql_players = "select condition_player from players where id_player = ?";
            $db_jogoid = $this->conn->prepare($sql_players);
            $exec = $this->conn->Execute($db_jogoid, array($p));
            $cond[$p] = $exec->GetRows();
            if($cond[$p][0]['condition_player'] < 100) {
                $c = $cond[$p][0]['condition_player'];
                $n = 0.75 * $c ;
                $v = round($n + $c);
                if($v > 100) $v = 100;
                
                $sql = "update players set condition_player = ? WHERE id_player= ?";
                $db_convocados = $this->conn->prepare($sql);
                $this->conn->Execute($db_convocados, array($v, $p));
            }
        }
    }


    private function jornada($jogo) {
        $sql_jogo = "Select hometeam_jogos, visitorteam_jogos from jogos where id_jogos = ?";
        $db_jogoid = $this->conn->prepare($sql_jogo);
        $exec = $this->conn->Execute($db_jogoid, array($jogo));
        $equipas = $exec->GetAll();
        
        return array($equipas[0]['hometeam_jogos'], $equipas[0]['visitorteam_jogos']);
    }
    
    private function medefielding($team) {
	$DF = $team->eleven_team_strong('DF');
        $MD = $team->eleven_team_strong('MD');
        $AV = $team->eleven_team_strong('AV');
        $pwr_med = $DF * 1 + $MD * 3 + $AV * 2;
        return round($pwr_med);
    }

    private function attacking($team) {

        $DF = $team->eleven_team_strong('DF');
        $MD = $team->eleven_team_strong('MD');
        $AV = $team->eleven_team_strong('AV');
        $pwr_at = $DF * 1 + $MD * 2 + $AV * 3;
        return round($pwr_at);
    }

    private function defending($team) {

        /* força posicao */
        $GR = $team->eleven_team_strong('GR');
        $DF = $team->eleven_team_strong('DF');
        $MD = $team->eleven_team_strong('MD');
        $AV = $team->eleven_team_strong('AV');

        $pwr_def = $DF * 3 + $MD * 2 + $AV * 1 + $GR;
        return round($pwr_def);
    }

    private function formation_team_home() {
        /* formação */
        $def = $this->equipa1->formation('DF');
        $med = $this->equipa1->formation('MD');
        $att = $this->equipa1->formation('AV');
        /* força total */
        $this->forcaTwo = $this->equipa1->eleven_team_strong();

        $this->one_fromation = $def . 'x' . $med . 'x' . $att;

        $pwr_def = $DF * 3 + $MD * 2 + $AV * 1;
        $pwr_med = $DF * 1 + $MD * 3 + $AV * 2;
        $pwr_at = $DF * 1 + $MD * 2 + $AV * 3;
        return round($pwr_def);
    }

    private function formation_team_visitor() {
        /* formação */
        $def = $this->equipa2->formation('DF');
        $med = $this->equipa2->formation('MD');
        $att = $this->equipa2->formation('AV');
        /* força total */
        $this->forcaTwo = $this->equipa2->eleven_team_strong();
        $this->two_fromation = $def . 'x' . $med . 'x' . $att;

        $pwr_def = $DF * 3 + $MD * 2 + $AV * 1;
        $pwr_med = $DF * 1 + $MD * 3 + $AV * 2;
        $pwr_at = $DF * 1 + $MD * 2 + $AV * 3;

        return $pwr_def;
    }

    public function jogar() {
        $rand_um = rand(0, $this->home());
        $rand_dois = rand(0, $this->forcaTwo);
        echo "equipa " . $this->nomeOne . ": " . $rand_um . " vs equipa " . $this->nomeTwo . ": " . $rand_dois;
    }

    private function home() {
        $this->forcaOne = $this->forcaOne + 5;
        $factorCasa = $this->forcaOne;
        return $factorCasa;
    }
    
    public function jogosCalendario() {
        $sqlCalendario = "SELECT id_jogos, jornada_jogos as jornada FROM soccer_game.jogos";
        $dbCalendario = $this->conn->prepare($sqlCalendario);
        $rsCalendario = $this->conn->Execute($dbCalendario, array());
        $calendario = $rsCalendario->GetAll();
        return $calendario;
    }

}
