<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$mail = new PHPMailer(true);

if(isset($_POST['sender']) && isset($_POST['subject']) && isset($_POST['message'])){
    $sender = htmlspecialchars($_POST['sender']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = $_POST['message'];

    $emails = file('emailsBase.txt', FILE_IGNORE_NEW_LINES);

    $mail->isSMTP();
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587;
    $mail->SMTPAuth = true;
    $mail->Username = 'npofa4ok@gmail.com';
    $mail->Password = 'kirill03011999catz';
    $mail->addReplyTo($sender, 'Kirill');
    $mail->setFrom($sender, 'Kirill');
    $mail->Subject = $subject;
    $mail->msgHTML($message);
    
    if (isset($_FILES['myFile']) && $_FILES['myFile']['error'] == UPLOAD_ERR_OK) {
        $mail->AddAttachment($_FILES['myFile']['tmp_name'],
                         $_FILES['myFile']['name']);
    }

    foreach ($emails as $email) {
        $mail->addAddress($email);
    }

    if($mail->send()){
        echo "Success";
    }else {
        echo "Failed...";
    }

}else{
    echo "Something wrong...";
}