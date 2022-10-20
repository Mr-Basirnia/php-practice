<?php

namespace App\Helpers;

use App\Exceptions\ConfigFileNotFoundException;
use GuzzleHttp\Client;

class HttpClient extends Client
{
    /**
     * @throws ConfigFileNotFoundException
     */
    public function __construct()
    {
        $config = Config::get('app');

        parent::__construct([
            'base_uri' => $config['base_uri']
        ]);
    }
}