<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::all();

        return (UserResource::collection($user))
            ->additional(['meta' => 'Users mostrados correctamente']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($email)
    {


        // Perform a single query to check existence and eager load relationships
        $user = User::with(['spaces', 'comments', 'comments.images'])->where('email', $email)->first();

        
        if (!$user) {
            return response()->json([
                'message' => 'User not found',
                'status' => 404
            ], 404);
        }

        return (new UserResource($user));
            
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            $data = [
                'message' => 'User not found',
                'status' => 404
            ];

            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role_id' => 'required',
            'phone' => 'required',
            'lastName' => 'required',
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Validation error',
                'errors' => $validator->errors(),
                'status' => 400
            ];

            return response()->json($data, 400);
        }


        $user->name = $request->name;
        $user->email = $request->email;
        $user->role_id = $request->role_id;
        $user->phone = $request->phone;
        $user->lastName = $request->lastName;

        $user->save();

        $data = [
            'message' => 'User updated',
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    public function updateMail(Request $request, $email)
    {
        $user = User::where('email', $email)->first();

        if (!$user) {
            $data = [
                'message' => 'User not found',
                'status' => 404
            ];

            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role_id' => 'required',
            'phone' => 'required',
            'lastName' => 'required',
        ]);

        

        if ($validator->fails()) {
            $data = [
                'message' => 'Validation error',
                'errors' => $validator->errors(),
                'status' => 400
            ];

            

            return response()->json($data, 400);
        }


        $user->name = $request->name;
        $user->email = $request->email;
        $user->role_id = $request->role_id;
        $user->phone = $request->phone;
        $user->lastName = $request->lastName;

        $user->save();

        $data = [
            'message' => 'User updated',
            'status' => 200
        ];

        return response()->json($data, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($email)
{
    $user = User::where('email', $email)->first();

    if (!$user) {
        return response()->json([
            'message' => 'User not found',
            'status' => 404
        ], 404);
    }

    // Eliminar los registros relacionados en `modality_space y service_space.`
    foreach ($user->spaces as $space) {
        $space->services()->detach(); // Eliminar registros de `service_space`
        $space->modalities()->detach(); // Eliminar registros de `modality_space`
        $space->delete(); // Luego elimina el espacio
    }

    // Eliminar los comentarios y sus imágenes relacionadas
    foreach ($user->comments as $comment) {
        $comment->images()->delete(); // Elimina imágenes relacionadas
        $comment->delete(); // Luego elimina el comentario
    }

    // Finalmente, elimina el usuario
    $user->delete();

    return (new UserResource($user))
        ->additional(['meta' => 'User eliminado correctamente']);
}

}
