<?php
session_start();
require "SpotifyWebAPIException.php";
require "Request.php";
require "Session.php";
require "SpotifyWebAPI.php";

$session = new SpotifyWebAPI\Session('10d630ae31a2422c91ead90a79922f1f', 'c32786b8e3064c34a3b0e16e5e6855d8', 'http://localhost:8888/spotify/login.php/');
$api = new SpotifyWebAPI\SpotifyWebAPI();

  if (isset($_GET["code"])) {
      $session->requestAccessToken($_GET["code"]);
      $_SESSION['spotifyToken'] = $session->getAccessToken();
      header("Location:/spotify/index.php");

  } else {
      $scopes = [
      'scope' => [
        'playlist-read-private',
        'user-read-private',
        'playlist-modify-public',
        'user-library-read',
        'user-read-email',
        'user-read-recently-played'
         ],
      ];
      header('Location: ' . $session->getAuthorizeUrl($scopes));
  }


?>