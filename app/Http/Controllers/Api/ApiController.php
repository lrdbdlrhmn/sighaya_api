<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApiController
{
    public function user_info($vref)
    {
        try {

            $client = new \GuzzleHttp\Client();
            $res = $client->request('GET', 'http://snde.mr:8083/api/get-info-user?vref=' . $vref, [
                'auth' => ['newsndemobile', 'yKAFP9hmZARNnCm']
            ]);
            if ($res->getStatusCode() == 200) {
                return json_decode($res->getBody(), true);
            }
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function user_status($vref)
    {
        try {
            $client = new \GuzzleHttp\Client();
            $res = $client->request('GET', 'http://snde.mr:8083/api/get-statuts-ref?vref=' . $vref, [
                'auth' => ['newsndemobile', 'yKAFP9hmZARNnCm']
            ]);

            if ($res->getStatusCode() == 200) {
                return json_decode($res->getBody(), true);
            }
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function header_with_details($vref)
    {
        try {
            $client = new \GuzzleHttp\Client();
            $res = $client->request('GET', 'http://snde.mr:8083/api/get-fact-header-detail?vref=' . $vref, [
                'auth' => ['newsndemobile', 'yKAFP9hmZARNnCm']
            ]);

            if ($res->getStatusCode() == 200) {
                return json_decode($res->getBody(), true);
            }
        } catch (\Exception $e) {
            return $e;
        }
    }
    public function header($vref)
    {
        try {
            $client = new \GuzzleHttp\Client();
            $res = $client->request('GET', 'http://snde.mr:8083/api/get-fact-header?vref=' . $vref, [
                'auth' => ['newsndemobile', 'yKAFP9hmZARNnCm']
            ]);

            if ($res->getStatusCode() == 200) {
                return json_decode($res->getBody(), true);
            }
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function details($vref)
    {
        try {
            $client = new \GuzzleHttp\Client();
            $res = $client->request('GET', 'http://snde.mr:8083/api/get-fact-detail?vref=' . $vref, [
                'auth' => ['newsndemobile', 'yKAFP9hmZARNnCm']
            ]);

            if ($res->getStatusCode() == 200) {
                return json_decode($res->getBody(), true);
            }
        } catch (\Exception $e) {
            return $e;
        }
    }
}
