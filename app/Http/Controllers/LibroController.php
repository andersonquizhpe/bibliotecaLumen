<?php

namespace App\Http\Controllers;

use App\Libro;
use App\Autor;
use App\Http\Helper\ResponseBuilder;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;

class LibroController extends BaseController
{
    public function getLibros(Request $request){
        if($request->isJson()){
            $libros = Libro::all();
            $status=true;
            $info = "Data is listed successfully";
            return ResponseBuilder::result($status,$info,$libros);
        }else{
            $status = false;
            $info = "Unathorized";
        }
        return ResponseBuilder::result($status, $info);
    }

    public function getLibroOne(Request $request, $id){
        if($request->isJson()){
            $libro = Libro::where('libro_id',$id)->get();
            if(!$libro->isEmpty()){
                $status=true;
                $info = "Data is listed successfully";
            }else{
                $status=false;
                $info = "Data could not be found";
            }
            return ResponseBuilder::result($status,$info,$libro);
        }else{
            $status = false;
            $info = "Unathorized";
        }
        return ResponseBuilder::result($status, $info);
    }

    public function getLibroAutor(Request $request, $id){
        if($request->isJson()){
            $libro = Libro::where('autor_id',$id)->get();
            if(!$libro->isEmpty()){
                $status=true;
                $info = "Data is listed successfully";
            }else{
                $status=false;
                $info = "Data could not be found";
            }
            return ResponseBuilder::result($status,$info,$libro);
        }else{
            $status = false;
            $info = "Unathorized";
        }
        return ResponseBuilder::result($status, $info);
    }

    public function getLibroTitulo(Request $request, $titulo){
        
        
        if($request->isJson()){
            $search = array("%20","%C3%B1");
            $replace = array(" ","ñ");
            $libro = Libro:: where('titulo', 'like', '%' . str_replace($search,$replace,$titulo) . '%')->get();
            if(!$libro->isEmpty()){
                $status=true;
                $info = "Data is listed successfully";
            }else{
                $status=false;
                $info = "Data could not be found";
            }
            return ResponseBuilder::result($status,$info,$libro);
        }else{
            $status = false;
            $info = "Unathorized";
        }
        return ResponseBuilder::result($status, $info);
    }

    public function getLibroGenero(Request $request, $id){
        if($request->isJson()){
            $libro = Libro::where('genero_id',$id)->get();
            if(!$libro->isEmpty()){
                $status=true;
                $info = "Data is listed successfully";
            }else{
                $status=false;
                $info = "Data could not be found";
            }
            return ResponseBuilder::result($status,$info,$libro);
        }else{
            $status = false;
            $info = "Unathorized";
        }
        return ResponseBuilder::result($status, $info);
    }

    //realizar metodos crear y actualizar libro

    public function deleteLibro(Request $request, $id){
        if($request->isJson()){
            $libro = Libro::where('libro_id',$id)->first();
            if(!empty($libro)){
                $libro->delete();
                $status = true;
                $info = "Data was deleted";
            }else{
                $status="false";
                $info="Data does not exist";
            }
            return ResponseBuilder::result($status, $info);
        }else{
            $status = false;
            $info = "Unathorized";
        }
        return ResponseBuilder::result($status, $info);
    }
}
