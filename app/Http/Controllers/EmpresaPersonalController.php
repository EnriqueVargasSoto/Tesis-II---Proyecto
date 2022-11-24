<?php

namespace App\Http\Controllers;

use App\Models\EmpresaPersonal;
use Illuminate\Http\Request;

class EmpresaPersonalController extends Controller
{
    public function index()
    {
        return view('EmpresaPersonal.index');
    }
    public function getEmpresaPersonal()
    {
        return EmpresaPersonal::count() == 0 ? array() : EmpresaPersonal::first();
    }
    public function store(Request $request)
    {
        $data = $request->all();
        if ($request->hasFile('file')) {
            $url_imagen = $request->file('file')->store('public/Empresa');
            $nombre_imagen = $request->file('file')->getClientOriginalName();
            $data['nombre_imagen'] = $nombre_imagen;
            $data['url_imagen'] = $url_imagen;
        }

        unset($data['file']);
        if (EmpresaPersonal::count() == 0) {

            EmpresaPersonal::create($data);
        } else {
            $empresa = EmpresaPersonal::first();
            EmpresaPersonal::findOrFail($empresa->id)->fill($data)->save();
        }
    }
}
