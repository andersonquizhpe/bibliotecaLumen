<?php

namespace App\Http\Helper;

class ResponseBuilder{
    public static function result($status="", $info="", $data=""){
        return [
            "succes"=>$status,
            'information'=>$info,
            "data"=>$data
        ];
    }
}

?>