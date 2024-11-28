<?php

require_once 'vendor/autoload.php';
session_start();

$client = new Google_Client();
$client->setClientId(getenv('GOOGLE_CLIENT_ID'));
$client->setClientSecret(getenv('GOOGLE_CLIENT_SECRET'));
$client->setRedirectUri('https://pagina-figuras-i-8516f9d2aea7.herokuapp.com/callback.php');
$client->addScope('email');
$client->addScope('profile');

if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $client->setAccessToken($token);

    // Obtener datos del usuario de Google
    $oauth = new Google_Service_Oauth2($client);
    $googleUser = $oauth->userinfo->get();

    // Guardar información del usuario en la sesión
    $_SESSION['username'] = $googleUser->name;
    $_SESSION['email'] = $googleUser->email;

    // Redirigir al dashboard o welcome.php
    header('Location: welcome.php');
    exit();
} else {
    echo 'Error al autenticar con Google.';
}

?>