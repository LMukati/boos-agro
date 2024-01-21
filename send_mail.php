<?php
use src\PHPMailer;
use src\Exception;

require 'src/Exception.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php';
//use src\PHPMailer;
//use src\Exception;
// require_once('PHPMailer-5.2.24/class.phpmailer.php');
// require_once('PHPMailer-5.2.24/class.smtp.php');
// //require 'src/SMTP.php';

$mail = new PHPMailer();
// //try {
//     //Server settings
    $mail->isSMTP();
    $mail->SMTPDebug = 0;
    $mail->Debugoutput = 'html';
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587;
    $mail->SMTPSecure = 'tls';
    $mail->SMTPAuth = true;
    $mail->Username = 'abhijeet@walkingdreamz.com';
    $mail->Password = 'abhijeet123#';
    $mail->setFrom('abhijeet@walkingdreamz.com');
    $mail->addAddress('amitsolanki@walkingdreamz.com', 'To');
    $mail->Subject = 'Testing';
    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
 
    if(!$mail->send()) {
        echo 'Message Error'. $mail->ErrorInfo;
    } else {
        echo 'Message Sent';
    }

// $to = "amitsolanki@walkingdreamz.com";
// $subject = "Hi!";
// $body = "Hi,\n\nHow are you?";
// if (mail($to, $subject, $body)) {
// echo("<p>Email successfully sent!</p>");
// } else {
// echo("<p>Email delivery failed…</p>");
// }
?>