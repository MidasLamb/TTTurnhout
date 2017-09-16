<?php

namespace App\Libraries;


class VBLpoule {
	public $naam;
	public $sort;
	public $teams;
	public $categorie;
	public $regioGUID;
	public $regioNaam;
	public $guid;

	public function __construct($poule) {
		$poule = (array) $poule;

		$this->naam = $poule["naam"];
		$this->sort = $poule["sort"];
		$this->teams = turnToTeamArray($poule["teams"]);
		$this->categorie = $poule["categorie"];
		$this->regioGUID = $poule["regioGUID"];
		$this->regioNaam = $poule["regioNaam"];
		$this->guid = $poule["guid"];
	}
}
