<?php

namespace App\Libraries;

class VBLrangschikking{
	public $json;
	public $guid;
	public $naam;
	public $poules;
	public $spelers;
	public $tv;


	public function __construct($json) {
		$data = ((array) json_decode($json));
		$data = (array) $data[0];
		$this->json =$json;




		$this->guid = $data["guid"];
		$this->naam = $data["naam"];
		$this->poules = turnToPouleArray($data["poules"]);
		$this->spelers = $data["spelers"];
		$this->tv = $data["tvlijst"];
	}

	public function __toString() {
   		return $this->json;
	}
}