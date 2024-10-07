<?php
session_start();
require 'vendor/autoload.php'; // Composer autoload for Stripe and PHPMailer

use Stripe\Stripe;
use Stripe\Checkout\Session as CheckoutSession;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Your Stripe Secret Key
$stripeSecretKey = 'sk_test_4eC39HqLyjWDarjtT1zdp7dc'; // Replace with your actual secret key
Stripe::setApiKey($stripeSecretKey);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the user's email
    $email = $_POST['email'];

    if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
        echo "Your cart is empty!";
        exit();
    }

    // Calculate total amount
    $totalAmount = 0;
    foreach ($_SESSION['cart'] as $item) {
        $totalAmount += $item['price'];
    }
    
    // Convert totalAmount to cents (Stripe processes payments in cents)
    $totalAmountCents = $totalAmount * 100;

    // Create Stripe Checkout session
    try {
        $checkout_session = CheckoutSession::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => 'Photography Purchase',
                    ],
                    'unit_amount' => $totalAmountCents,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => 'http://yourwebsite.com/success.php?session_id={CHECKOUT_SESSION_ID}', // Replace with your success URL
            'cancel_url' => 'http://yourwebsite.com/cart.php', // Replace with your cancel URL
        ]);
    } catch (Exception $e) {
        echo 'Error creating Stripe session: ' . $e->getMessage();
        exit();
    }

    // Redirect to Stripe Checkout page
    header("Location: " . $checkout_session->url);
    exit();
}

// Success handler (stripe webhook)
if (isset($_GET['session_id'])) {
    $session_id = $_GET['session_id'];

    // Retrieve the session from Stripe
    $session = \Stripe\Checkout\Session::retrieve($session_id);
    $payment_status = $session->payment_status;

    if ($payment_status === 'paid') {
        // Email details for the user
        $email = $_POST['email'];

        // Prepare order summary for email
        $orderSummary = '';
        foreach ($_SESSION['cart'] as $item) {
            $orderSummary .= $item['title'] . " - $" . number_format($item['price'], 2) . "\n";
        }

        // Send confirmation email using PHPMailer
        $mail = new PHPMailer(true);
        try {
            //Server settings
            $mail->isSMTP();
            $mail->Host = 'smtp.example.com'; // Set the SMTP server to send through
            $mail->SMTPAuth = true;
            $mail->Username = 'your_email@example.com'; // SMTP username
            $mail->Password = 'your_email_password'; // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            //Recipients
            $mail->setFrom('your_email@example.com', 'McCall Southern Photography');
            $mail->addAddress($email);  // Add the user's email address

            // Content
            $mail->isHTML(true); // Set email format to HTML
            $mail->Subject = 'Order Confirmation - McCall Southern Photography';
            $mail->Body = "
                <h1>Thank you for your purchase!</h1>
                <p>Here is a summary of your order:</p>
                <pre>$orderSummary</pre>
                <p>We will deliver your photos shortly to your email!</p>
            ";
            $mail->AltBody = "Thank you for your purchase!\n\nOrder Summary:\n$orderSummary\nWe will deliver your photos shortly to your email.";

            // Send the email
            $mail->send();
            echo 'Confirmation email has been sent.';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }

        // Clear the cart after successful payment
        unset($_SESSION['cart']);

        // Show success message
        echo "Thank you for your purchase! A confirmation has been sent to your email.";
    } else {
        echo "Payment failed. Please try again.";
    }
} else {
    echo "Invalid request.";
    exit();
}
