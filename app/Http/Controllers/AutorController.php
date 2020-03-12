<?php

namespace App\Http\Controllers;

use App\Autor;
use App\Http\Helper\ResponseBuilder;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;

class AutorController extends BaseController
{
    public function getAutor(Request $request){
        if($request->isJson()){
            $autor = Autor::all();
                $status = true;
                $info = "Data is listed successfully";
            return ResponseBuilder::result($status, $info, $autor);
        }else{
            $status = false;
            $info = "Unathorized";
        }
        return ResponseBuilder::result($status, $info);
    }

    public function getOneAutorName(Request $request, $nombre){
        if($request->isJson()){
            //$libro = Libro:: where('titulo', 'like', '%' . $titulo . '%')->get();
            $autor =Autor::where('nombre','like','%'.$nombre.'%')->get();
            if(!$autor->isEmpty()){
                $status = true;
                $info = "Data is listed successfully";
            }else{
                $status=false;
                $info = "Data could not be found";
            }
            return ResponseBuilder::result($status,$info,$autor);
        }else{
            $status = false;
            $info = "Unathorized";
        }
        return ResponseBuilder::result($status, $info);
    }
    public function getOneAutor(Request $request, $id){
        if($request->isJson()){
            $autor =Autor::where('autor_id',$id)->get();
            if(!$autor->isEmpty()){
                $status = true;
                $info = "Data is listed successfully";
            }else{
                $status=false;
                $info = "Data could not be found";
            }
            return ResponseBuilder::result($status,$info,$autor);
        }else{
            $status = false;
            $info = "Unathorized";
        }
        return ResponseBuilder::result($status, $info);
    }

    public function createAutor(Request $request){
        $autor = new Autor();
        $autor->nombre = $request->nombre;
        $autor->apellido = $request->apellido;
        $autor->email = $request->email;
        $autor->save();
        return response()->json($autor, 200);
    }

    public function updateAutor(Request $request, $id){
        $autor = Autor::where('autor_id', $id)->first();
        if(!empty($autor)){
            $autor->nombre = $request->nombre;
            $autor->apellido = $request->apellido;
            $autor->email = $request->email;
            $autor->save();
            return response()->json($autor, 200);
        }else{
            $status = false;
		    $info = 'Data does not exist';
        }
        return ResponseBuilder::result($status, $info);
    }

    public function deleteAutor(Request $request, $id){
       $autor = Autor::where('autor_id', $id)->first();
       if(!empty($autor)){
            $autor->delete();
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
