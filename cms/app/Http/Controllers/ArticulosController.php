<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Articulos;
use App\Models\Blog;
use App\Models\Administradores;
use App\Models\Categorias;

class ArticulosController extends Controller
{
    //
    public function index(){

        $blog = Blog::all();
        $articulos = Articulos::all();
        $administradores = Administradores::all();
        $categorias = Categorias::all();

        $join = DB::table('categorias')->join('articulos', 'categorias.id_categoria', '=', 'articulos.id_cat')->select('categorias.*', 'articulos.*')->get();

        return view('paginas.articulos', array('articulos'=>$join, 'categorias'=>$categorias, 'blog'=>$blog, "administradores"=>$administradores));
    }

    //Crear un nuevo articulo
    public function store(Request $request){

        //Recoger los datos
        $datos = array('id_cat'=>$request->input('id_cat'),
                        'titulo_articulo'=>$request->input('titulo_articulo'),
                        'descripcion_articulo'=>$request->input('descripcion_articulo'),
                        'p_claves_articulo'=>$request->input('p_claves_articulo'),
                        'ruta_articulo'=>$request->input('ruta_articulo'),
                        'imagen_temporal'=>$request->file('img_articulo'),
                        'contenido_articulo'=>$request->input('contenido_articulo'));

        //Recoger datos de la bd blog para las rutas de imagenes
        $blog = Blog::all();
        //Validar datos
        if(!empty($datos)){

            $validar = \Validator::make($datos, [

                "titulo_articulo" => "required|regex:/^[0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/i",
                "descripcion_articulo" => 'required|regex:/^[(\\)\\=\\&\\$\\;\\-\\_\\*\\"\\<\\>\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/i' ,
                "p_claves_articulo" => 'required|regex:/^[,\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/i',
                "ruta_articulo" => "required|regex:/^[a-z0-9-]+$/i",
                "imagen_temporal" => "required|image|mimes:jpg,jpeg,png|max:2000000",
                "contenido_articulo" => 'required|regex:/^[(\\)\\=\\&\\$\\;\\-\\_\\*\\"\\<\\>\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/i' 

            ]);

            //Guardar artículo

            if(!$datos["imagen_temporal"] || $validar->fails()){
   
                return redirect("/articulos")->with("no-validacion", "");

            }else{

                //Creamos el directorio donde guardaremos las imágenes del artículo

                $directorio = "img/articulos/".$datos["ruta_articulo"];    

                if(!file_exists($directorio)){  

                    mkdir($directorio, 0755);

                }   

                $aleatorio = mt_rand(100,999);

    			$ruta = $directorio."/".$aleatorio.".".$datos["imagen_temporal"]->guessExtension();

    			//Redimensionar Imágen

                list($ancho, $alto) = getimagesize($datos["imagen_temporal"]);

                $nuevoAncho = 680;
                $nuevoAlto = 400;

                if($datos["imagen_temporal"]->guessExtension() == "jpeg"){

                    $origen = imagecreatefromjpeg($datos["imagen_temporal"]);
                    $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                    imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                    imagejpeg($destino, $ruta);

                }

                if($datos["imagen_temporal"]->guessExtension() == "png"){

                    $origen = imagecreatefrompng($datos["imagen_temporal"]);
                    $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                    imagealphablending($destino, FALSE); 
                    imagesavealpha($destino, TRUE);
                    imagecopyresampled($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                    imagepng($destino, $ruta);
                    
                }

                // Mover todos los ficheros temporales al destino final
                $origen = glob('img/temp/articulos/*'); 
                       
                foreach($origen as $fichero){

                    copy($fichero, $directorio."/".substr($fichero, 19));
                    unlink($fichero); 
                    
                } 
           
                $articulo = new Articulos();
                $articulo->id_cat = $datos["id_cat"];
                $articulo->titulo_articulo = $datos["titulo_articulo"];
                $articulo->descripcion_articulo = $datos["descripcion_articulo"];
                $articulo->p_claves_articulo = json_encode(explode(",", $datos["p_claves_articulo"]));
                $articulo->ruta_articulo = $datos["ruta_articulo"];
                $articulo->portada_articulo = $ruta;
                $articulo->contenido_articulo = str_replace('src="'.$blog[0]["servidor"].'img/temp/articulos', 'src="'.$blog[0]["servidor"].$directorio, $datos["contenido_articulo"]);
                $articulo->vistas_articulo = 0;

                $articulo->save();    

                return redirect("/articulos")->with("ok-creado", "");
            }

        }else{
         
            return redirect("/articulos")->with("error", "");

        }

    }

    //Listar un solo registro
    public function show($id, Request $request){

        $articulo = Articulos::where('id_articulo', $id)->get();
        $articulos = Articulos::all();
        $categorias = Categorias::all();
        $blog = Blog::all();
        $administradores = Administradores::all();

        if(count($articulo) != 0){
            return view('paginas.articulos', array('status'=>200, 'articulos'=>$articulos, 'articulo'=>$articulo, 'categorias'=>$categorias, 'blog'=>$blog, "administradores"=>$administradores));
        }else{
            return view('paginas.articulos', array('status'=>404, 'articulos'=>$articulos, 'blog'=>$blog, "administradores"=>$administradores));
        }

    }

    //Actualizar un registro
    public function update($id, Request $request){

        // Recoger los datos

        $datos = array("id_cat"=>$request->input("id_cat"),
                        "titulo_articulo"=>$request->input("titulo_articulo"),
                        "descripcion_articulo"=>$request->input("descripcion_articulo"),
                        "p_claves_articulo"=>$request->input("p_claves_articulo"),
                        "ruta_articulo"=>$request->input("ruta_articulo"),
                        "imagen_actual"=>$request->input("imagen_actual"),
                        "contenido_articulo"=>$request->input("contenido_articulo")); 

        // Recoger datos de la BD blog para las rutas de imágenes 

        $blog = Blog::all();

        $directorio = "img/articulos/".$datos["ruta_articulo"]; 

        // Recoger Imagen

        $imagen = array("imagen_temporal"=>$request->file("img_articulo"));

        // Validar los datos
        // https://laravel.com/docs/5.7/validation
        if(!empty($datos)){
            
           $validar = \Validator::make($datos,[

                "titulo_articulo" => "required|regex:/^[0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/i",
                "descripcion_articulo" => 'required|regex:/^[(\\)\\=\\&\\$\\;\\-\\_\\*\\"\\<\\>\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/i',
                "p_claves_articulo" => 'required|regex:/^[,\\"\\[\\]\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/i',
                "ruta_articulo" => "required|regex:/^[a-z0-9-]+$/i",
                "imagen_actual" => "required",
                "contenido_articulo" => 'required|regex:/^[(\\)\\=\\&\\$\\;\\-\\_\\*\\"\\<\\>\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/i'
         
            ]);

            if($imagen["imagen_temporal"] != ""){

                $validarImagen = \Validator::make($imagen,[

                    "imagen_temporal" => "required|image|mimes:jpg,jpeg,png|max:2000000"

                ]);

                if($validarImagen->fails()){
               
                return redirect("/articulos")->with("no-validacion", "");

                }
 
            }

            //Guardar articulo

            if($validar->fails()){
               
                return redirect("articulos")->with("no-validacion", "");

            }else{

                if($imagen["imagen_temporal"] != ""){

                    unlink($datos["imagen_actual"]);

                    $aleatorio = mt_rand(100,999);

                    $ruta = $directorio."/".$aleatorio.".".$imagen["imagen_temporal"]->guessExtension();

                    //Redimensionar Imágen

	                list($ancho, $alto) = getimagesize($imagen["imagen_temporal"]);

	                $nuevoAncho = 680;
	                $nuevoAlto = 400;

	                if($imagen["imagen_temporal"]->guessExtension() == "jpeg"){

	                    $origen = imagecreatefromjpeg($imagen["imagen_temporal"]);
	                    $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
	                    imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
	                    imagejpeg($destino, $ruta);

	                }

	                if($imagen["imagen_temporal"]->guessExtension() == "png"){

	                    $origen = imagecreatefrompng($imagen["imagen_temporal"]);
	                    $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
	                    imagealphablending($destino, FALSE); 
	                    imagesavealpha($destino, TRUE);
	                    imagecopyresampled($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
	                    imagepng($destino, $ruta);
	                    
                    }

                }else{

                    $ruta = $datos["imagen_actual"];
                }

                // Mover todos los ficheros temporales al destino final
                $origen = glob('img/temp/articulos/*'); 
                       
                foreach($origen as $fichero){

                    copy($fichero, $directorio."/".substr($fichero, 19));
                    unlink($fichero); 
                    
                } 

                $datos = array("id_cat" => $datos["id_cat"],
                                "titulo_articulo" => $datos["titulo_articulo"],
                                "descripcion_articulo" => $datos["descripcion_articulo"],
                                "p_claves_articulo" => json_encode(explode(",", $datos["p_claves_articulo"])),
                                "ruta_articulo" => $datos["ruta_articulo"],
                                "portada_articulo" => $ruta,
                                 "contenido_articulo" => str_replace('src="'.$blog[0]["servidor"].'img/temp/articulos', 'src="'.$blog[0]["servidor"].$directorio, $datos["contenido_articulo"]));

                $articulo = Articulos::where('id_articulo', $id)->update($datos); 

                return redirect("articulos")->with("ok-editar", "");

                
            }
            
        }else{

             return redirect("/articulos")->with("error", "");

        }

    }

    //Eliminar un registro
    public function destroy($id, Request $request){

        $validar = Articulos::where("id_articulo", $id)->get();
    	
    	if(!empty($validar)){

            //Capturar los archivos para eliminarlos uno por uno
            $origen = glob('img/articulos/'.$validar[0]['ruta_articulo'].'/*');

            foreach($origen as $fichero){
                unlink(\file_exists($fichero));
            }

            //Eliminamos directorio
            if(\file_exists('img/articulos/'.$validar[0]['ruta_articulo'])){
                rmdir('img/articulos/'.$validar[0]['ruta_articulo']);
            }
            

    		$articulo = Articulos::where("id_articulo",$validar[0]["id_articulo"])->delete();

    		return "ok";
    	
    	}else{

    		return redirect("/articulos")->with("no-borrar", "");
    	
    	}
    }
}
