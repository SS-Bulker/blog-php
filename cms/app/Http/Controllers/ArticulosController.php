<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Articulos;

class ArticulosController extends Controller
{
    //
    public function traerArticulos(){
        $articulos = Articulos::all();

        return view('paginas.articulos', array('articulos'=>$articulos));
    }
}
