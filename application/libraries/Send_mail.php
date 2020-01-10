<?php

defined('BASEPATH') OR exit('No direct script access allowed');

use \SendGrid\Mail\Mail;
use \SendGrid\Mail\Attachment;

class Send_mail
{
    public function send_to($send_to, $subject, $message, $attachment_data = array())
    {
        $email = new Mail(); 
        $email->setFrom("noreply@ecommerce.com", EMAIL_FROM);
        $email->setSubject($subject);
        $email->addTos($send_to);
        $email->addContent(
            "text/html", $message
        );

        if(!empty($attachment_data))
        {
            $attachment = new Attachment();
            $attachment->setContent($attachment_data['content']);
            $attachment->setType($attachment_data['type']); //application/pdf
            $attachment->setFilename($attachment_data['name']);
            $attachment->setDisposition("attachment");
            $attachment->setContentId("Invoice");
            $email->addAttachment($attachment);   
        }

        $sendgrid = new \SendGrid(SENDGRID_API_KEY);
        try {
            $response = $sendgrid->send($email);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}
