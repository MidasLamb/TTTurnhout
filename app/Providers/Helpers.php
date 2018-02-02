<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Libraries\VBLapi;

class Helpers extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
	}
	
	public static $teamCodeToNameArray = [
		"HSE" => "Seniors",
		"DSE" => "Dames",
		"J21" => "Juniors",
		"J18"=> "Kadetten",
		"J16"=> "Miniemen Jongens",
		"M16" =>"Miniemen Meisjes",
		"G14"=> "Pupillen"  ,
		"G12"=> "Benjamins",
		"" => "Microben",
		"" => "Premicroben",
	];


	static public function teamSenCodes(){
		$allTeams = Helpers::getTeamCodes();
		$res = array();
		foreach($allTeams as $key => $val){
			if (preg_match('/(HSE.)|(DSE.)/', $val)){
				$res[$key] = $val;
			}
		}
		
		return $res;
	}

	static public function teamYouthCodes(){
		$allTeams = Helpers::getTeamCodes();
		$res = array();
		foreach($allTeams as $key => $val){
			if (!preg_match('/(HSE.)|(DSE.)/', $val)){
				$res[$key] = $val;
			}
		}
		return $res;
	}

	static public function getTeamCodes(){
		return VBLapi::getAllClubTeams();
	}

	static public function teamCodeToName(){
		$res = [
			"HSE" => "Seniors",
			"DSE" => "Dames",
			"J21" => "Juniors",
			"J18"=> "Kadetten",
			"J16"=> "Miniemen Jongens",
			"M16" =>"Miniemen Meisjes",
			"G14"=> "Pupillen"  ,
			"G12"=> "Benjamins",
			"" => "Microben",
			"" => "Premicroben",

		];
		return $res;
	}
	
	static public function teamCodeToReadableName($teamCode){
		$code = substr($teamCode, 0, 3);
		$number = substr($teamCode, 3);

		$names = Helpers::$teamCodeToNameArray;
		return $names[$code]. " " . $number;
	}
}