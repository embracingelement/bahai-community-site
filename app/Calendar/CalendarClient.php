<?php
namespace Calendar;

use Google_Client;

/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 10/17/15
 * Time: 3:22 PM
 */

class CalendarClient {

    /**
     * @var Google_Client
     */
    private $googleClient;

    function __construct(){
        $this->checkGoogleClientSecretFileExists();
        $this->checkGoogleCredentialsFileExists();
        $this->setGoogleClient();
    }

    private function checkGoogleClientSecretFileExists(){
        if (!file_exists(CLIENT_SECRET_FILE)) {
            print_r("<h3>Client Secret File doesn't exist at specified location. Talk with GOOGLE APPS Administration to file.</h3>");
            print_r("<h4>Administrators. Complete Step One of Quickstart. <br/> https://developers.google.com/google-apps/calendar/quickstart/php</h4>");
            print_r("<h4>Exiting</h4>");

            exit;
        }
    }

    private function checkGoogleCredentialsFileExists(){
        if (!file_exists(CREDENTIALS_FILE)) {
            print_r("<h3>Run 'php getting_started/quickstart.php' to setup configuration file</h3>");

            exit;
        }
    }

    private function setGoogleClient(){
        $client = new Google_Client();
        $client->setApplicationName(APPLICATION_NAME);
        $client->setScopes(SCOPES);
        $client->setAuthConfig(CLIENT_SECRET_FILE);
        $client->setAccessType('offline');
        $client->setPrompt('select_account consent');

        $this->setAccessToken($client);
        $this->refreshAuthToken($client);

        $this->googleClient = $client;
    }

    private function setAccessToken(Google_Client $client){
        if (file_exists(CREDENTIALS_FILE)) {
            $accessToken = json_decode(file_get_contents(CREDENTIALS_FILE), true);
            $client->setAccessToken($accessToken);
        }
    }

    private function refreshAuthToken(Google_Client $client){
        if ($client->isAccessTokenExpired()) {
            $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
            file_put_contents(CREDENTIALS_FILE, json_encode($client->getAccessToken()));
        }
    }

    /**
     * @return mixed
     */
    public function getGoogleClient()
    {
        return $this->googleClient;
    }


}