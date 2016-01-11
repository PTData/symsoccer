<?php
/**
 * The first example class, this is in the same package as the
 * procedural stuff in the start of the file
 * @package sample
 * @subpackage classes
 */
class Oportunidades {
	/**
     * A sample private variable, this can be hidden with the --parseprivate
     * option
     * @access public
     * @var integer
     */
    public $golos = array('home'=>0, 'visitor'=>0);
	public $q_chance = 0;
	
	public $oport = false; # Booleano True or False 
	#public $rand = 0; # numero aleatorio de 0 a 100
	private $whoisteam = 0;
	public $teams = array();
	public $attacker = 0;
	public $fact = 0;
	public $opponent = 0;
	
	function __construct($jogo, $chance) {
		
		$this->jogo = $jogo;

		$this->teams = array('att1' =>  $jogo['atthome'], 
							 'def2' =>  $jogo['defvisitor'], 
							 'att2' =>  $jogo['attvisito'], 
							 'def1' =>  $jogo['defhome']
							);
		
		#$this->rand = $chance;
		
		$oport = $this->Chance($chance);
		$this->oport = $oport;
		
        
		if($this->oport) {
				
			$this->whoisteam = rand(1, 2);
			//$this->attacker = $this->whoisteam;
			
			$this->q_chance = ($this->teams['att'.$this->whoisteam] / $chance) * 3;
			$this->teams['att'.$this->whoisteam] = $this->teams['att'.$this->whoisteam] + $this->q_chance;
			//$this->attackPointsExtras = $this->teams['att'.$this->whoisteam];
			
			if($this->whoisteam == 1) {
				$this->opponent = 2; 
				$this->attacker = 1;
			} else {$this->opponent = 1; $this->attacker = 2;}
			
			if($this->teams['att'.$this->whoisteam] > $this->teams['def'.$this->opponent]) {
				
				if($this->whoisteam == 1) {
                    $this->golos['home'] = 1;
                    $this->fact = $this->factorcasa($this->whoisteam);
                    $this->teams['att'.$this->whoisteam] =  $this->teams['att'.$this->whoisteam] + $this->fact;
				} else {
                    $this->golos['visitor'] = 1;
				}
				$this->golo = 1;
                #$this->attackPointsExtras = $this->teams['att'.$this->whoisteam];
                # $this->fact = $this->factorcasa($this->teams['att'.$this->whoisteam]);
			}
           
			//$this->q_chance = 1 + $this->q_chance ;
		}
		//return  ;
	}
	private function factorcasa($whois) {
        $value;
        if($whois == 1) {
            $value = $this->teams['att'.$whois] * (10/100) ;
        }
        return $value;
    }
    
	private function oponent() {
		if($this->whoisteam == 1) {
			$this->opponent = 2; 
		} else $this->opponent = 1;
		return $this->opponent;
	}
	
	private function golo($golo) {
		$golo = 1;
        $this->golos['home'] = 0;
        $this->golos['visitor'] = 0;
        $home = $this->golos['home'];
        $visitor = $this->golos['visitor'];
        switch ($golo) {
            case 'home':
                $home = $golo + $home;
                break;
            case 'visitor':
                $visitor = $golo + $visitor;
        }
        
		//$team->golo = $golo + $team->golo ;
		//return $team->golo;
        return $this->golos;
	}
	
	
	# Chance(25); // 25%
	# Chance(5, 1000); // 0.5%
	# A: 4-4-2 (Defending Team)
	# B: 3-2-5 (Attacking Team)
	private function Chance($chance, $universe = 100) {
	    $chance = abs(intval($chance));
	    $universe = abs(intval($universe));
	
	    if (mt_rand(1, $universe) <= $chance)
	    {
	    	return true;
	    }
	
	    return false;
		
		if ($attack === true) {
			
		    if (Chance(15 * $aggressivity) === true) {
		    	
		    	if (Chance(10 * $aggressivity) === true) {
		    		// red card
		    	}
		
		    	else {
		    		// yellow card
		    	}
		    }
		}	
	}
	
}

?>