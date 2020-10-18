<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Categorias;

class CategoriasController extends Controller
{
    //
    public function traerCategorias(){

        $categorias = Categorias::all();

        return view('paginas.categorias', array('categorias'=>$categorias));

    }
}
