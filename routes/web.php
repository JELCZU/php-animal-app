<?php

use App\Http\Controllers\PetController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [PetController::class, 'showPets'])->name('pets');
Route::get('/pet', [PetController::class, 'showPet'])->name('pet');
Route::get('/pet/create', [PetController::class, 'showCreateEditPetForm'])->name('petCreate');
Route::post('/pet/store', [PetController::class, 'storePet'])->name('petStore');  // For creating

Route::get('/pet/{id}/edit', [PetController::class, 'showCreateEditPetForm'])->name('petEdit');
Route::put('/pet/{id}', [PetController::class, 'updatePet'])->name('petUpdate'); // For updating
Route::delete('/pets/{id}', [PetController::class, 'deletePet'])->name('petDelete');

