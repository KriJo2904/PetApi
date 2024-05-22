<?php

namespace App\Http\Controllers;

use App\Constants\PetApi;
use App\Http\Requests\Pet;
use App\Http\Services\PetApiService;
use Illuminate\Http\Request;

class PetController extends Controller
{

    public function renderAddPet()
    {
        return view('pet.create-pet', [
            'statuses' => PetApi::STATUSES,
            'categories' => PetApi::CATEGORIES
        ]);
    }

    public function renderUpdatePet($id = null)
    {
        try{
            $data = app(PetApiService::class)->getPetById($id);

            $data['data']['tags'] = implode(',', array_map(function ($tag) {
                return $tag['name'];
            }, $data['data']['tags'] ?? []));

            $data['data']['photoUrls'] = implode(',', $data['data']['photoUrls'] ?? []);

            return view('pet.edit-pet', [
                'pet' => $data['data'], 'error' => $data['error'],
                'statuses' => PetApi::STATUSES,
                'categories' => PetApi::CATEGORIES
            ]);
        }
        catch (\Exception $e){
            return abort(500, $e->getMessage());
        }

    }


    public function findPetById(Pet\FindPetById $request, $id = null)
    {
        try{
            $data = app(PetApiService::class)->getPetById($id);

            return view('pet.find-pet-by-id', [
                'pet' => $data['data'], 'error' => $data['error']
            ]);
        }
        catch (\Exception $e){
            return abort(500, $e->getMessage());
        }

    }

    public function findPetByStatus(Pet\FindPetByStatus $request)
    {
        try{
            $data = app(PetApiService::class)->getPetsByStatus($request->status);
            if (isset($data['error'])) {
                return redirect()->back()->withErrors($data['error']);
            }
            return view('pet.list-pets', [
                'pets' => $data['data'], 'error' => $data['error'], 'oldStatus' => $request->status,
                'statuses' => PetApi::STATUSES
            ]);
        }
        catch (\Exception $e){
            return abort(500, $e->getMessage());
        }
    }

    public function updatePet(Pet\UpdatePet $request, $id)
    {
        try{
            $data = app(PetApiService::class)->updatePet($request->only('name', 'status'), $id);
            if (isset($data['error'])) {
                return redirect()->back()->withInput($request->all())->withErrors($data['error']);
            }
            return redirect()->route('pet.findPetById', ['id' => $id])->with('success', 'Pet updated successfully');
        }
        catch (\Exception $e){
            return abort(500, $e->getMessage());
        }
    }


    public function deletePet(Pet\DeletePet $request, $id)
    {
        try{
            $data = app(PetApiService::class)->deletePet($id);
            if (isset($data['error'])) {
                return redirect()->back()->withErrors($data['error']);
            }
            return redirect()->back()->with('success', 'Pet deleted successfully');
        }
        catch (\Exception $e){
            return abort(500, $e->getMessage());
        }
    }

    public function addPet(Pet\CreatePet $request)
    {
        try{
            $data = app(PetApiService::class)->createNewPet($request->all());
            if (isset($data['error'])) {
                return redirect()->back()->withInput($request->all())->withErrors($data['error']);
            }
            return redirect()->route('pet.findPetById', ['id' => $data['data']['id']])->with('success', 'Pet created successfully');;
        }
        catch (\Exception $e){
            return abort(500, $e->getMessage());
        }

    }
}
