<?php

namespace LaravelFCM;
use Google\Client;
use Illuminate\Support\Manager;
use Google\Service\FirebaseCloudMessaging;
class FCMManager extends Manager
{
    public function getDefaultDriver()
    {
        return $this->container[ 'config' ][ 'fcm.driver' ];
    }

    protected function createHttpDriver()
    {
        $config = $this->container[ 'config' ]->get('fcm.http', []);

        $client =  new Client(['timeout' => $config[ 'timeout' ]]);

        $serviceAccount = json_decode(file_get_contents($config['service_account']), true);       
        $client->setAuthConfig($serviceAccount);
        $client->addScope(FirebaseCloudMessaging::CLOUD_PLATFORM);
        $httpClient = $client->authorize();

        return $httpClient;
    }
}
