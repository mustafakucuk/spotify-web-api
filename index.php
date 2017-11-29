<?php 
session_start();

require "SpotifyWebAPIException.php";
require "Request.php";
require "Session.php";
require "SpotifyWebAPI.php";


$session = new SpotifyWebAPI\Session('cliend_id', 'client_secret', 'callback_url');
$scopes = array(
	'playlist-read-private',
	'user-read-private',
	'playlist-modify-public',
	'user-library-read',
	'user-read-email',
	'user-read-recently-played'
);
$authorizeUrl = $session->getAuthorizeUrl(array(
	'scope' => $scopes
));

$api = new SpotifyWebAPI\SpotifyWebAPI();
$accessToken = $_SESSION['spotifyToken'];
$api->setAccessToken($accessToken);
if( isset($_SESSION["spotifyToken"]) ){
	$playlist = $api->getUserPlaylists($api->me()->id,[
		"limit" => 50
	]);

	foreach($playlist->items as $list){
		echo $list->name." ".$list->id."<br>";
	}

	$search = $api->search("angel","track");
	foreach($search->tracks->items as $lista){
		print_r($lista->name);
	}
}else{
	header("Location:login.php");
}
