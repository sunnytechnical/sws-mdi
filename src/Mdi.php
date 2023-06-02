<?php

namespace Sws\Mdi;

use Illuminate\Support\Facades\Http;

class Mdi {

    public $apiKey    = '';
    public $secretKey = '';
    public $baseUrl   = '';
    private $headers = [
        'Content-Type' => 'application/json',
        'Accept'       => 'application/json'
    ];

    /*
    * constructor
    */ 
    public function __construct($apiKey,$secretKey,$baseUrl) {
        $this->apiKey    = $apiKey;
        $this->baseUrl   = $baseUrl;
        $this->secretKey = $secretKey;
    }

    /*
    * Add Patient
    */ 
    public function addPatient($endPoint,$headers=[],$data=[]) {
        $headers = $this->mergeAllHeaders($headers);
        $requestUrl = $this->baseUrl.$endPoint;
        $response = $this->callToCurlRequest($headers,$requestUrl,$data);
        return $response;
    }

    /*
    * Merge all headers
    */
    private function mergeAllHeaders($headers) {
        $combineHeaders = [];
        if(empty($headers)) {
            $combineHeaders = $this->headers;
        } else {
            $combineHeaders = array_merge($this->headers, $headers);
        }
        return $combineHeaders;
    }

    /*
    * Main curl request
    */
    private function callToCurlRequest($headers,$url,$data) {
        return [
            'status' => 'success'
        ];
        $ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        if(empty($data)) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        }
		$response=curl_exec($ch);
		$info=curl_getinfo($ch);
		curl_close ($ch);
		return $response;
    }

}