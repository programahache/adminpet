<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pets;
use App\Models\CategoriesModel;
use App\Models\ApiResponse;

class PetsController extends Controller
{

    private function addApi($code, $message, $type)
    {
        $apiResponse = new ApiResponse();

        $apiResponse->code = $code;
        $apiResponse->message = $message;
        $apiResponse->type = $type;
        $apiResponse->save();
    }

    //CREAR MASCOTAS 
    public function addPet(Request $request)
    {

        try {
            // VALIDO LA SOLICITUD 
            $request->validate([
                'name' => 'required|string|max:255',
                'photoUrls' => 'required|array',
                'tags' => 'required|array',
                'status' => 'required|in:available,pending,sold',
                'category_id' => 'required|exists:category,id',
            ]);

            // CREAMOS LA MASCOTA 
            $pet = Pets::create([
                'name' => $request->name,
                'photoUrls' => json_encode($request->photoUrls),
                'tags' => json_encode($request->tags),
                'status' => $request->status,
                'category_id' => $request->category_id,
            ]);

            $this->addApi(201, 'Creado correctamente', 'POST');
            // Devolver una respuesta
            return response()->json($pet, 201);
        } catch (\Throwable $th) {
            $this->addApi(400, 'Error en la creacion', 'POST');
            return $th;
        }
    }

    //MOSTRAR CATEGORIAS
    public function categoriesShow()
    {
        return CategoriesModel::all();
    }

    // MOSTRAR TODAS LAS MASCOTAS 
    public function show()
    {
        $this->addApi(200, 'Solicitado correctamente', 'GET');
        return Pets::all();
    }

    //BUSCAR MASCOTA POR ID
    public function findPet($id)
    {
        $pet = Pets::find($id);
        if ($pet) {
            $this->addApi(200, 'Pet encontrado correctamente', 'GET');
            return Pets::find($id);
        } else {
            $this->addApi(400, 'No econtrado', 'GET');
            return "Registro no encontrado";
        }
    }

    //OBTENER POR STATUS
    public function getByStatus($status)
    {
        $pets = Pets::where('status', $status)->get();

        if (count($pets) > 0) {
            $this->addApi(200, 'Datos obetenidos correcatmente', 'GET');
            return $pets;
        } else {
            $this->addApi(400, 'Registro no encontrado', 'GET');
            return "Registro no encontrado";
        }
    }



    // ACTUALIZAR MASCOTA 
    public function updatePet(Request $request, $id)
    {

        $pet = Pets::find($id);

        $pet->update($request->all());

        // Devolver una respuesta
        $this->addApi(200, 'Mascota actualizada', 'PUT');
        return response()->json($pet, 201);
    }

    // ELIMINAR MASCOTA 
    public function delete($id)
    {
        $pet = Pets::find($id);
        if ($pet) {
            $pet->delete();
            $this->addApi(200, 'Eliminado correctamente', 'DESTROY');
            return response()->json('Eliminado correctamente', 201);
        } else {
            $this->addApi(400, 'Registro no encontrado', 'DESTROY');
            return response()->json('Registro no encontrado', 400);
        }
    }
}
