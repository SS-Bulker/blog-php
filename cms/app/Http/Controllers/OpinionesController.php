<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Opiniones;

class OpinionesController extends Controller
{
    //
    public function traerOpiniones(){

        $opiniones = Opiniones::all();

        return view('paginas.opiniones', array('opiniones'=>$opiniones));
    }
}
