<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Administradores;

use App\Models\Blog;

class AdministradoresController extends Controller
{
    //Mostrar todos los registros
    public function index(){
        
         
        
        /* $administradores = Administradores::all();

        return view('paginas.administradores', array('administradores' => $administradores, 'blog'=>$blog)); */

        if(request()->ajax()){

            return datatables()->of(Administradores::all())
            -> make(true);

            $blog = Blog::all();

            return view('paginas.administradores', array('blog'=>$blog));
        }
    }

    //Mostrar un solo registro
    public function show($id){

        $administrador = Administradores::where("id", $id)->get();
		$blog = Blog::all();
		$administradores = Administradores::all();

        if(count($administradores) != 0){

			return view("paginas.administradores", array("status"=>200, "administrador"=>$administrador, "blog"=>$blog, "administradores"=>$administradores));

        }else{

            return view("paginas.administradores", array("status"=>404, "blog"=>$blog, "administradores"=>$administradores));

        }

    }

    //Editar un registro
    public function update($id, Request $request){

        //Recoger los datos
        $datos = array('name'=>$request->input('name'),
                        'email'=>$request->input('email'),
                        'password_actual'=>$request->input('password_actual'),
                        'rol'=>$request->input('rol'),
                        'imagen_actual'=>$request->input('imagen_actual'));
        
        $password = array('password'=>$request->input('password'));
        $imagen = array('foto'=>$request->file('foto'));


        //Validar datos
        if(!empty($datos)){
            
            $validar = \Validator::make($datos, [
                'name' => "required|regex:/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/i",
                'email' => 'required|regex:/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/i'
            ]);
        
            //Validar contraseña
            if($password['password'] != ''){

                $validarPassword = Validator::make($password, [

                    'password' => "required|regex:/^[0-9a-zA-Z]+$/i"

                ]);
                
                if($validarPassword->fails()){

                    return redirect('/administradores')->with('no-validacion', '');

                }else{

                    $nuevaPassword = Hash::make($password['password']);

                }

            }else{

                $nuevaPassword = $datos['password_actual'];

            }

            //Validar Foto
            if($imagen['foto'] != ''){

                $validarImagen = \Validator::make($imagen, [
                    'foto' => 'required|image|mimes:jpg,jpeg,png|max:2000000'
                ]);

                if($validarImagen->fails()){

                    return redirect('/administradores')->with('no-validacion', '');

                }

            }

            if($validar->fails()){

                return redirect('/administradores')->with('no-validacion', '');

            }else{
                
                if($imagen['foto'] != ''){

                    if(!empty($datos["imagen_actual"])){

                        if($datos["imagen_actual"] != "img/administradores/admin.png"){	

                            unlink($datos["imagen_actual"]);

                        } 			

                    } 

                    $aleatorio = mt_rand(100, 999);

                    $ruta = 'img/administradores/'.$aleatorio.'.'.$imagen['foto']->guessExtension();

                    \move_uploaded_file($imagen['foto'], $ruta);

                }else{

                    $ruta = $datos['imagen_actual'];

                }

                $datos = array('name'=>$datos['name'],
                                'email'=>$datos['email'],
                                'password'=>$nuevaPassword,
                                'rol'=>$datos['rol'],
                                'foto'=>$ruta);
                            
                $administrador = Administradores::where('id', $id)->update($datos);

                return redirect('/administradores')->with('ok-editar', '');

            }

         }else{

            return redirect('/administradores')->with('error', '');

         }

    }
    //Eliminar un registro
    public function destroy($id, Request $request){

        $validar = Administradores::where('id', $id)->get();

        if(!empty($validar) && $id != 1){

            unlink($validar[0]['foto']);

            $administrador = Administradores::where('id', $validar[0]['id'])->delete();

            //return redirect('/administradores')->with('ok-eliminar', '');

            //Reponder a javascript ajax
            return 'ok';

        }else{

            return redirect('/administradores')->with('no-borrar', '');

        }

    }


}
