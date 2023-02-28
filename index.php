<?php

declare(strict_types=1);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


require 'vendor/autoload.php';


// Load .env
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();


// receiver
$receiver1 = "anamarieterante143@gmail.com";

// subject
$subject = "Testing email";

// use wordwrap() if lines are longer than 70 characters
$body ="<h1>Test email using mailtrap and PHPMailer library</h1>";


try {
    //Server settings
    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = $_ENV['MAIL_HOST'];
    $mail->SMTPAuth = true;
    $mail->Port = $_ENV['MAIL_PORT'];
    $mail->Username = $_ENV['MAIL_USERNAME'];
    $mail->Password = $_ENV['MAIL_PASSWORD'];

    //Recipients
    $mail->setFrom('support@rtnhs.org', 'Mailer');
    $mail->addAddress($receiver1, 'AM Terante');     //Add a recipient
    // $mail->addAddress('ellen@example.com');               //Name is optional
    // $mail->addReplyTo('info@example.com', 'Information');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    //Attachments
    $filename = 'ANA MARIE EMPLOYMENT CONTRACT.pdf';
    //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    $mail->addAttachment('attachments/employment_contract.pdf', $filename);    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = $subject;
    $mail->Body    = $body;
    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();

    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
