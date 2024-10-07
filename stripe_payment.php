<?php
require 'vendor/autoload.php';

\Stripe\Stripe::setApiKey('your_stripe_secret_key');

// Retrieve POST variables from the form
$photo_id = $_POST['photo_id'];
$photo_title = $_POST['photo_title'];
$photo_price = $_POST['photo_price'] * 100; // Stripe accepts payments in cents

// Create a new checkout session
$session = \Stripe\Checkout\Session::create([
    'payment_method_types' => ['card'],
    'line_items' => [[
        'price_data' => [
            'currency' => 'usd',
            'product_data' => [
                'name' => $photo_title,
            ],
            'unit_amount' => $photo_price,
        ],
        'quantity' => 1,
    ]],
    'mode' => 'payment',
    'success_url' => 'https://yourwebsite.com/success.php',
    'cancel_url' => 'https://yourwebsite.com/cancel.php',
]);

// Redirect to Stripe checkout
header("Location: " . $session->url);
exit;
?>
