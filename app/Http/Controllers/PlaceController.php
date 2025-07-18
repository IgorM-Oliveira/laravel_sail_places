<?php

namespace App\Http\Controllers;

use App\Models\Place;
use Illuminate\Http\Request;
use App\Http\Requests\PlaceRequest;

class PlaceController extends Controller
{
    /**
     * Lista os lugares com filtros opcionais.
     */
    public function index(Request $request)
    {
        $query = Place::query();

        // Filtros
        if ($request->has('city')) {
            $query->where('city', 'ilike', '%' . $request->city . '%');
        }

        if ($request->has('type')) {
            $query->where('type', 'ilike', '%' . $request->type . '%');
        }

        if ($request->has('name')) {
            $query->where('name', 'ilike', '%' . $request->name . '%');
        }

        return response()->json($query->paginate(10));
    }

    /**
     * Cria um novo lugar.
     */
    public function store(PlaceRequest $request)
    {
        $place = Place::create($request->validated());
        return response()->json($place, 201);
    }

    /**
     * Retorna os detalhes de um lugar específico.
     */
    public function show(string $id)
    {
        $place = Place::findOrFail($id);
        return response()->json($place);
    }

    /**
     * Atualiza os dados de um lugar.
     */
    public function update(PlaceRequest $request, string $id)
    {
        $place = Place::findOrFail($id);
        $place->update($request->validated());

        return response()->json($place);
    }

    /**
     * Remove um lugar.
     */
    public function destroy(string $id)
    {
        $place = Place::findOrFail($id);
        $place->delete();

        return response()->json(['message' => 'Lugar removido com sucesso.']);
    }
}
