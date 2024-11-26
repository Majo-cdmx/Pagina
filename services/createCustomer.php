<?php
// createCustomer.php
require 'config.php';

header('Content-Type: application/json');

try {
    $data = json_decode(file_get_contents('php://input'), true);
    $customer = \Stripe\Customer::create([
        'email' => $data['email'],
        'name' => $data['name'],
        'payment_method' => $data['payment_method'],
        'invoice_settings' => [
            'default_payment_method' => $data['payment_method']
        ]
    ]);

    echo json_encode(['customer_id' => $customer->id]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
?>