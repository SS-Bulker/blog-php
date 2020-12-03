<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Banner;
use App\Models\Blog;
use App\Models\Administradores;

class BannerController extends Controller
{
    //
    public function index(){

        $blog = Blog::all();
        $banner = Banner::all();
        $administradores = Administradores::all();

        return view('paginas.banner', array('banner'=>$banner, 'blog'=>$blog, "administradores"=>$administradores));
    }

    //Crear un banner
    public function store(Request $request){
    //Recibir los datos
        $obtenerDatos = array('titulo_banner' => $request->input('titulo_banner'),
                            'descripcion_banner' => $request->input('descripcion_banner'),
                            'pagina_banner' => $request->input('pagina_banner'),
                            'img_banner' => $request->file('img_banner'));
    //Validar los datos
        if(!empty($obtenerDatos)){
            $validarDatos = \Validator::make($obtenerDatos, [
                'titulo_banner' => 'nullable|regex:/^[0-9a-zA-Z-ñÑáéíóúÁÉÍÓÚ ]+$/i',
                'descripcion_banner' => 'nullable|regex:/^[0-9a-zA-Z-ñÑáéíóúÁÉÍÓÚ ]+$/i',
                'pagina_banner' => 'required|regex:/^[0-9a-zA-Z-ñÑáéíóúÁÉÍÓÚ ]+$/i',
                'img_banner' => 'required|image|mimes:jpg,jpeg,png|max:2000000'
            ]);

            if(!$obtenerDatos['img_banner'] || $validarDatos->fails()){
                return redirect('/banner')->with('error-validacion-banner', '');
            }else{
                $numeroAleatorio = mt_rand(100, 999);
                $rutaImagen = 'img/banner/'.$numeroAleatorio.'.'.$obtenerDatos['img_banner']->guessExtension();

                //Redimensionar la imagen
                list($ancho, $alto) = getimagesize($obtenerDatos['img_banner']);
                $nuevoAncho = 1440;
                $nuevoAlto = 400;

                if($obtenerDatos['img_banner']->guessExtension() == 'jpeg'){
                    $origenImagen = imagecreatefromjpeg($obtenerDatos['img_banner']);
                    $destinoImagen = \imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                    imagecopyresized($destinoImagen, $origenImagen, 0, 0, 0, 0, $nuevoAlto, $nuevoAlto, $ancho, $alto);
                    imagejpeg($destinoImagen, $rutaImagen);

                }else if($obtenerDatos['img_banner']->guessExtension() == 'png'){
                    $origenImagen = imagecreatefrompng($obtenerDatos['img_banner']);
                    $destinoImagen = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                    imagealphablending($destinoImagen, false);
                    imagesavealpha($destinoImagen, true);
                    imagecopyresampled($destinoImagen, $origenImagen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                    imagepng($destinoImagen, $rutaImagen);
                }

                //Guardar los datos
                $banner = new Banner();
                $banner->titulo_banner = $obtenerDatos['titulo_banner'];
                $banner->descripcion_banner = $obtenerDatos['descripcion_banner'];
                $banner->pagina_banner = $obtenerDatos['pagina_banner'];
                $banner->img_banner = $rutaImagen;

                $banner->save();

                return redirect('/banner')->with('creado-banner', '');
            }

        }else{
            return redirect('/banner')->with('error-crear-banner', '');
        }


    }

    //Llmar un solo banner
    public function show($id){
        $blog = Blog::all();
        $administradores = Administradores::all();
        $banner = Banner::all();
        $editarBanner = Banner::where('id_banner', $id)->get();

        if(count($editarBanner) == 1){
            return view('paginas.banner', array('status' => 200, 'editarBanner' => $editarBanner, 'banner' => $banner, 'blog' => $blog, 'administradores' => $administradores));
        }else{
            return view('paginas.banner', array('status' => 404, 'banner' => $banner, 'blog' => $blog, 'administradores' => $administradores));
        }
    }

    //Actualziar un banner
    public function update(Request $request, $id){
    //Obtener los datos
        $obtenerDatos = array('titulo_banner' => $request->input('titulo_banner'),
                            'descripcion_banner' => $request->input('descripcion_banner'),
                            'pagina_banner' => $request->input('pagina_banner'),
                            'imagen_actual' => $request->input('imagen_actual'));

        $imagen = array('imagen_temporal' => $request->file('img_banner'));

        //Validar los datos
        if(!empty($obtenerDatos)){
            $validarDatos = \Validator::make($obtenerDatos, [
                'titulo_banner' => 'nullable|regex:/^[0-9a-zA-Z-ñÑáéíóúÁÉÍÓÚ ]+$/i',
                'descripcion_banner' => 'nullable|regex:/^[0-9a-zA-Z-ñÑáéíóúÁÉÍÓÚ ]+$/i',
                'pagina_banner' => 'required|regex:/^[0-9a-zA-Z-ñÑáéíóúÁÉÍÓÚ ]+$/i',
                'imagen_actual' => 'required'
            ]);

            if($imagen['imagen_temporal'] != ''){
                $validarImagen = \Validator::make($imagen, [
                    'imagen_temporal' => 'required|image|mimes:jpg,jpeg,png|max:2000000'
                ]);
                if($validarImagen->fails()){
                    return redirect('/banner')->with('error-validacion-banner', '');
                }
            }
            if($validarDatos->fails()){
                return redirect('/banner')->with('error-validacion-banner', '');
            }
            if($imagen['imagen_temporal'] != ''){

                if(file_exists($obtenerDatos['imagen_actual'])){
                    unlink($obtenerDatos['imagen_actual']);
                }

                $numeroAleatorio = mt_rand(100, 999);
                $rutaImagen = 'img/banner/'.$numeroAleatorio.'.'.$imagen['imagen_temporal']->guessExtension();

                //Redimensionar la imagen
                list($ancho, $alto) = getimagesize($imagen['imagen_temporal']);
                $nuevoAncho = 1440;
                $nuevoAlto = 400;

                if($imagen['imagen_temporal']->guessExtension() == 'jpeg'){

                    $origenImagen = imagecreatefromjpeg($imagen['imagen_temporal']);
                    $destinoImagen = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                    imagecopyresized($destinoImagen, $origenImagen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                    imagejpeg($destinoImagen, $rutaImagen);

                }else if($imagen['imagen_temporal']->guessExtension() == 'png'){

                    $origenImagen = imagecreatefrompng($imagen['imagen_temporal']);
                    $destinoImagen = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
                    imagealphablending($destinoImagen, false);
                    imagesavealpha($destinoImagen, true);
                    imagecopyresampled($destinoImagen, $origenImagen, 0,0,0,0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                    imagepng($destinoImagen, $rutaImagen);

                }

            }else{
                $rutaImagen = $obtenerDatos['imagen_actual'];
            }

            $datosGuardar = array('titulo_banner' => $obtenerDatos['titulo_banner'],
                                'descripcion_banner' => $obtenerDatos['descripcion_banner'],
                                'pagina_banner' => $obtenerDatos['pagina_banner'],
                                'img_banner' => $rutaImagen);
            $banner = Banner::where('id_banner', $id)->update($datosGuardar);

            return redirect('/banner')->with('actualizado-banner', '');

        }else{
            return redirect('/banner')->with('error-actualizar-banner', '');
        }
    }

    //Eliminar un baner
    public function destroy($id){
        //Consultar que si llego ese banner
        $obtenerBanner = Banner::where('id_banner', $id)->get();

        if(!empty($obtenerBanner)){

            if(!empty($obtenerBanner[0]['img_banner'])){

                if(file_exists($obtenerBanner[0]['img_banner'])){
                    unlink($obtenerBanner[0]['img_banner']);
                }

            }
            $eliminarBanner = Banner::where('id_banner', $obtenerBanner[0]['id_banner'])->delete();

            return 'ok';
        }else{
            return redirect('/banner')->with('error-eliminar-banner', '');
        }
    }

}
