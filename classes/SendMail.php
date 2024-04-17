<?php
require_once "../conf/config.php";

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

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

    private $mail;
        
    /**
     * __construct
     *
     * @param  string $target_address Recipient's e-mail address
     * @param  string $target_name Recipient's name
     * @param  string $sender_address Server's e-mail address
     * @param  string $sender_host Server's SMTP host
     * @param  string $sender_port Server's SMTP port
     * @param  string $sender_password Server's e-mail account password
     * @return void
     */
    public function __construct(string $target_address,string $target_name = SITENAME . "User", string $sender_address = SITE_EMAIL_ADDRESS, string $sender_host = SITE_EMAIL_HOST, string $sender_port = SITE_EMAIL_PORT, string $sender_password = SITE_EMAIL_PASSWORD){
        $this->target_address = $target_address;
        $this->sender_address = $sender_address;
        $this->sender_host = $sender_host;
        $this->sender_port = $sender_port;
        $this->sender_password = $sender_password;
        $this->target_name = $target_name;
    }
    
    /**
     * get_sendmail_exception
     *
     * @return Exception Last noted exception
     */
    public function get_sendmail_exception(): Exception{
        return $this->sendmail_exception;
    }
    
    /**
     * send_mail
     *
     * @param  mixed $subject Subject
     * @param  mixed $body Body
     * @param  mixed $altbody No HTML Body
     * @return bool Returns true if e-mail was sent successfully and false if sending has failed. Failure reason can be obtained by calling get_sendmail_exception()
     */
    public function send_mail(string $subject, string $body, string $altbody): bool{
        try{
            $this->mail = new PHPMailer(true);
            //Setup
                     //Enable verbose debug output
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
    /**
     * remind_user_id
     *
     * @param  mixed $uid User ID
     * @return bool Returns true if e-mail was sent successfully and false if sending has failed. Failure reason can be obtained by calling get_sendmail_exception()
     */
    public function remind_user_id(string $uid): bool{
        $template_file_path = '..\assets\email-templates\remind-user-id.html';
        $template_file = fopen($template_file_path, 'r');
        $template_text = fread($template_file, filesize($template_file_path));

        $subject = "Reminder of Your User ID";
        $body = str_replace("%", $uid, $template_text);
        $altbody = $body;

        if($this->send_mail($subject, $body, $altbody)){
            return true;
        }
        return false;
    }
    
    /**
     * send_reset_password
     *
     * @param  mixed $pwd_link Password reset link
     * @return bool Returns true if e-mail was sent successfully and false if sending has failed. Failure reason can be obtained by calling get_sendmail_exception()
     */
    public function send_reset_password(string $pwd_link): bool{
        $template_file_path = '..\assets\email-templates\reset-password.html';
        $template_file = fopen($template_file_path, 'r');
        $template_text = fread($template_file, filesize($template_file_path));
        
        $subject = "Your password reset link";
        $body = str_replace("%", $pwd_link, $template_text);
        $altbody = $body;
        if($this->send_mail($subject, $body, $altbody)){
            return true;
        }
        return false;
    }
}
