<?php

use App\Http\Controllers\PetController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => ''], function () {
    Route::get('/', [PetController::class, 'findPetByStatus'])->name('pet.findPetByStatus');

    Route::get('/get/{id}', [PetController::class, 'findPetById'])->name('pet.findPetById');

    Route::post('/update/{id}', [PetController::class, 'updatePet'])->name('pet.updatePet');
    Route::get('/update/{id}', [PetController::class, 'renderUpdatePet'])->name('pet.renderUpdatePet');


    Route::post('/add', [PetController::class, 'addPet'])->name('pet.addPet');
    Route::get('/add', [PetController::class, 'renderAddPet'])->name('pet.renderAddPet');

    Route::post('/update/{id}/uploadImg', [PetController::class, 'uploadImage'])->name('pet.imgPet');

    Route::post('/delete/{id}', [PetController::class, 'deletePet'])->name('pet.deletePet');
});
