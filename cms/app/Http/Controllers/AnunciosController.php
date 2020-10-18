<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Anuncios;

class AnunciosController extends Controller
{
    //
    public function traerAnuncios(){

        $anuncios = Anuncios::all();

        return view('paginas.anuncios', array('anuncios'=>$anuncios));
    }
}
