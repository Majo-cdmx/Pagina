<?php
// createSubscription.php
require 'config.php';

header('Content-Type: application/json');

try {
    $data = json_decode(file_get_contents('php://input'), true);

    $subscription = \Stripe\Subscription::create([
        'customer' => $data['customer_id'],
        'items' => [
            ['price' => $data['price_id']]
        ],
        'expand' => ['latest_invoice.payment_intent'],
    ]);

    echo json_encode(['subscription_id' => $subscription->id]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
?>