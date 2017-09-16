<?php
namespace App\Libraries;

use GuzzleHttp\Client;

class VBLapi{
	// property declaration
	const club_guid = "BVBL1152";
	const base_url = "http://vblcb.wisseq.eu/VBLCB_WebService/data/";


	// method declaration
	static public function getAllMatchesByClub() {
		$res = VBLapi::apiCall("OrgMatchesByGuid?issguid=".VBLapi::club_guid);
		$matches = array();
		$te = json_decode($res);

		foreach($te as $t){
			$json_match = json_encode($t);
			$match = new VBLmatch($json_match);
			array_push($matches, $match);
		}
		return VBLmatch::orderMatchesByDayThenHour($matches);
	}

	public static function apiCall($url){
        $fileUrl = rawurlencode($url);
        if (file_exists("cache/".$fileUrl)){
            $timeSinceChangeInSeconds = time() - filemtime("cache/".$fileUrl);
            if ($timeSinceChangeInSeconds < 60*60*72) {
                $api_string = file_get_contents("cache/".$fileUrl);
                return $api_string;
            } else {
                return self::renewFileContents($url);
            }
        } else {
            return self::renewFileContents($url);
        }
    }

    private static function renewFileContents($url){
        $fileUrl = rawurlencode($url);
        $api_string = self::CallVBLSite($url);
        $f = fopen("cache/".$fileUrl, 'w');
        fwrite($f, $api_string);
        fclose($f);
        return $api_string;
    }

    private static function CallVBLSite($url){
        $client = new Client();
        $base_url = "http://vblcb.wisseq.eu/VBLCB_WebService/data/";
        $res = $client->request('GET', $base_url. $url, [
			    'headers' => [
				    "Accept" => 'application/json,text/plain,*/*'
				    ]
				]);
        $api_string = json_encode(json_decode($res->getBody()));
        return $api_string;
    }
}