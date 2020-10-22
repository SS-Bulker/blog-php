<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Categorias;
use App\Models\Blog;
use App\Models\Administradores;

class CategoriasController extends Controller
{
    //
    public function index(){

        $blog = Blog::all();
        $categorias = Categorias::all();
        $administradores = Administradores::all();

        return view('paginas.categorias', array('categorias'=>$categorias, 'blog'=>$blog, "administradores"=>$administradores));

    }
    //Crear un registro
    public function store(Request $request){

        //Recoger datos
        $datos = array( 'titulo_categoria'=>$request->input('titulo_categoria'),
                        'descripcion_categoria'=>$request->input('descripcion_categoria'),
                        'p_claves_categoria'=>$request->input('p_claves_categoria'),
                        'ruta_categoria'=>$request->input('ruta_categoria'),
                        'imagen_temporal'=>$request->file('img_categoria'));

        //Validar datos
        if(!empty($datos)){

            $validar = \Validator::make($datos, [
                'titulo_categoria'=>'required|regex:/^[0-9a-zA-Z-ñÑáéíóúÁÉÍÓÚ ]+$/i',
                'descripcion_categoria'=>'required|regex:/^[0-9a-zA-Z-ñÑáéíóúÁÉÍÓÚ ]+$/i',
                'p_claves_categoria'=>'required',
                'ruta_categoria'=>'required|regex:/^[0-9a-z-]+$/i',
                'imagen_temporal'=> 'required|image|mimes:jpg,jpeg,png|max:2000000'
            ]);

            //Guardar categoria
            if(!$datos['imagen_temporal'] || $validar->fails()){
                return redirect('/categorias')->with('no-validacion', '');
            }else{
                $aleatorio = mt_rand(100, 999);
                $ruta = 'img/categorias/'.$aleatorio.'.'.$datos['imagen_temporal']->guessExtension();

                //Redimensionar imagen
                list($ancho, $alto) = getimagesize($datos['imagen_temporal']);
                $nuevoAncho = 1024;
                $nuevoAlto = 576;

                if($datos['imagen_temporal']->guessExtension() == 'jpeg'){

                    $origen = imagecreatefromjpeg($datos['imagen_temporal']);
                    $destino = \imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                    \imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                    \imagejpeg($destino, $ruta);

                }
                if($datos['imagen_temporal']->guessExtension() == 'png'){

                    $origen = imagecreatefrompng($datos['imagen_temporal']);
                    $destino = \imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                    imagealphablending($destino, FALSE);
                    imagesavealpha($destino, TRUE);
                    \imagecopyresampled($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                    \imagepng($destino, $ruta);

                }

                   $categoria = new Categorias();
                   $categoria->titulo_categoria = $datos['titulo_categoria'];
                   $categoria->descripcion_categoria = $datos['descripcion_categoria'];
                   $categoria->ruta_categoria = $datos['ruta_categoria'];
                   $categoria->p_claves_categoria = json_encode(explode(',', $datos['p_claves_categoria']));
                   $categoria->img_categoria = $ruta; 

                   $categoria->save();

                   return redirect('/categorias')->with('ok-creado', '');

            }


        }else{

            return redirect('/categorias')->with('error', '');

            

        }

    }

    //Mostrar un solo registro
    public function show($id){

        $categoria = Categorias::where('id_categoria', $id)->get();
        $categorias = Categorias::all();

        $blog = Blog::all();
		$administradores = Administradores::all();

        if(count($categoria) != 0){

            return view('paginas.categorias', array('status'=>200, 'categoria'=>$categoria, 'categorias'=>$categorias, "blog"=>$blog, "administradores"=>$administradores));

        }else{

            return view('paginas.categorias', array('status'=>404, "blog"=>$blog, "administradores"=>$administradores));

        }

    }

    //Actualizar un registro
    public function update($id, Request $request){

        //Recoger los datos
        $datos = array( 'titulo_categoria'=>$request->input('titulo_categoria'),
                        'descripcion_categoria'=>$request->input('descripcion_categoria'),
                        'p_claves_categoria'=>$request->input('p_claves_categoria'),
                        'ruta_categoria'=>$request->input('ruta_categoria'),
                        'imagen_actual'=>$request->input('imagen_actual'));
                    
        $imagen = array("imagen_temporal"=>$request->file("img_categoria"));

        if(!empty($datos)){

            //Validar los datos
            $validar = \Validator::make($datos, [
                'titulo_categoria'=>'required|regex:/^[0-9a-zA-Z-ñÑáéíóúÁÉÍÓÚ ]+$/i',
                'descripcion_categoria'=>'required|regex:/^[0-9a-zA-Z-ñÑáéíóúÁÉÍÓÚ ]+$/i',
                'p_claves_categoria'=>'required',
                'ruta_categoria'=>'required|regex:/^[0-9a-z-]+$/i',
                'imagen_actual'=> 'required'
            ]);

            if($imagen['imagen_temporal'] != ''){
                $validarImagen = \Validator::make($imagen, [
                    'imagen_temporal'=> 'required|image|mimes:jpg,jpeg,png|max:2000000'
                ]);
                if($validarImagen->fails()){
                    return redirect("/categorias")->with("no-validacion", "");
                }
            }
            if($validar->fails()){
                return redirect("/categorias")->with("no-validacion", "");
            }else{

                if($imagen['imagen_temporal'] != ''){

                    unlink($datos['imagen_actual']);
                    $aleatorio = mt_rand(100, 999);
                    $ruta = 'img/categorias/'.$aleatorio.'.'.$imagen['imagen_temporal']->guessExtension();

                    //Redimensionar imagen
                    list($ancho, $alto) = getimagesize($imagen['imagen_temporal']);
                    $nuevoAncho = 1024;
                    $nuevoAlto = 576;

                    if($imagen['imagen_temporal']->guessExtension() == 'jpeg'){

                    $origen = imagecreatefromjpeg($imagen['imagen_temporal']);
                    $destino = \imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                    \imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                    \imagejpeg($destino, $ruta);

                    }
                    if($imagen['imagen_temporal']->guessExtension() == 'png'){

                        $origen = imagecreatefrompng($imagen['imagen_temporal']);
                        $destino = \imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                        imagealphablending($destino, FALSE);
                        imagesavealpha($destino, TRUE);
                        \imagecopyresampled($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                        \imagepng($destino, $ruta);

                    }

                }else{
                    $ruta = $datos['imagen_actual'];
                }

                $datos = array("titulo_categoria" => $datos["titulo_categoria"],
                            "descripcion_categoria" => $datos["descripcion_categoria"],      
                            "p_claves_categoria" => json_encode(explode(',', $datos["p_claves_categoria"])),
                            "ruta_categoria" => $datos['ruta_categoria'],
                            "img_categoria" => $ruta);

                $categoria = Categorias::where('id_categoria', $id)->update($datos);

                return redirect("/categorias")->with("ok-editar", "");

            }

        }else{

            return redirect('/categorias')->with('error', '');

        }


    }

    //Eliminar categorias
    public function destroy($id, Request $request){

        $validar = Categorias::where("id_categoria", $id)->get();
    	
    	if(!empty($validar)){

    		if(!empty($validar[0]["img_categoria"])){

    			unlink($validar[0]["img_categoria"]);
    		
    		}

    		$categoria = Categorias::where("id_categoria",$validar[0]["id_categoria"])->delete();

    		// return redirect("/administradores")->with("ok-eliminar", "");

    		//Responder al AJAX de JS
    		return "ok";
    	
    	}else{

    		return redirect("/categorias")->with("no-borrar", "");
    	

    	}


    }

}
