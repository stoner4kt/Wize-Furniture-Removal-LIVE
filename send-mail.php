<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: contact.html');
    exit;
}

$redirect = isset($_POST['_redirect']) ? trim($_POST['_redirect']) : 'thank-you.html';
if (!preg_match('/^[a-zA-Z0-9._\/-]+$/', $redirect)) {
    $redirect = 'thank-you.html';
}

if (!empty($_POST['company'])) {
    header('Location: ' . $redirect);
    exit;
}

$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$phone = trim($_POST['phone'] ?? '');
$service = trim($_POST['service'] ?? '');
$message = trim($_POST['message'] ?? '');

if ($name === '' || $email === '' || $phone === '' || $service === '' || $message === '') {
    header('Location: contact.html?status=missing');
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header('Location: contact.html?status=invalid-email');
    exit;
}

$to = 'info@wizeremoval.co.za';
$subject = 'New Quote Request - Wize Furniture Removal';

$body = "You have received a new quote request from your website.\n\n";
$body .= "Name: {$name}\n";
$body .= "Email: {$email}\n";
$body .= "Phone: {$phone}\n";
$body .= "Service: {$service}\n\n";
$body .= "Message:\n{$message}\n";

$headers = [];
$headers[] = 'From: Wize Removal Website <no-reply@wizeremoval.co.za>';
$headers[] = 'Reply-To: ' . $email;
$headers[] = 'Content-Type: text/plain; charset=UTF-8';

$mailSent = mail($to, $subject, $body, implode("\r\n", $headers));

if ($mailSent) {
    header('Location: ' . $redirect);
    exit;
}

header('Location: contact.html?status=mail-failed');
exit;
