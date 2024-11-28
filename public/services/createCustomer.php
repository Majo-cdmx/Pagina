<?php
// createCustomer.php
require '../../config/config.php';

header('Content-Type: application/json');

try {
    $data = json_decode(file_get_contents('php://input'), true);

    // Verificar que los datos requeridos están presentes
    if (empty($data['email']) || empty($data['name']) || empty($data['payment_method'])) {
        throw new Exception('Faltan datos requeridos para crear el cliente.');
    }

    // Crear cliente usando Stripe API
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
    error_log("Error en createCustomer.php: " . $e->getMessage()); // Registrar el error en los logs del servidor
    echo json_encode(['error' => $e->getMessage()]);
}
?>