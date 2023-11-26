<?php

namespace Model;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/../../vendor/phpmailer/src/Exception.php';
require __DIR__ . '/../../vendor/phpmailer/src/PHPMailer.php';
require __DIR__ . '/../../vendor/phpmailer/src/SMTP.php';

defined('ROOTPATH') or exit('Access Denied!');

class Mail
{
    use Model;

    public function generateAndSendOTP($user)
    {
        $otp = mt_rand(100000, 999999);

        $userModel = new User();
        $userModel->updateOtp($user->id, $otp);

        $this->sendOTPEmail($user->email, $otp);
    }

    private function sendOTPEmail($toEmail, $otp)
    {
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // SMTP server
            $mail->SMTPAuth = true;
            $mail->Username = 'nguyenminhacc256@gmail.com';
            $mail->Password = 'hmzemcyqmrismatb';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            //Recipients
            $mail->setFrom('nguyenminhacc256@gmail.com', 'Biomap Admin');
            $mail->addAddress($toEmail);

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'OTP for Password Reset';
            $mail->Body    = 'Your OTP is: ' . $otp;

            $mail->send();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}
