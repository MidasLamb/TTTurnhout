<?php

namespace App\Libraries;

class VBLmatch {
	public $json;
	public $guid;
	public $wedID;
	public $tTGUID;
	public $tTNaam;
	public $tUGUID;
	public $tUNaam;
	public $datumString;
	public $jsDTCode;
	public $accGUID;
	public $accNaam;
	public $pouleGUID;
	public $pouleNaam;
	public $uitslag;
	public $beginTijd;
	public $homeGame;
	public $siteid;
	public $victory;
	public $draw;

	public $hasComplementaryMatch;
	public $complementaryMatch;
	public $extraDetailHTML;

	public function __construct($json) {
		$this->json = $json;
		$data = (array)json_decode($json);
		$this->guid = $data["guid"];
		$this->wedID = $data["wedID"];
		$this->tTGUID = $data["tTGUID"];
		$this->tTNaam = $data["tTNaam"];
		$this->tUGUID = $data["tUGUID"];
		$this->tUNaam = $data["tUNaam"];
		$this->datumString = $data["datumString"];
		$this->jsDTCode = $data["jsDTCode"];
		$this->accGUID = $data["accGUID"];
		$this->accNaam = $data["accNaam"];
		$this->pouleGUID = $data["pouleGUID"];
		$this->pouleNaam = $data["pouleNaam"];
		$this->uitslag = $data["uitslag"];
		$this->beginTijd = $data["beginTijd"];

		$needle = $this->tTGUID;
		$this->homeGame = true;
		if (strcmp(substr($this->tTGUID, 0, 8), VBLapi::club_guid) != 0){
			$needle = $this->tUGUID;
			$this->homeGame = false;
		}
		$home_victory = false;
		$ar = explode("-", $this->uitslag);
		if (count($ar) == 2){ //No result are in
			$home_points = intval($ar[0]);
			$away_points = intval($ar[1]);
			$home_victory = ($home_points > $away_points);
			$this->draw = ($home_points == $away_points);
		} else {
			$this->draw = true;
		}

		if ($this->homeGame){
			$name = codeToName(substr($this->tTGUID, 8, 3)) . " " . substr($this->tTGUID, -1);
			$this->tTNaam = $name;
			$this->siteid = substr($this->tTGUID, 8, 3) . substr($this->tTGUID, -1);
			$this->victory = $home_victory;
		} else {
			$name = codeToName(substr($this->tUGUID, 8, 3)) . " " . substr($this->tUGUID, -1);
			$this->tUNaam = $name;
			$this->siteid = substr($this->tUGUID, 8, 3) . substr($this->tUGUID, -1);
			$this->victory = ! $home_victory;
		}

    }

	public function __toString() {
   		return $this->json;
	}

	public function findComplementaryMatch($listOfMatches){
		foreach($listOfMatches as $match){
			if ($match->tUGUID == $this->tTGUID && $match->tTGUID == $this->tUGUID && $match->pouleGUID == $this->pouleGUID && intval($match->jsDTCode) < intval($this->jsDTCode)){
				$this->complementaryMatch = $match;
				$this->hasComplementaryMatch = true;
			}
		}
		$this->createExtraDetailHTML();
	}

	public function createExtraDetailHTML(){
		$html = "";
		if ($this->hasComplementaryMatch){
			$comp = $this->complementaryMatch;
			$uitslag = $comp->uitslag;
			if (!$uitslag == "")
				$html = $html."Vorige wedstrijd: ".$comp->tTNaam.":".$comp->uitslag.":".$comp->tUNaam."<br>";
		} 

		$details = new VBLmatchdetails($this->guid);
		$html = $html."Onze plaats: ".$this->getOwnRanking()."<br>";
		$html = $html."Plaats tegenstander: ".$this->findOtherTeamRanking()."<br>";
		$html = $html."Kleur tegenstander: ".$this->findOtherTeamColors()."<br>";
		$html = $html."Adres: ".$details->adres;

		$this->extraDetailHTML = $html;
	}

	private function findOtherTeamRanking(){
		$teamGuid;
		if ($this->homeGame){
			$teamGuid = $this->tUGUID;
		} else {
			$teamGuid = $this->tTGUID;
		}
		$res = json_decode(VBLapi::apiCall("pouleByGuid?pouleguid=".$this->pouleGUID))[0];
		$ranking = "-";
		foreach($res->teams as $team){
			if ($team->guid == $teamGuid){
				$ranking = $team->rangNr;
				break;
			}
		}
		return $ranking;
	}

	private function getOwnRanking(){
		$teamGuid;
		if ($this->homeGame){
			$teamGuid = $this->tTGUID;
		} else {
			$teamGuid = $this->tUGUID;
		}
		$res = json_decode(VBLapi::apiCall("pouleByGuid?pouleguid=".$this->pouleGUID))[0];
		$ranking;
		foreach($res->teams as $team){
			if ($team->guid == $teamGuid){
				$ranking = $team->rangNr;
				break;
			}
		}
		return $ranking;
	}

