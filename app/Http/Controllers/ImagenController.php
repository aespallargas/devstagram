<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ImagenController extends Controller
{
    public function store(Request $request)
    {
        $imagen = $request->file('file');

        //cambiamos nombre imagenes, para que no se repita
        $nombreImagen = Str::uuid(). "." . $imagen->extension();

        //redimensionar imagen con Intervention
        $imagenServidor = Image::make($imagen);
        $imagenServidor->fit(1000, 1000);

        //mover imagen en servidor
        $imagenPath = public_path('uploads') ."/".$nombreImagen;
        $imagenServidor->save($imagenPath);

        return response()->json(['imagen' => $nombreImagen]);
    }
}
