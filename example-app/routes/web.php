<?php


use App\Http\Controllers\PetsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/pet', [PetsController::class, 'show']);

//MOSTRAR CATEGORIAS
Route::get('/categories', [PetsController::class, 'categoriesShow']);

// CREAR UN PET 
Route::post('/pet/create', [PetsController::class, 'addPet']);

//BUSCAR POR ESTATUS
Route::get('/pet/findByStatus/{status}', [PetsController::class, 'getByStatus'] );

//BUSCAR POR ID
Route::get('/pet/{id}', [PetsController::class, 'findPet'] );

//ACTUALIZAR REGISTRO
Route::put('/pet/actu/{id}', [PetsController::class, 'updatePet']);

//ELIMINAR PET POR ID 
Route::delete('/pet/{petId}', [PetsController::class, 'delete']);

Route::get('/token', function () {
    return response()->json(['csrf_token' => csrf_token()]);
});