<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\Centro;
use App\Models\ClubDeportivo;

class MapaController extends Controller
{
    public function index(Request $request)
    {   
        $categorias= Categoria::all();
        return view('mapa', compact('categorias'));
    }

    public function getCentros($id){
        $centros = Centro::where('id_categoria',$id)->get();       
        return $centros;
    }

   
}
