<?php

namespace App\Http\Controllers\Mygdx;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Traits\RequestResponse;
use App\Traits\HmpkErrors;
use App\Traits\MockData;

class ClientController extends Controller {

    use RequestResponse;

    public function checkClient(Request $request) {
        $data       = json_decode($request->getContent());
        $params     = $this->validateRequest($data);
        $response   = $this->callMygdxClientCheck($data);
        // dd($response);
        return $data;
    }

    private function callMygdxClientCheck($payload) {
        $post_data = json_encode($payload);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://10.24.19.6:8080/cxf/aadkclientcheck/getAadkClientCheck',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $post_data,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }

}