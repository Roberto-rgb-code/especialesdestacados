<?php

namespace App\Http\Controllers;

use App\Models\Especial;
use App\Models\EspecialFoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EspecialController extends Controller
{
    // Métodos para vistas web (Blade)
    public function index()
    {
        $especiales = Especial::with('fotos')->get();
        return view('especiales_list', compact('especiales'));
    }

    public function create()
    {
        return view('especial_form');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'categoria' => 'required|in:Textil,Promocional,Otros',
            'tipo' => 'required|string|max:255',
            'fotos.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        $especial = Especial::create($validatedData);

        if ($request->hasFile('fotos')) {
            foreach ($request->file('fotos') as $foto) {
                $path = $foto->store('uploads', 'public');
                $especial->fotos()->create(['foto_path' => $path]);
            }
        }

        return redirect()->route('especiales.index')->with('success', 'Especial creado exitosamente');
    }

    public function edit($id)
    {
        $especial = Especial::with('fotos')->findOrFail($id);
        return view('especial_form', compact('especial'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nombre' => 'sometimes|string|max:255',
            'descripcion' => 'sometimes|string',
            'categoria' => 'sometimes|in:Textil,Promocional,Otros',
            'tipo' => 'sometimes|string|max:255',
            'fotos.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        $especial = Especial::findOrFail($id);
        $especial->update($request->only(['nombre', 'descripcion', 'categoria', 'tipo']));

        if ($request->hasFile('fotos')) {
            foreach ($request->file('fotos') as $foto) {
                $path = $foto->store('uploads', 'public');
                $especial->fotos()->create(['foto_path' => $path]);
            }
        }

        return redirect()->route('especiales.index')->with('success', 'Especial actualizado exitosamente');
    }

    public function destroy($id)
    {
        $especial = Especial::findOrFail($id);
        foreach ($especial->fotos as $foto) {
            Storage::disk('public')->delete($foto->foto_path);
            $foto->delete();
        }
        $especial->delete();

        return redirect()->route('especiales.index')->with('success', 'Especial eliminado exitosamente');
    }

    public function destroyPhoto($fotoId)
    {
        $foto = EspecialFoto::findOrFail($fotoId);
        Storage::disk('public')->delete($foto->foto_path);
        $foto->delete();

        return redirect()->back()->with('success', 'Foto eliminada exitosamente');
    }

    // Métodos para API
    public function apiIndex()
    {
        $especiales = Especial::with('fotos')->get();
        return response()->json($especiales);
    }

    public function apiShow($id)
    {
        $especial = Especial::with('fotos')->findOrFail($id);
        return response()->json($especial);
    }
}