<?php

use GuzzleHttp\Client;
use App\Libraries\VBLapi;
use App\Libraries\VBLmatch;
use App\Libraries\VBLrangschikking;
use App\Libraries\VBLpoule;
use App\Libraries\VBLteam;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!

*/

Route::get('/', function () {


	$all_matches_of_club = VBLapi::getAllMatchesByClub();
	$this_week_matches = VBLmatch::getMatchesOfThisWeek($all_matches_of_club);
	$next_week_matches = VBLmatch::getMatchesOfNextWeek($all_matches_of_club);
	$prev_week_matches = VBLmatch::getMatchesOfPreviousWeek($all_matches_of_club);

	foreach($prev_week_matches as $past_match){
		$past_match->findComplementaryMatch($all_matches_of_club);
	}

	//$ics = createICSFromMatches($all_matches_of_club);
	//$f = fopen("testics.ics", 'w');
	//fwrite($f, $ics);

    return view('home',
    	['this_week_matches' => $this_week_matches,
    	 'next_week_matches'=> $next_week_matches,
    	 'prev_week_matches'=> $prev_week_matches
    	 ]
    	);
});

Route::get('/kalender', function () {
	$all_matches_of_club = VBLapi::getAllMatchesByClub();
	$past_matches = array_reverse(VBLmatch::splitMatchesByWeek(VBLmatch::getPastMatches($all_matches_of_club)), true);
	$future_matches = VBLmatch::splitMatchesByWeek(VBLmatch::getFutureMatches($all_matches_of_club));

	foreach($past_matches as $week){
		foreach($week as $past_match){
			$past_match->findComplementaryMatch($all_matches_of_club);
		}
	}

	foreach($future_matches as $week){
		foreach($week as $future_match){
			$future_match->findComplementaryMatch($all_matches_of_club);
		}
	}

    return view('kalender', ["past_matches" => $past_matches, "future_matches" => $future_matches]);
});

Route::get('/ploegen', function () {
    return view('ploegen');
});

Route::get('/ploeg/{id}', function ($id) {

	$parsed_id = substr($id, 0,3). "++".substr($id,-1);
	$team = VBLapi::apiCall("TeamDetailByGuid?teamGuid=".VBLapi::club_guid.$parsed_id); // rangschikking + spelers/technische vergunningen
	$res = VBLapi::apiCall("TeamMatchesByGuid?teamGuid=".VBLapi::club_guid.$parsed_id); // AllMatchesOfTeam
	$te = json_decode($res);
	$team_name = codeToName(substr($id, 0,3))." ".substr($id,-1);
	$all_matches = array();
	foreach($te as $t){
		$json_match = json_encode($t);
		$match = new VBLmatch($json_match);
		array_push($all_matches, $match);
	}

	$past_matches = array_reverse(VBLmatch::splitMatchesByWeek(VBLmatch::getPastMatches($all_matches)), true);
	$future_matches = VBLmatch::splitMatchesByWeek(VBLmatch::getFutureMatches($all_matches));

	$VBLrangschikking = new VBLrangschikking($team);


return view('ploeg', ['past_matches' => $past_matches, 'future_matches' => $future_matches,'team_name' => $team_name, 'team_id' => $id, 'rangschikking' => $VBLrangschikking]); }); Route::get('/contact', function () { return view('home'); });

Route::get('/contact/', function () {
	return view('contact');
});
	



//***********************************************************************************


function codeToName($code){

	$arr = Helpers::teamCodeToName();
	if (array_key_exists($code, $arr)){
		return $arr[$code];
	} else {
		return $code;
	}


}

function turnToPouleArray($poules){
	$ret = array();
	foreach($poules as $poule) {
		$p = new VBLpoule($poule);
		array_push($ret, $p);
	}
	return $ret;
}


function turnToTeamArray($teams){
	$ret = array();
	foreach($teams as $team) {
		$p = new VBLteam($team);
		array_push($ret, $p);
	}
	return $ret;
}


function createICSFromMatches($matches){
	define('DATE_ICAL', 'Ymd\THis\ZO');
	$output = "BEGIN:VCALENDAR\r\n";
	$output .= "VERSION:2.0\r\n";
	foreach($matches as $match){
		$DTSTAMPDate = date_create_from_format('d-m-Y G.i', $match->datumString." ".$match->beginTijd );
		$DTEND = date_create_from_format('d-m-Y G.i', $match->datumString." ".$match->beginTijd );
		$name = "";
		if ($match->homeGame)
			$name .= "THUIS ";
		else
			$name .= "UIT ";
		$name .= "VS ";
		if ($match->homeGame)
			$name .= $match->tUNaam;
		else
			$name .= $match->tTNaam;
		try{
			date_add($DTEND, new DateInterval('PT2H'));
			$output .= "BEGIN:VEVENT\r\n";
			$output .= "UID:$match->guid@ttturnhout.be\r\n";
			$output .= "DTSTAMP:".date(DATE_ICAL, date_timestamp_get($DTSTAMPDate))."\r\n";
			$output .= "DTSTART:".date(DATE_ICAL, date_timestamp_get($DTSTAMPDate))."\r\n";
			$output .= "DTEND:".date(DATE_ICAL, date_timestamp_get($DTEND))."\r\n";
			$output .= "SUMMARY:".$name."\r\n";
			$output .= "END:VEVENT\r\n";
		} catch (Exception $e) {
			//echo "<pre>";
			//var_dump($match);
			//echo "</pre>";
		}
	}
	$output .= "END:VCALENDAR";
	return $output;
}

