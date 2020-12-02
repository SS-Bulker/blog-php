<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Models\Opiniones;
use App\Models\Blog;
use App\Models\Administradores;

class OpinionesController extends Controller
{
    //
    public function index(){
        //inner Join en las 3 tablas (categorias, usuarios)
        $join = DB::table('opiniones')->join('users', 'opiniones.id_adm', '=', 'users.id')
            ->join('articulos', 'opiniones.id_art', '=', 'articulos.id_articulo')
            ->select('opiniones.*', 'users.*', 'articulos.*')
            ->get();

        $blog = Blog::all();
        $opiniones = Opiniones::all();
        $administradores = Administradores::all();

        return view('paginas.opiniones', array('opiniones'=>$join, 'blog'=>$blog, "administradores"=>$administradores));
    }

    public function show(Request $request, $id){
        $buscarOpinion = Opiniones::where('id_opinion', $id)->get();
        $blog = Blog::all();
        $administradores = Administradores::all();
        $joinOpiniones = DB::table('opiniones')
            ->join('users', 'opiniones.id_adm', '=', 'users.id')
            ->join('articulos', 'opiniones.id_art', '=', 'articulos.id_articulo')
            ->get();
        $joinOpinion = DB::table('opiniones')
            ->join('users', 'opiniones.id_adm', '=', 'users.id')
            ->join('articulos', 'opiniones.id_art', '=', 'articulos.id_articulo')
            ->where('id_opinion', $id)
            ->get();

        //Consualtar si encontro ese poducto
        if(count($buscarOpinion) == 1){
            return view('paginas.opiniones', array('status' => 200, 'blog' => $blog, 'administradores' => $administradores, 'opinion' => $joinOpinion, 'opiniones' => $joinOpiniones));
        }else{
            return view('paginas.opiniones', array('status' => 404, 'blog' => $blog, 'opiniones' => $joinOpiniones, 'administradores' => $administradores));
        }

    }

    public function update(Request $request, $id){
        //Recibir los datos
        $datosOpiniones = array('aprobacion_opinion'=>$request->input('aprobacion_opinion'),
                                'contenido_opinion'=>$request->input('contenido_opinion'),
                                'respuesta_opinion'=>$request->input('respuesta_opinion'));
        //Validar los datos
        if(!empty($datosOpiniones)){
            $validarDatosOpinioes = \Validator::make($datosOpiniones, [
                    'aprobacion_opinion' => 'required|regex:/^[0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/i',
                    'contenido_opinion' => 'required|regex:/^[0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/i',
                    'respuesta_opinion' => 'required|regex:/^[(\\)\\=\\&\\$\\;\\-\\_\\*\\"\\<\\>\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/i'
            ]);

            //Actualizar los datos
            $datos = array('aprobacion_opinion' => $datosOpiniones['aprobacion_opinion'],
                            'contenido_opinion' => $datosOpiniones['contenido_opinion'],
                            'id_adm' => auth()->user()->id,
                            'respuesta_opinion' => $datosOpiniones['respuesta_opinion']);

            $actualizarOpinion = Opiniones::where('id_opinion', $id)->update($datos);

            return redirect('/opiniones')->with('editado-opinion', '');

        }else{
            return redirect('/opiniones')->with('error-opinion', '');
        }



    }

    public function destroy(Request $request, $id){
        //Consultar si la opinio si existe
        $buscarOpinion = Opiniones::where('id_opinion', $id)->get();

        if(!empty($buscarOpinion)){
            $eliminarOpinion = Opiniones::where('id_opinion', $id)->delete();
            return 'ok';
        }else{
            return redirect('/opiniones')->with('error-eliminar-opinion', '');
        }

    }

}