	private function findOtherTeamColors(){
		$teamGuid;
		if ($this->homeGame){
			$teamGuid = $this->tUGUID;
		} else {
			$teamGuid = $this->tTGUID;
		}
		$clubGuid = substr($teamGuid, 0, 8);
		$res = VBLapi::apiCall("OrgDetailByGuid?issguid=".$clubGuid);
		try {
			$arr =json_decode($res);;
			if (sizeof($arr) == 0){
				return "Not Found";
			}
			$obj = $arr[0];
		} catch (Exception $e) {
			return "Not Found";
		}
		$teams = $obj->teams;
		$correct_team = null;
		foreach($teams as $team){
			if ($team->guid == $teamGuid)
				$correct_team = $team;
		}
		return $correct_team->shirtKleur."(".$correct_team->shirtReserve.")";

	}

	static public function seperateAndOrganizeMatchesByDay($matches){
		$organizedArray = array();
		foreach($matches as $match){
			$date = strtotime($match->datumString, 0);
			if (array_key_exists($date, $organizedArray)){
				array_push($organizedArray[$date], $match);
			} else {
				$organizedArray[$date] = [$match];
			}
		}
		ksort($organizedArray);

		return array_values($organizedArray);

	}

	static public function orderMatchesByHour($matches){
		$organizedArray = array();
		foreach($matches as $match){
			if (($date = strtotime($match->beginTijd, 0)) !== false){
				if (array_key_exists($date, $organizedArray)){
					array_push($organizedArray[$date], $match);
				} else {
					$organizedArray[$date] = [$match];
				}
			} else {
				$organizedArray[$match->beginTijd] = [$match];
			}
		}

		ksort($organizedArray);

		$return = array();
		$i = 0;
		foreach($organizedArray as $group){
			foreach ($group as $match){
				$return[$i++] = $match;
			}
		}

		return $return;
	}

	static public function orderMatchesByDayThenHour($matches){
		$tem = VBLmatch::seperateAndOrganizeMatchesByDay($matches);
		$t = array();
		$i = 0;
		foreach($tem as $group){
			foreach(VBLmatch::orderMatchesByHour($group) as $match){
				$t[$i++]=$match;
			}

		}

		return $t;
	}

	static public function splitMatchesByWeek($matches){
		$tem = VBLmatch::orderMatchesByDayThenHour($matches);
		$res = array();
		foreach($tem as $match){
			$game_week = date('W', strtotime($match->datumString));
			if (array_key_exists($game_week, $res)){
				array_push($res[$game_week], $match);
			} else {
				$res[$game_week] = [$match];
			}
		}
		return $res;
	}

	static public function getPastMatches($matches) {
    	$past_matches = array();
    	$now = new \DateTime(date('d-m-Y'));
    	foreach($matches as $match){
    		$date = new \DateTime($match->datumString);
    		if ($date < $now){
    			array_push($past_matches, $match);
    		}
    	}
    	return VBLmatch::orderMatchesByDayThenHour($past_matches);
    }

    static public function getFutureMatches($matches) {
    	$future_matches = array();
    	$now = new \DateTime(date('d-m-Y'));
    	foreach($matches as $match){
    		$date = new \DateTime($match->datumString);
    		if ($date >= $now){
    			array_push($future_matches, $match);
    		}
    	}
    	return VBLmatch::orderMatchesByDayThenHour($future_matches);
    }

    static public function getMatchesOfThisWeek($matches){
    	$this_week_matches = array();
    	$this_week = date('W');

    	foreach($matches as $match){
    		$game_week = date('W', strtotime($match->datumString));
    		if (strcmp($game_week,$this_week) == 0){
    			array_push($this_week_matches, $match);
    		}
    	}

    	return VBLmatch::orderMatchesByDayThenHour($this_week_matches);
    }

    static public function getMatchesOfNextWeek($matches){
    	$next_week_matches = array();
    	$this_week = intval(date('W'));

    	foreach($matches as $match){
    		$game_week = intval(date('W', strtotime($match->datumString)));
    		if ($game_week == ($this_week+1)){
    			array_push($next_week_matches, $match);
    		}
    	}

    	return VBLmatch::orderMatchesByDayThenHour($next_week_matches);
    }

    static public function getMatchesOfPreviousWeek($matches){
    	$prev_week_matches = array();
    	$this_week = intval(date('W'));

    	foreach($matches as $match){
    		$game_week = intval(date('W', strtotime($match->datumString)));
    		if ($game_week == ($this_week-1)){
    			array_push($prev_week_matches, $match);
    		}
    	}

    	return VBLmatch::orderMatchesByDayThenHour($prev_week_matches);
    }
}