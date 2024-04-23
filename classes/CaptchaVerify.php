<?php
use ReCaptcha\ReCaptcha;
use ReCaptcha\Response;

require 'vendor/autoload.php';

require_once "../conf/config.php";

class CaptchaVerify{
    private $secret;
    private $response;
    private $remote_ip;
    private $recaptcha;
    private $resp;
    
    public function __construct(string $response, string $remote_ip){
        $this->secret = RECAPTCHA_SECRET;
        $this->response = $response;
        $this->remote_ip = $remote_ip;
        $this->recaptcha = new ReCaptcha($this->secret);
        $this->resp = $this->recaptcha->verify($this->response, $this->remote_ip);
    }
    
    public function is_success(): bool{
        return $this->resp->isSuccess();
    }
    
    public function get_error_codes(): array{
        return $this->resp->getErrorCodes();
    }
    
    public function get_response(): string{
        return $this->response;
    }
    
    public function get_remote_ip(): string{
        return $this->remote_ip;
    }
    
    public function get_secret(): string{
        return $this->secret;
    }
    
    public function get_resp(): Response{
        return $this->resp;
    }
}