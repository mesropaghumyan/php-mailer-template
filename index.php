<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use Dotenv\Dotenv;

require __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

if ($argc !== 3) {
    echo "Usage: php mailer/index.php <attachment_name> <attachment_path>\n";
    exit(1);
}

$attachment_name = $argv[2];
$attachment_path = $argv[3];

try {
    $mail = new PHPMailer(true);
    $mail->CharSet = 'UTF-8';
    $mail->Encoding = 'base64';
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->isSMTP();
    $mail->Host       = getenv('SMTP_HOST');
    $mail->SMTPAuth   = true;
    $mail->Username   = getenv('SMTP_USERNAME');
    $mail->Password   = getenv('SMTP_PASSWORD');
    $mail->Port       = getenv('SMTP_PORT');

    $mail->ClearAddresses();
    $mail->setFrom("sender@mail.com", "Sender");
    $mail->addAddress("recipient1@mail.com");
    $mail->addAddress("recipient2@mail.com");
    $mail->addAttachment($attachment_path, $attachment_name);

    $mail->isHTML(true);
    $mail->Subject = 'Your subject';
    $mail->Body    = '
        <div>
            <p>Hello world,</p>
            <p>Lorem ipsum dolores ...</p>
            <p>Best regards,</p>
            </br>
            <p>Sender</p>
        </div>
    ';

    if (!$mail->send()) {
        echo 'Error with email submitting : ' . $mail->ErrorInfo . "\n";
    } 
    else {
        echo 'Email sended' . ".\n";
    }
    
    $mail->clearAttachments();
} 
catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
