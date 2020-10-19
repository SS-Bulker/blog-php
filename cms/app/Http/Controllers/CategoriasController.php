<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Categorias;

use App\Models\Blog;

class CategoriasController extends Controller
{
    //
    public function index(){

        $blog = Blog::all();
        $categorias = Categorias::all();

        return view('paginas.categorias', array('categorias'=>$categorias, 'blog'=>$blog));

    }
}
