<?php  

namespace App\Http\Controllers\Aadk;

use App\Http\Controllers\Controller;
use App\Traits\RequestResponse;

class AadkClientCheckController extends Controller {

    use RequestResponse;

    public function getAddkClientCheck(){
        $data = [
            "nama_perkhidmatan"     => "Semakan Identiti Klien (Staging)",
            "kod_perkhidmatan"      => "MG_STG_AADK_R_ClientCheck",
            "agensi_pembekal"       => "Agensi Antidadah Kebangsaan",
            "akronim_agensi"        => "AADK",
            "rules"         => [
                "login"         => "Tidak berkenaan",
                "need_token"    => "Tidak berkenaan",
                "rate_limit"    => "Tidak berkenaan",
                "realtime"      => "Yes",
                "ip_based_only" => "Yes"
            ],
            "api"           => [
                "environment"           => "Staging",
                "type"                  => "Web",
                "ssl"                   => "No (http://)",
                "specific_port"         => "Yes 8080",
                "domain"                => "",
                "protocol"              => "REST (JSON)",
                "service_description"   => "Web Application Description Language (WADL)",
                "service_end_point"     => "SSL><domain>:<port>/aadkclientcheck?_wadl"
            ]
        ];
        
        $response = (object) array(
            "header" => array(),
            "response" => $data
        );
        return response()->json($this->myGdxFormat($response));
    }
}