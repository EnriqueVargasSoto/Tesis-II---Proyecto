<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InicioController extends Controller
{
    public function index()
    {
        if(Auth::user()->name=="Administrador")
        {
            return view('Layout.inicioAdmin');
        }
        elseif(Auth::user()->persona->empleado->tipo->tipo=="Cajero")
        {
            return view('Layout.inicioCajero');
        }
        elseif(Auth::user()->persona->empleado->tipo->tipo=="Mesero")
        {
            return view('Layout.inicioMesero');
        }
        else{
            return view('Layout.index');
        }

    }
}
