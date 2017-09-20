<?php
/**
 * Created by PhpStorm.
 * User: dominic_scimeca
 * Date: 9/19/17
 * Time: 9:40 PM
 */

require __DIR__.'/../vendor/autoload.php';

use Email\EmailService;

function httpPost($url, $data)
{
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($curl);
    curl_close($curl);
    return $response;
}

function get_client_ip() {
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}


if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    $data = [
        "secret" => "6LdJXjEUAAAAAJ7h2rkeqxnkCL80FtaOyd-8cjQY",
        "response" => $_POST['g-recaptcha-response'],
        "remoteip" => get_client_ip()
    ];

    $response = json_decode(httpPost("https://www.google.com/recaptcha/api/siteverify", $data));
    //{
    //  "success": true,
    //  "challenge_ts": "2017-09-20T05:37:45Z",
    //  "hostname": "localhost"
    //}

    if ($response->success) {
        $emailService = new EmailService();
        $emailService->sendEmail(
            "mis@labc.org",
            $_POST['email'],
            "Mailing List Request",
            "Request from " . $_POST['email'] . ", using the form on labahais.org, to be put on the mailing list."
        );

        echo "success";
    } else {
        echo "failure";
    }
}else{
    echo "failure";
}