<?php

namespace App\Http\Controllers;

use App\LibroInstancia;
use App\Http\Helper\ResponseBuilder;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;

class LibroInsController extends BaseController
{
    public function getLibros(Request $request){
        if($request->isJson()){
            $libros = LibroInstancia::all();
            return response()->json($libros,200);
        }else{
            $status = false;
            $info = "Unathorized";
        }
        return ResponseBuilder::result($status, $info);
    }

    public function getLibrosPrestamos(Request $request){
        if($request->isJson()){
            $libros = LibroInstancia::where('estado','p')->get();
            return response()->json($libros,200);
        }else{
            $status = false;
            $info = "Unathorized";
        }
        return ResponseBuilder::result($status, $info);
    }

    public function getLibrosDevueltos(Request $request){
        if($request->isJson()){
            $libros = LibroInstancia::where('estado','d')->get();
            return response()->json($libros,200);
        }else{
            $status = false;
            $info = "Unathorized";
        }
        return ResponseBuilder::result($status, $info);
    }

    public function getLibroOne(Request $request, $id){
        if($request->isJson()){
            $libro = LibroInstancia::where('libroinstancia_id',$id)->get();
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

    public function crear(Request $request){
        $prest = new LibroInstancia();
        $prest->fecha_devolucion = $request->fecha_devolucion;
        $prest->estado = $request->estado;
        $prest->libro_id = $request->libro;
        $prest->prestatario_id=$request->usuario;
        $prest->save();

        return response()->json($prest, 200);
    }

    public function update(Request $request, $id){
        $prest = LibroInstancia::where('libroinstancia_id', $id)->first();
        if(!empty($prest)){
            $prest->fecha_devolucion = $request->fecha_devolucion;
            $prest->estado = $request->estado;
            $prest->libro_id = $request->libro;
            $prest->prestatario_id=$request->usuario;
            $prest->save();
            return response()->json($prest, 200);
        }else{
            $status = false;
            $info = 'Data does not exist';
        }
         return ResponseBuilder::result($status, $info);
    }

    public function deleteLibro(Request $request, $id){
        if($request->isJson()){
            $libro = LibroInstancia::where('libro_id',$id)->first();
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
