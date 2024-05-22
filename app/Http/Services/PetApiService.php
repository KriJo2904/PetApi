<?php

namespace App\Http\Services;

use App\Constants\PetApi;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class PetApiService
{
    public function getPetById($id)
    {
        $response = Http::withUrlParameters([
            'endpoint' => config('pet_api.url'),
            'petId' => $id
        ])->get('{+endpoint}' . PetApi::FIND);
        return $this->validateResponse($response);
    }

    public function getPetsByStatus($status)
    {
        $response = Http::withUrlParameters([
            'endpoint' => config('pet_api.url'),
        ])->get('{+endpoint}' . PetApi::FIND_BY_STATUS, ['status' => $status]);
        return $this->validateResponse($response);
    }

    public function deletePet(int $id)
    {
        $response = Http::withUrlParameters([
            'endpoint' => config('pet_api.url'),
            'petId' => $id,
        ])->delete('{+endpoint}' . PetApi::DELETE);
        return $this->validateResponse($response);
    }

    public function createNewPet(array $data)
    {
        $data = $this->buildArrays($data);

        $response = Http::withUrlParameters([
            'endpoint' => config('pet_api.url'),
        ])->post('{+endpoint}' . PetApi::CREATE, $data);

        return $this->validateResponse($response);
    }

    public function updatePet(array $data, int $id)
    {
        $data['id'] = $id;

        $response = Http::withUrlParameters([
            'endpoint' => config('pet_api.url'),
        ])->post('{+endpoint}' . PetApi::UPDATE, $data);
        return $this->validateResponse($response);
    }


    public function updatePetImg(array $data, int $id)
    {
        $data['id'] = $id;

        $response = Http::withUrlParameters([
            'endpoint' => config('pet_api.url'),
            'petId' => $id,
        ])->post('{+endpoint}' . PetApi::UPDATE, $data);
        return $this->validateResponse($response);
    }

    private function buildArrays(array $data)
    {
        if (isset($data['category'])) {
            $data['category'] = ['name' => $data['category']];
        }
        if (isset($data['tags'])) {
            $tags = explode(',', $data['tags']);
            $data['tags'] = [];
            foreach ($tags as $tag) {
                $data['tags'][] = ['name' => $tag];
            }
        }

        $data['photoUrls'] = explode(',', $data['photoUrls']);

        return $data;
    }

    private function validateResponse(Response $response)
    {
        if ($response->failed()) {
            return [
                'error' => [
                    'message' => $response->json()['message'] ?? 'Wystąpił błąd podczas komunikacji z serwerem API. Spróbuj ponownie później.',
                    'status' => $response->status()
                ],
                'data' => []
            ];
        }
        return [
            'error' => null,
            'data' => $response->json()
        ];
    }
}
