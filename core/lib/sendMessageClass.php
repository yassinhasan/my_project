<?php
namespace core\lib;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use core\app\Application;

class sendMessageClass 
{
    
    use loadingSpinnerClass;
    public $email;
    public $validate;
    public $session;
    public function __construct()
    {   
        $this->validate =   Application::$app->validate;
        $this->session = Application::$app->session;
        $this->email = new PHPMailer(true);

    }

    public function prepareMessage($data =[])
    {

            //Server settings
            $this->email->SMTPDebug = false;                      //Enable verbose debug output
            $this->email->isSMTP();                                            //Send using SMTP
            $this->email->Host       = "smtp.titan.email";                     //Set the SMTP server to send through
            $this->email->SMTPAuth   = true;                                   //Enable SMTP authentication
            $this->email->Username   = "me@smsm14.com";                     //SMTP username
            $this->email->Password   =  "@Ym123456";                               //SMTP password
            $this->email->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $this->email->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        
            //Recipients
            $this->email->setFrom("me@smsm14.com", 'MVC Project');
            $this->email->addAddress($data['to'], $data['to_name']);     //Add a recipient
            //'marwamedhat87@gmail.com'
            // $this->email->addAddress('ellen@example.com');               //Name is optional
            // $this->email->addReplyTo('info@example.com', 'Information');
            // $this->email->addCC('cc@example.com');
            // $this->email->addBCC('bcc@example.com');
        
            //Attachments
            // $this->email->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            // $this->email->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
        
            //Content
            $this->email->isHTML(true);                                  //Set email format to HTML
            $this->email->Subject = $data['subject'];
            $this->email->Body    = $data['body'];
            $this->email->AltBody    = $data['alt_body'];
    }
    public function send()
    {
        try {
           if( $this->email->send())
            {
               return true;
            }
           
        } catch (\Exception $e) {
           $this->validate->addCustomError("email" , "Message could not be sent" , $e->getMessage());
         return false;
        }
    }
}