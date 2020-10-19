<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Blog;

class BlogController extends Controller
{
    /* MOSTRAR TODOS LOS REGISTROS */
    public function index(){

        $blog = Blog::all();

        return view('paginas.blog', array('blog'=>$blog));

    }

    /* ACTUALIZAR UN REGISTRO */
    public function update($id, Request $request){

        //Recoger los datos
        $datos = array('dominio'=>$request->input('dominio'),
                       'servidor'=>$request->input('servidor'),
                       'titulo'=>$request->input('titulo'),
                       'descripcion'=>$request->input('descripcion'),
                       'palabras_claves'=>$request->input('palabras_claves'),
                       'redes_sociales'=>$request->input('redes_sociales'));

        //Validar datos
        if(!empty($datos)){

            $validar = \Validator::make($datos, [
                'dominio' => 'required|regex:/^[-\\_\\:\\.\\0-9a-z-ñ]+$/i',
                'servidor' => 'required|regex:/^[-\\_\\:\\.\\0-9a-z-ñ]+$/i',
                'titulo' => 'required|regex:/^[-\\_\\:\\.\\0-9a-zA-Z-ñÑáéíóúÁÉÍÓÚ ]+$/i',
                'descripcion' => 'required|regex:/^[?\\¿\\!\\¡\\$\\*\\+\\"\\<\\>\\&\\%\\#\\"\\(\\)\\=\\-\\_\\:\\.\\0-9a-z-A-Z-ñÑáéíóúÁÉÍÓÚ ]+$/i',
                'palabras_claves' => 'required|regex:/^[,\\0-9a-zA-Z-ñÑáéíóúÁÉÍÓÚ ]+$/i',
                'redes_sociales' => 'required'

            ]);

            //Revisar la validación
            if($validar->fails()){

                return redirect('/')->with('no-validacion', '');

            }else{

                $actualizar = array('dominio'=>$datos['dominio'], 
                                    'servidor'=>$datos['servidor'],
                                    'titulo'=>$datos['titulo'],
                                    'descripcion'=>$datos['descripcion'],
                                    'palabras_claves'=>\json_encode(\explode(',', $datos['palabras_claves'])),
                                    'redes_sociales'=>$datos['redes_sociales']);

                $blog = Blog::where('id', $id)->update($actualizar);

                return redirect('/')->with('ok-editado', '');

            }

        }else{

            return redirect('/')->with('error', '');

        }
    }


}
