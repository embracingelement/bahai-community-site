<?php
/**
 * Created by PhpStorm.
 * User: dominic_scimeca
 * Date: 9/19/17
 * Time: 9:32 PM
 */

namespace Email;


class EmailService
{
    public function sendEmail($to, $from, $subject, $body){
        $headers = 'From: '. $from . "\r\n" .
            'Reply-To: '. $from . "\r\n";
        mail($to, $subject, $body, $headers);
    }
}