<?php

namespace App\Libraries;

class VBLteam {
	public $naam;
	public $categorie;
	public $rangNr;
	public $wedAant;
	public $wedPunt;
	public $ptVoor;
	public $ptTegen;
	public $opmerk;
	public $wedWinst;
	public $wedGelijk;
	public $wedVerloren;
	public $wedNOKD;
	public $shirtKleur;
	public $shirtReserve;
	public $guid;

	public function __construct($team) {
		$team = (array) $team;

		$this->naam = $team["naam"];
		$this->categorie= $team["categorie"];
		$this->rangNr= $team["rangNr"];
		$this->wedAant= $team["wedAant"];
		$this->wedPunt= $team["wedPunt"];
		$this->ptVoor= $team["ptVoor"];
		$this->ptTegen= $team["ptTegen"];
		$this->opmerk= $team["opmerk"];
		$this->wedWinst= $team["wedWinst"];
		$this->wedGelijk= $team["wedGelijk"];
		$this->wedVerloren= $team["wedVerloren"];
		$this->wedNOKD= $team["wedNOKD"];
		$this->shirtKleur= $team["shirtKleur"];
		$this->shirtReserve= $team["shirtReserve"];
		$this->guid= $team["guid"];
	}
}
