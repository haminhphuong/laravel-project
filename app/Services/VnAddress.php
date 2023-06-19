<?php

namespace App\Services;

use GuzzleHttp\Client;

class VnAddress
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://thongtindoanhnghiep.co/api/',
            'timeout'  => 5.0,
            'verify' => false
        ]);
    }

    public function getProvinces()
    {
        $response = $this->client->get('city');
        $data = json_decode($response->getBody()->getContents(), true);

        return $data['LtsItem'];
    }

    public function getDistricts($province_id)
    {
        $response = $this->client->get("city/{$province_id}/district");
        return json_decode($response->getBody()->getContents(), true);
    }

    public function getWards($district_id)
    {
        $response = $this->client->get("district/{$district_id}/ward");
        return json_decode($response->getBody()->getContents(), true);
    }
}
