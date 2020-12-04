<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Anuncios;
use App\Models\Blog;
use App\Models\Administradores;

class AnunciosController extends Controller
{
    //listar los anuncios
    public function index(){

        $blog = Blog::all();
        $anuncios = Anuncios::all();
        $administradores = Administradores::all();

        return view('paginas.anuncios', array('anuncios'=>$anuncios, 'blog'=>$blog, "administradores"=>$administradores));
    }

    //Crear un anuncio
    public function store(Request $request){
        //Recoger los datos
        $obtenerDatos = array('pagina_anuncio' => $request->input('pagina_anuncio'),
                                'codigo_anuncio' => $request->input('codigo_anuncio'));
        //Validar los datos
        if(!empty($obtenerDatos)){
        $validarDatos = \Validator::make($obtenerDatos, [
           'pagina_anuncio' => 'required|regex:/^[0-9a-zA-Z-ñÑáéíóúÁÉÍÓÚ ]+$/i',
           'codigo_anuncio' => 'required|regex:/^[(\\)\\=\\&\\$\\;\\-\\_\\*\\"\\<\\>\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/i'
        ]);
            //Proceso de guardado del text enriquecido
            $origen = glob('img/temp/anuncios/*');

            foreach($origen as $fichero){

                copy($fichero, 'img/anuncios/'. substr($fichero, 17));

                if(file_exists($fichero)){
                    unlink($fichero);
                }
            }

            $blog = Blog::all();

            //Guardar los datos
            $guardarAnuncios = new Anuncios();
            $guardarAnuncios->pagina_anuncio = $obtenerDatos['pagina_anuncio'];
            $guardarAnuncios->codigo_anuncio = str_replace('src="'.$blog[0]["servidor"].'img/temp/anuncios', 'src="'.$blog[0]["servidor"].'img/anuncios', $obtenerDatos["codigo_anuncio"]);
            $guardarAnuncios->save();

            return redirect('/anuncios')->with('creado-anuncio', '');

        }else{
            return redirect('/anuncios')->with('error-crear-anuncio', '');
        }



    }

    //Listar un solo anuncios
    public function show($id){
        $anuncios = Anuncios::all();
        $blog = Blog::all();
        $administradores = Administradores::all();
        $anuncio = Anuncios::where('id_anuncio', $id)->get();

        if(count($anuncio) == 1){
            return view('paginas.anuncios', array('status' => 200, 'anuncio' => $anuncio, 'anuncios' => $anuncios, 'blog' => $blog, 'administradores' => $administradores));
        }else{
            return view('paginas.anuncios', array('status' => 404, 'anuncios' => $anuncios, 'blog' => $blog, 'administradores' => $administradores));
        }

    }

    //Actualizar un anuncio
    public function update(Request $resquest, $id){
        //Recibir los datos
        $obtenerDatos = array('pagina_anuncio' => $resquest->input('pagina_anuncio'),
                                'codigo_anuncio' => $resquest->input('codigo_anuncio'));

        //Valdiar los datos
        if(!empty($obtenerDatos)) {
            $validarDatos = \Validator::make($obtenerDatos, [
               'pagina_anuncio' => 'required|regex:/^[0-9a-zA-Z-ñÑáéíóúÁÉÍÓÚ ]+$/i',
               'codigo_anuncio' => 'required|regex:/^[(\\)\\=\\&\\$\\;\\-\\_\\*\\"\\<\\>\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/i'
            ]);
            if($validarDatos->fails()){
                return redirect('/anuncios')->with('error-validacion-anuncios', '');
            }

            //Trabajando con el editor de texto enriquecido
            $origen = glob('img/temp/anuncios/*');

            foreach ($origen as $fichero){
                copy($fichero, 'img/anuncios'. substr($fichero, 17));
                if(file_exists($fichero)){
                    unlink($fichero);
                }
            }

            $blog = Blog::all();
            //Actualizar los datos
            $datosParaGuardar = array('pagina_anuncio' => $obtenerDatos['pagina_anuncio'],
                                    'codigo_anuncio' => str_replace('src="'.$blog[0]["servidor"].'img/temp/anuncios', 'src="'.$blog[0]["servidor"].'img/anuncios', $obtenerDatos['codigo_anuncio']));

            $guardarDatos = Anuncios::where('id_anuncio', $id)->update($datosParaGuardar);

            return redirect('/anuncios')->with('actualizado-anucio', '');

        }else{
            return redirect('/anuncios')->with('error-actualizar-anuncio', '');
        }
    }

    //Eliminar un anuncio
    public function destroy($id){
        //Bucar el anuncio
        $obtenerAnuncio = Anuncios::where('id_anuncio', $id)->get();

        if(!empty($obtenerAnuncio)){
            //Eliminar del servidor si existe algo de contenido
            $origenDatos = glob('img/anuncios/').$obtenerAnuncio[0]['codigo_anuncio'].'/*';
            foreach($origenDatos as $key){
                if(file_exists($key)){
                unlink($key);
                }
            }

            //Eliminar anuncio
            $eliminarAnuncio = Anuncios::where('id_anuncio', $obtenerAnuncio[0]['id_anuncio'])->delete();

            return 'ok';

        }else{
            return redirect('/anuncios')->with('error-eliminar-anuncio', '');
        }
    }
}
