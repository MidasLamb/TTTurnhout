<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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

    static public function teams(){
		echo "lol";
	}

	static public function teamSenCodes(){
		$res = [
			"Seniors 1" => "HSE1",
			"Seniors 2" => "HSE2",
			"Seniors 3" => "HSE3",
			"Seniors 4" => "HSE4",
			"Dames 1" => "DSE1",
			"Dames 2" => "DSE2",
		];

		return $res;
	}

	static public function teamYouthCodes(){
		$res = [
			"U21 Juniors 1" => "J211",
			"U21 Juniors 2" => "J212",
			"U18 Kadetten" => "J181",
			"U16 Miniemen 1" => "J161",
			"U16 Miniemen 2" => "J162",
			"U14 Pupillen 1" =>  "G141",
			"U14 Pupillen 2" =>  "G142",
			"U12 Benjamins" => "G121",
			"U10 Microben 1" => "",
			"U10 Microben 2" => "",
			"U08 Premicroben" => "",

		];

		return $res;
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
	
}