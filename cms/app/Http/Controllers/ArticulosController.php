<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Articulos;
use App\Models\Blog;
use App\Models\Administradores;

class ArticulosController extends Controller
{
    //
    public function index(){

        $blog = Blog::all();
        $articulos = Articulos::all();
        $administradores = Administradores::all();

        return view('paginas.articulos', array('articulos'=>$articulos, 'blog'=>$blog, "administradores"=>$administradores));
    }
}
