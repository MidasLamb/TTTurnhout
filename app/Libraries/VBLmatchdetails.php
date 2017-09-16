<?php

namespace App\Libraries;

class VBLmatchdetails{
	public $adres;

	public function __construct($place_guid) {
		$res = VBLapi::apiCall("MatchesByWedGuid?issguid=".$place_guid);
		$arr = json_decode(json_encode(json_decode($res)[0]), True)["doc"];

		$accommodatieDoc = $arr["accommodatieDoc"];
		$adresArr = $accommodatieDoc["adres"];
		$this->adres = $adresArr["straat"]. " " . $adresArr["huisNr"] . $adresArr["huisNrToev"] . " " .$adresArr["plaats"]. " " . $adresArr["postcode"];
	}
}