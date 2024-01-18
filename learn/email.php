<?php
use PHPmailer\PhpMailer\PHPMailer;
use PHPmailer\PhpMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';


    $mail = new PHPMailer(true);
    $mail->isSMTP();                                      
    $mail->Host = 'smtp.gmail.com';  
    $mail->SMTPAuth = true;                               
    $mail->Username = 'eshetie674@gmail.com';             
    $mail->Password = 'qndivxbvmuoubzeg';                                                   
    $mail->SMTPSecure = 'ssl';                            
    $mail->Port = 465;
// if(isset($_POST["send"])) {
    // $mail->setFrom('eshetie674@gmail.com', 'DTU E-LEARNING SYSTEM');
    // $mail->addAddress($_POST["email"], 'DTU E-LEARNING SYSTEM');
    // $mail->isHTML(true);
    // $msg = $_POST["message"];
    // $mail->Subject = 'E-learning System Password Resetting Confirmation Code' . $random;
    // $mail->Body = 'body of the message';
    // $mail->AltBody = 'Debre Tabor University';
    // if (!$mail->send()) {
    //     echo '';
    // } else {
    //     echo'<script type="text/javascript">alert("To CONFORM PRESS OK BUTTON??!! ");window:location=\'confirmation_code.php\';</script>';
    // }
// }
?>
