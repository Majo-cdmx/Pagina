<?php

require_once 'vendor/autoload.php';

$client = new Google_Client();
$client->setClientId(getenv('GOOGLE_CLIENT_ID'));  // Configura el ID del cliente
$client->setClientSecret(getenv('GOOGLE_CLIENT_SECRET'));  // Configura el secreto del cliente
$client->setRedirectUri('https://pagina-figuras-i-8516f9d2aea7.herokuapp.com/callback.php');  // Cambia la URL según tu aplicación
$client->addScope('email');
$client->addScope('profile');

// Genera la URL de autenticación
$authUrl = $client->createAuthUrl();

// Redirige al usuario a la página de Google para iniciar sesión
header('Location: ' . filter_var($authUrl, FILTER_SANITIZE_URL));
exit;

?>