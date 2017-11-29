<?php
session_start();
require "SpotifyWebAPIException.php";
require "Request.php";
require "Session.php";
require "SpotifyWebAPI.php";

$session = new SpotifyWebAPI\Session('cliend_id', 'client_secret', 'callback_url');
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
