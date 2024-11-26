<?php
// webhook.php
require 'config.php';

$endpoint_secret = 'YOUR_ENDPOINT_SECRET'; // Reemplaza con tu endpoint secret de Stripe
$payload = @file_get_contents('php://input');
$sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
$event = null;

try {
    $event = \Stripe\Webhook::constructEvent(
        $payload,
        $sig_header,
        $endpoint_secret
    );
} catch (\UnexpectedValueException $e) {
    // Payload inválido
    http_response_code(400);
    exit();
} catch (\Stripe\Exception\SignatureVerificationException $e) {
    // Firma no válida
    http_response_code(400);
    exit();
}

// Manejar diferentes tipos de eventos
if ($event->type == 'invoice.payment_succeeded') {
    $paymentIntent = $event->data->object;
    // Lógica para cuando un pago es exitoso
} elseif ($event->type == 'invoice.payment_failed') {
    $paymentIntent = $event->data->object;
    // Lógica para cuando un pago falla
}

http_response_code(200);
?>