<?php

namespace App\Http\Controllers\Api;

use App\Models\Space;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\SpaceResource;


class SpaceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, $island = null)
    {
        $islandName = $island?? $request->get('island'); // Nombre de la isla para filtrar

        $query = Space::query()->with(['address', 'services', 'modalities', 'user', 'comments', 'comments.images']);

        if ($islandName) {
            $query->whereHas('address.municipality.island', function ($q) use ($islandName) {
                $q->where('name', $islandName); // Filtra por el nombre de la isla
            });
        }


        $spaces = $query->get();

        if ($spaces->isEmpty()) {
            return response()->json([
                'message' => 'No spaces found',
                'status' => 404
            ], 404);
        }

        // Ejemplo de petición: http:
        //http://127.0.0.1:8000/api/spaces?island=Menorca

        return SpaceResource::collection($spaces)
            ->additional(['meta' => $islandName ? 'Spaces filtered by island' : 'All spaces']);
    }





    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'regNumber' => 'required|exists:spaces,regNumber',
            'comment' => 'required|string|max:255',
            'score' => 'required|integer|min:1|max:5',
            'status' => 'nullable|string',
            'url' => 'nullable|url',
        ]);

        $space = Space::where('regNumber', $validatedData['regNumber'])->firstOrFail();



        $comment = $space->comments()->create([
            'comment' => $validatedData['comment'],
            'score' => $validatedData['score'],
            'status' => $validatedData['status'],
            'user_id' => $space->user_id,

        ]);

        if ($request->hasFile('url')) {
            dd($request->file('url')); // Verifica los archivos enviados
        }


        // Si hay una imagen en la solicitud
        if (!empty($validatedData['url'])) {
            $comment->images()->create([
                'url' => $validatedData['url'], // Guardar la URL tal cual en la base de datos
            ]);
        }


        // Respuesta de éxito
        return response()->json([
            'message' => 'Comentario creado correctamente',
            'status' => 201,
            'data' => [
                'comment' => $comment->load('images'), // Cargar imágenes relacionadas
            ],
        ], 201);

        //Formato de entrada en el json de thunderClient.
        // {
        //     "regNumber":"EA-2246",
        //     "comment":"LElo",
        //     "score":"2",
        //     "status":"y",
        //     "url":"https://via.placeholder.com/640x480.png/0099dd?text=tempore"

        //   }

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //filtrado por id o por regNumber.


        $space = is_numeric($id)
            ? Space::with(['address', 'services', 'modalities', 'user', 'comments', 'comments.images'])->find($id)
            : Space::with(['address', 'services', 'modalities', 'user', 'comments', 'comments.images'])
            ->where('regNumber', $id)
            ->first();

        if (!$space) {
            return response()->json([
                'message' => 'Space not found',
                'status' => 404
            ], 404);
        }

        return (new SpaceResource($space));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
