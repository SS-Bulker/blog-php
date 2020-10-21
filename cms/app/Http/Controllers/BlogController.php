<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Blog;
use App\Models\Administradores;

class BlogController extends Controller
{
    /* MOSTRAR TODOS LOS REGISTROS */
    public function index(){

        $blog = Blog::all();
        $administradores = Administradores::all();

        return view('paginas.blog', array('blog'=>$blog, "administradores"=>$administradores));

    }

    /* ACTUALIZAR UN REGISTRO */
    public function update($id, Request $request){

        //Recoger los datos
        $datos = array('dominio'=>$request->input('dominio'),
                       'servidor'=>$request->input('servidor'),
                       'titulo'=>$request->input('titulo'),
                       'descripcion'=>$request->input('descripcion'),
                       'palabras_claves'=>$request->input('palabras_claves'),
                       'redes_sociales'=>$request->input('redes_sociales'),
                       'logo_actual'=>$request->input('logo_actual'),
                       'portada_actual'=>$request->input('portada_actual'),
                       'icono_actual'=>$request->input('icono_actual'),
                       'sobre_mi'=>$request->input('sobre_mi'),
                       'sobre_mi_completo'=>$request->input('sobre_mi_completo'));

        //Recoger las imagenes
        $logo = array('logo_temporal'=>$request->file('logo'));
        $portada = array('portada_temporal'=>$request->file('portada'));
        $icono = array('icono_temporal'=>$request->file('icono'));

        //Validar datos
        if(!empty($datos)){

            $validar = \Validator::make($datos, [
                'dominio' => 'required|regex:/^[-\\_\\:\\.\\0-9a-z-ñ]+$/i',
                'servidor' => 'required|regex:/^[-\\_\\:\\.\\0-9a-z-ñ]+$/i',
                'titulo' => 'required|regex:/^[-\\_\\:\\.\\0-9a-zA-Z-ñÑáéíóúÁÉÍÓÚ ]+$/i',
                'descripcion' => 'required|regex:/^[?\\¿\\!\\¡\\$\\*\\+\\"\\<\\>\\&\\%\\#\\"\\(\\)\\=\\-\\_\\:\\.\\0-9a-z-A-Z-ñÑáéíóúÁÉÍÓÚ ]+$/i',
                'palabras_claves' => 'required|regex:/^[,\\0-9a-zA-Z-ñÑáéíóúÁÉÍÓÚ ]+$/i',
                'redes_sociales' => 'required',
                'logo_actual' => 'required',
                'portada_actual' => 'required',
                'icono_actual' => 'required',
                'sobre_mi' => 'required',
                'sobre_mi_completo' => 'required'
            ]);

            //Validar imagenes logo
            if($logo['logo_temporal'] != ''){

                $validarLogo = \Validator::make($logo, [

                    'logo_temporal' => 'required|image|mimes:jpg,jpeg,png|max:2000000'

                ]);

                if($validarLogo->fails()){

                    return redirect('/')->with('no-validacion-image', '');

                }

            }

            //Validar imagenes portada
            if($portada['portada_temporal'] != ''){

                $validarPortada = \Validator::make($portada, [

                    'portada_temporal' => 'required|image|mimes:jpg,jpeg,png|max:2000000'

                ]);

                if($validarPortada->fails()){

                    return redirect('/')->with('no-validacion-image', '');

                }

            }

            //Validar imagenes icono
            if($icono['icono_temporal'] != ''){

                $validarIcono = \Validator::make($icono, [

                    'icono_temporal' => 'required|image|mimes:jpg,jpeg,png|max:2000000'

                ]);

                if($validarIcono->fails()){

                    return redirect('/')->with('no-validacion-image', '');

                }

            }

            //Revisar la validación
            if($validar->fails()){

                return redirect('/')->with('no-validacion', '');

            }else{

                //Subir al servidor la imagen logo
                if($logo['logo_temporal'] != ''){

                    unlink($datos['logo_actual']);

                    $aleatorio = \mt_rand(100, 999);

                    $rutaLogo = 'img/blog/'.$aleatorio.'.'.$logo['logo_temporal']->guessExtension();

                   // \move_uploaded_file($logo['logo_temporal'], $rutaLogo);
                   //redimensionar imagen
                   list($ancho, $alto) = getimagesize($logo['logo_temporal']);

                   $nuevoAncho = 700;
                   $nuevoAlto = 200;

                   if($logo['logo_temporal']->guessExtension() == 'jpeg'){

                    $origen = imagecreatefromjpeg($logo['logo_temporal']);
                    $destino = \imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                    \imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                    \imagejpeg($destino, $rutaLogo);

                   }else if($logo['logo_temporal']->guessExtension() == 'png'){

                    $origen = imagecreatefrompng($logo['logo_temporal']);
                    $destino = \imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                    imagealphablending($destino, FALSE);
                    imagesavealpha($destino, TRUE);
                    \imagecopyresampled($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                    \imagepng($destino, $rutaLogo);

                   }

                }else{
                    $rutaLogo = $datos['logo_actual'];
                }
                //Subir al servidor la imagen portada
                if($portada['portada_temporal'] != ''){

                    unlink($datos['portada_actual']);

                    $aleatorio = \mt_rand(100, 999);

                    $rutaPortada = 'img/blog/'.$aleatorio.'.'.$portada['portada_temporal']->guessExtension();

                   // \move_uploaded_file($portada['portada_temporal'], $rutaPortada);
                   //redimensionar imagen
                   list($ancho, $alto) = getimagesize($portada['portada_temporal']);

                   $nuevoAncho = 700;
                   $nuevoAlto = 420;

                   if($portada['portada_temporal']->guessExtension() == 'jpeg'){

                    $origen = imagecreatefromjpeg($portada['portada_temporal']);
                    $destino = \imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                    \imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                    \imagejpeg($destino, $rutaPortada);

                   }else if($portada['portada_temporal']->guessExtension() == 'png'){

                    $origen = imagecreatefrompng($portada['portada_temporal']);
                    $destino = \imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                    imagealphablending($destino, FALSE);
                    imagesavealpha($destino, TRUE);
                    \imagecopyresampled($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                    \imagepng($destino, $rutaPortada);

                   }

                }else{
                    $rutaPortada = $datos['portada_actual'];
                }
                //Subir al servidor la imagen icono
                if($icono['icono_temporal'] != ''){

                    unlink($datos['icono_actual']);

                    $aleatorio = \mt_rand(100, 999);

                    $rutaIcono = 'img/blog/'.$aleatorio.'.'.$icono['icono_temporal']->guessExtension();

                    //\move_uploaded_file($icono['icono_temporal'], $rutaIcono);
                    //redimensionar imagen
                   list($ancho, $alto) = getimagesize($icono['icono_temporal']);

                   $nuevoAncho = 150;
                   $nuevoAlto = 150;

                   if($icono['icono_temporal']->guessExtension() == 'jpeg'){

                    $origen = imagecreatefromjpeg($icono['icono_temporal']);
                    $destino = \imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                    \imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                    \imagejpeg($destino, $rutaIcono);

                   }else if($icono['icono_temporal']->guessExtension() == 'png'){

                    $origen = imagecreatefrompng($icono['icono_temporal']);
                    $destino = \imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                    imagealphablending($destino, FALSE);
                    imagesavealpha($destino, TRUE);
                    \imagecopyresampled($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                    \imagepng($destino, $rutaIcono);

                   }

                }else{
                    $rutaIcono = $datos['icono_actual'];
                }

                //Mover todos los ficheros temporales de blog al destino final
                $origen = glob('img/temp/blog/*');
                
                foreach($origen as $fichero){

                    copy($fichero, 'img/blog/'.substr($fichero, 14));
                    unlink($fichero);

                }

                $blog = Blog::all();

                $actualizar = array('dominio'=>$datos['dominio'], 
                                    'servidor'=>$datos['servidor'],
                                    'titulo'=>$datos['titulo'],
                                    'descripcion'=>$datos['descripcion'],
                                    'palabras_claves'=>\json_encode(\explode(',', $datos['palabras_claves'])),
                                    'redes_sociales'=>$datos['redes_sociales'],
                                    'portada'=>$rutaPortada,
                                    'logo'=>$rutaLogo,
                                    'icono'=>$rutaIcono,
                                    'sobre_mi'=>str_replace('src="'.$blog[0]["servidor"].'img/temp/blog', 'src="'.$blog[0]["servidor"].'img/blog', $datos["sobre_mi"]),
                                    'sobre_mi_completo'=>str_replace('src="'.$blog[0]["servidor"].'img/temp/blog', 'src="'.$blog[0]["servidor"].'img/blog', $datos["sobre_mi_completo"]));

                $blog = Blog::where('id', $id)->update($actualizar);

                return redirect('/')->with('ok-editado', '');

            }

        }else{

            return redirect('/')->with('error', '');

        }
    }


}
