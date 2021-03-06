<?php

namespace BigCommerceWordPress;

use GuzzleHttp\Client;
use GuzzleHttp\Stream\Stream;
use Bigcommerce\Api\Connection;
use Bigcommerce\Api\Client as Bigcommerce;
use BigCommerceWordPress\Configs;

class Request
{
    protected $token;
    protected $store_id;
    protected $id;
    protected $params;

    public function __construct()
    {
        $configs = new Configs;
        $params = $configs->load()['parameters'];

        if (isset($params[0]['store_id']) && isset($params[1]['token']) && isset($params[2]['id'])) {
            $this->store_id = $params[0]['store_id'];
            $this->token = $params[1]['token'];
            $this->id = $params[2]['id'];
        } else {
            $this->store_id = $params[0];
            $this->token = $params[1];
            $this->id = $params[2];
        }

        $this->configure();
    }

    private function configure()
    {
        Bigcommerce::configure(array(
            'client_id' => $this->id,
            'auth_token' => $this->token,
            'store_hash' => $this->store_id
        ));
    }
}
