<?php
require_once "../conf/config.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// this class is an interface for sending emails to change password / reveal the user id if forgotten
// as for now, it remains unfinished, although i'll just call it work in proggress :)
// TODO: finish the class
class SendMail{
    private $target_address;
    private $target_name;
    private $sender_address;
    private $sender_host;
    private $sender_port;
    private $sender_password;

    private $sendmail_exception;

    private $mail = new PHPMailer(true);
    
    public function __construct(string $target_address,string $target_name = SITENAME . "User", string $sender_address = SITE_EMAIL_ADDRESS, string $sender_host = SITE_EMAIL_HOST, string $sender_port = SITE_EMAIL_PORT, string $sender_password = SITE_EMAIL_PASSWORD): void{
        $this->target_address = $target_address;
        $this->sender_address = $sender_address;
        $this->sender_host = $sender_host;
        $this->sender_port = $sender_port;
        $this->sender_password = $sender_password;
        $this->target_name = $target_name;
    }

    public function get_sendmail_exception(): Exception{
        return $this->sendmail_exception;
    }

    public function send_mail(string $subject, string $body, string $altbody): bool{
        try{
            //Setup
            $this->mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $this->mail->isSMTP();                                            //Send using SMTP
            $this->mail->Host       = $this->sender_host;                     //Set the SMTP server to send through
            $this->mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $this->mail->Username   = $this->sender_address;                     //SMTP username
            $this->mail->Password   = $this->sender_password;                               //SMTP password
            $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $this->mail->Port       = $this->sender_port;

            //Recipients
            $this->mail->setFrom($this->sender_address, SITE_EMAIL_NAME);
            $this->mail->addAddress($this->target_address, $this->target_name);     //Add a recipient

            //Content
            $this->mail->isHTML(true);                                  //Set email format to HTML
            $this->mail->Subject = $subject;
            $this->mail->Body    = $body;
            $this->mail->AltBody = $altbody;

            $this->mail->send();
            return true;
        } catch (Exception $e) {
            $this->sendmail_exception = $e;
            return false;
        }
    }
}
