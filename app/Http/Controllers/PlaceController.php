<?php

namespace App\Http\Controllers;

use App\Models\Place;
use Illuminate\Http\Request;
use App\Http\Requests\PlaceRequest;

class PlaceController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/places",
     *     tags={"Places"},
     *     summary="Lista todos os lugares",
     *     @OA\Parameter(
     *         name="city",
     *         in="query",
     *         description="Filtra por cidade",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="type",
     *         in="query",
     *         description="Filtra por tipo",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="name",
     *         in="query",
     *         description="Filtra por nome",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Lista de lugares paginada",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="data", type="array",
     *                 @OA\Items(ref="#/components/schemas/Place")
     *             ),
     *             @OA\Property(property="links", type="object"),
     *             @OA\Property(property="meta", type="object")
     *         )
     *     )
     * )
     */
    public function index(Request $request)
    {
        $query = Place::query();

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
     * @OA\Post(
     *     path="/api/places",
     *     tags={"Places"},
     *     summary="Cria um novo lugar",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/PlaceRequest")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Lugar criado com sucesso",
     *         @OA\JsonContent(ref="#/components/schemas/Place")
     *     )
     * )
     */
    public function store(PlaceRequest $request)
    {
        $place = Place::create($request->validated());
        return response()->json($place, 201);
    }

    /**
     * @OA\Get(
     *     path="/api/places/{id}",
     *     tags={"Places"},
     *     summary="Mostra detalhes de um lugar específico",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID do lugar",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Detalhes do lugar",
     *         @OA\JsonContent(ref="#/components/schemas/Place")
     *     ),
     *     @OA\Response(response=404, description="Lugar não encontrado")
     * )
     */
    public function show(string $id)
    {
        $place = Place::findOrFail($id);
        return response()->json($place);
    }

    /**
     * @OA\Put(
     *     path="/api/places/{id}",
     *     tags={"Places"},
     *     summary="Atualiza um lugar",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID do lugar",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/PlaceRequest")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Lugar atualizado",
     *         @OA\JsonContent(ref="#/components/schemas/Place")
     *     ),
     *     @OA\Response(response=404, description="Lugar não encontrado")
     * )
     */
    public function update(PlaceRequest $request, string $id)
    {
        $place = Place::findOrFail($id);
        $place->update($request->validated());

        return response()->json($place);
    }

    /**
     * @OA\Delete(
     *     path="/api/places/{id}",
     *     tags={"Places"},
     *     summary="Remove um lugar",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID do lugar",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Lugar removido com sucesso"
     *     ),
     *     @OA\Response(response=404, description="Lugar não encontrado")
     * )
     */
    public function destroy(string $id)
    {
        $place = Place::findOrFail($id);
        $place->delete();

        return response()->json(['message' => 'Lugar removido com sucesso.']);
    }
}
