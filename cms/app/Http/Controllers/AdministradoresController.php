<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Administradores;

use App\Models\Blog;

class AdministradoresController extends Controller
{
    //
    public function index(){
        
        $blog = Blog::all();
        $administradores = Administradores::all();

        return view('paginas.administradores', array('administradores' => $administradores, 'blog'=>$blog));
    }
}
