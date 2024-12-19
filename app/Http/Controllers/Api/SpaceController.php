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
    public function index()
    {

        // if(request('island')){
        //     $spaces = Space::with(['address', 'services', 'modalities',  'user', 'comments', 'comments.images'])->whereHas('address', function($query){
        //         $query->where('island', request('island'));
        //     })->get();


        $spaces = Space::with(['address', 'services', 'modalities',  'user', 'comments', 'comments.images'])->get();

        if ($spaces->isEmpty()) {
            return response()->json([
                'message' => 'No spaces found',
                'status' => 404
            ], 404);
        }



        return (SpaceResource::collection($spaces))
            ->additional(['meta' => 'Espacios mostrados correctamente']);
    }

    

    /**
     * Store a newly created resource in storage.
     */
    public function store($request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $space = Space::with(['address', 'services', 'modalities', 'user', 'comments', 'comments.images'])->find($id);

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
