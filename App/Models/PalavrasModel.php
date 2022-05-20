<?php

namespace App\Models;

use App\Abstracts\AbstractModel;
use PDO;

class PalavrasModel extends AbstractModel
{
    private string $baseUri;

    public function __construct()
    {
        parent::__construct();
        $this->baseUri = 'http://dicionario-aberto.net/search-json';
    }

    private function executaRequest(string $endpoint, array $params = [], string $method = 'GET')
    {
        $url = $this->baseUri . $endpoint;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
//        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
//            'Content-Type: application/x-www-form-urlencoded',
//            'Authorization: Bearer ' . $this->apiKey
//        ));
        $response = curl_exec($ch);
        curl_close($ch);
        return json_decode($response);
    }

    public function getPalavra()
    {

    }
}
