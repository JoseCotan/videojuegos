<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVideojuegoRequest;
use App\Http\Requests\UpdateVideojuegoRequest;
use App\Models\Desarrolladora;
use App\Models\Distribuidora;
use App\Models\Videojuego;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class VideojuegoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuarioActual = Auth::user();
        $videojuegosUsuarioActual = $usuarioActual->posesiones;
        return view('videojuegos.index', [
            'videojuegos' => $videojuegosUsuarioActual,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view(
            'videojuegos.create',
            [
                'desarrolladoras' => Desarrolladora::all(),
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'titulo' => 'required|max:255',
            'anyo' => 'required|regex:/^\d{4}$/',
            'desarrolladora_id' => 'required|string',
        ]);

        $videojuego = new Videojuego();
        $videojuego->titulo = $validated['titulo'];
        $videojuego->anyo = $validated['anyo'];
        $videojuego->desarrolladora_id = $validated['desarrolladora_id'];
        $videojuego->save();

        session()->flash('success', 'El videojuego se ha introducido correctamente.');
        return redirect()->route('videojuegos.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Videojuego $videojuego)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Videojuego $videojuego)
    {

        if ($videojuego->posesiones()->count() == 0 ||
            $videojuego->posesiones[0]->user_id != Auth::user()->id) {
            session()->flash('error', 'Este videojuego no es tuyo.');
            return redirect()->route('videojuegos.index');
        }
        return view(
            'videojuegos.edit',
            [
                'videojuego' => $videojuego,
                'desarrolladoras' => Desarrolladora::all(),
                'distribuidoras' => Distribuidora::all(),
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Videojuego $videojuego)
    {
        $usuarioActual = Auth::user();

        $validated = $request->validate([
            'titulo' => 'required|max:255',
            'anyo' => 'required|regex:/^\d{4}$/',
            'desarrolladora_id' => 'required|string',
        ]);

        $videojuego->titulo = $validated['titulo'];
        $videojuego->anyo = $validated['anyo'];
        $videojuego->desarrolladora_id = $validated['desarrolladora_id'];
        $videojuego->save();

        session()->flash('success', 'El videojuego se ha actualizado correctamente.');
        return redirect()->route('videojuegos.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Videojuego $videojuego)
    {
        if ($videojuego->posesiones()->count() >= 0) {
            session()->flash('error', 'El videojuego le pertenece a alguien, no se puede borrar.');
            return redirect()->route('videojuegos.index');
        }
        $videojuego->delete();
        session()->flash('success', 'El videojuego fue borrado correctamente.');
        return redirect()->route('videojuegos.index');
    }

    public function poseo(Videojuego $videojuego)
    {
        return view('videojuegos.index', [
            'videojuegos' => Videojuego::all(),
        ]);
    }
}
