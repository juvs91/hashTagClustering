<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	$stmtlk = "https://store.apicultur.com/api/stmtlk/1.0.0/valoracion/tweet/10";
	$tweets = (array) Twitter::getSearch(array(
		'q' => 'margarita arellanes',
		'count' => '50',
		'geocode' => '25.666667,-100.3,250km'
		));
	$results = array();
	$client = new Guzzle\Http\Client($stmtlk);
	$pos = array();
	$neg = array();
	$neut = array();

	foreach ($tweets['statuses'] as $status) {
		$result = $client->post($stmtlk, array(
			'Authorization' => 'Bearer GPZoWqJIY7WqmWW6ShMiRymcy8oa',
			'Content-Type' => 'application/json'
		), json_encode(array("texto" => $status->text)))->send()->json();
		if(isset($result['ponderacion'])) {
			if($result['ponderacion'] == "POSITIVA") $pos[] = $result;
			if($result['ponderacion'] == "NEGATIVA") $neg[] = $result;
			if($result['ponderacion'] == "NEUTRA") $neut[] = $result;
		} else {
			Log::info($result);
		}

		$results[] = $result;
	}

	//$status = array_fetch($tweets['statuses'], 'text');
	return View::make('hello')
		->with('tweets', $results)
		->with('feelings', array(
				'positiva' => count($pos),
				'negativa' => count($neg),
				'neutra' => count($neut)
				)
		);
});