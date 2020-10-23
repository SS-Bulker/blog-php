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

        $join = DB::table('categorias')->join('articulos', 'categorias.id_categoria', '=', 'articulos.id_cat')->select('categorias.*', 'articulos.*')->get();

        return view('paginas.articulos', array('articulos'=>$join, 'blog'=>$blog, "administradores"=>$administradores));
    }
}
