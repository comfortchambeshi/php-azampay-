<?php
$url = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
if (strpos($url, 'dashboard') !== false) {
    $path = "../PHPMailer/";
}else{
    $path = "PHPMailer/";
}
include(''.$path.'/PHPMailerAutoload.php');
class Mail {
    public static $security = "ssl";
    public static $host = "premium75.web-hosting.com";
    public static $port = "465";
    public static $username = "auto@nyimboo.com";
    public static $password = "Hs87834673?;";
    public static $setFrom = "auto@nyimboo.com";

    public static function sendMail($subject, $body, $address) {
            $mail = new PHPMailer();
            $mail->isSMTP();
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = self::$security;
            $mail->Host = self::$host;
            $mail->Port = self::$port;
            $mail->isHTML();
            $mail->Username = self::$username;
            $mail->Password = self::$password;
            $mail->SetFrom(self::$setFrom );
            $mail->Subject = $subject;
            $mail->Body = $body;
            $mail->AddAddress($address);

            $mail->Send();
    }
}

