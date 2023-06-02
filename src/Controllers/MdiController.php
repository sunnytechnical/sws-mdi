<?php
namespace Sws\Mdi\Controllers;

use Illuminate\Http\Request;
use Sws\Mdi\Mdi;

class MdiController
{
    public $baseUrl;
    /**
     * Instantiate a new controller instance.
     */
    public function __construct() {
        $this->baseUrl = Config::get('constant.BASEURL');
    }

    public function createPatient(Request $request) {
        
        $mdiObject = New Mdi('abc','tyu', $this->baseUrl);
        $response = $mdiObject->addPatient('patients',[],[]);
        dd($response);
    }
}