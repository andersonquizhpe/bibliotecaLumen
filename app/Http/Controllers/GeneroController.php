<?php

namespace App\Http\Controllers;

use App\Genero;
use App\Http\Helper\ResponseBuilder;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;

class GeneroController extends BaseController
{
    public function getGeneros(Request $request){
        if($request->isJSon()){
            $genero = Genero::all();
            return response()->json($genero, 200);
        }else{
            $status = false;
            $info = "Unathorized";
        }
        return ResponseBuilder::result($status, $info);
    }

    public function getOneGenero(Request $request, $id){
        if($request->isJSon()){
            $genero = Genero::where('genero_id',$id)->get();
            if(!$genero->isEmpty()){
                $status = true;
                $info = "Data is listed successfully";
            }else{
                $status=false;
                $info = "Data could not be found";
            }
            return ResponseBuilder::result($status,$info,$genero);
        }else{
            $status = false;
            $info = "Unathorized";
        }
        return ResponseBuilder::result($status, $info);
    }

    public function createGenero(Request $request){
        if($request->isJson()){
            $genero = new Genero();
            $genero->nombre = $request->nombre;
            $genero->save();
            return response()->json($genero, 200);
        }else{
            $status = false;
            $info = "Unathorized";
        }
        return ResponseBuilder::result($status, $info);
    }

    public function updateGenero(Request $request, $id){
        $genero = Genero::where('genero_id',$id)->first();

        if(!empty($genero)){
            $genero->nombre = $request->nombre;
            $genero->save();
            return response()->json($genero);
        }else{
            $status = false;
		   $info = 'Data does not exist';
        }
        return ResponseBuilder::result($status, $info);
    }

    public function deleteGenero(Request $request, $id){
        $genero = Genero::where('genero_id', $id)->first();
        if(!empty($genero)){
            $genero->delete();
            $status=true;
            $info="Data was deleted";
            return ResponseBuilder::result($status,$info);
        }else{
            $status = false;
		    $info = 'Data does not exist';
        }
        return ResponseBuilder::result($status, $info);
    }
}
