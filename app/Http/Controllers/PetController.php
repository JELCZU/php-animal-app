<?php

namespace App\Http\Controllers;

use App\Models\Pet;

use Illuminate\Http\Request;

class PetController extends Controller
{
    function showHome()
    {

        return view('pages.home', ['title' => 'Home']);
    }
    function showPets(Request $request)
    {
        $status = $request->query('status');
        $pets = (new Pet)->getPetsByStatus($status);

        return view('pages.pets', ['title' => 'Pets', 'pets' => $pets]);
    }
    function showPet(Request $request)
    {
        $id = $request->query('id');

        if ($id) {
            $pet = (new Pet)->getPetById($id);
            if ($pet) {
                return view('pages.pet', ['title' => $pet['name'] ?? "Pet", 'pet' => $pet]);
            } else {
                return redirect()->route('pets')->with('error', 'Pet not found');

            }
        }
        return redirect()->route('pets')->with('error', 'Pet ID is required');
    }
    function deletePet($id)
    {

        $response = (new Pet)->deletePet($id);

        if ($response['code'] == 200) {
            return redirect()->route('pets')->with('success', 'Pet deleted successfully');
        } else {
            return redirect()->route('pets')->with('error', 'Error deleting pet');
        }
    }
    public function showCreateEditPetForm(Request $request, $id = null)
    {
        $pet = null;

        if ($id) {
            $pet = (new Pet)->getPetById($id);
        }
        return view('pages.create-edit-pet', [
            'title' => $id ? 'Edit Pet' : 'Create Pet',
            'pet' => $pet,
        ]);
    }
    public function storePet(Request $request)
    {
        // Prepare the data to be sent to the API for creating a pet
        $data = [
            'id' => $request->input('pet_id'),
            'category' => [
                'id' => $request->input('category_id'),
                'name' => $request->input('category_name'),
            ],
            'name' => $request->input('pet_name'),
            'photoUrls' => explode(';', $request->input('photo_urls')), // Split the photo URLs by semicolon
            'tags' => $this->prepareTags($request->input('tags')), // Prepare the tags
            'status' => $request->input('pet_status'),
        ];

        // Call the Pet model to create a new pet
        $pet = (new Pet())->postPet($data);

        return redirect()->route('pets')->with('success', 'Pet created successfully!');
    }

    public function updatePet(Request $request, $id)
    {
        // Prepare the data to be sent to the API for updating an existing pet
        $data = [
            'id' => $request->input('pet_id'),
            'category' => [
                'id' => $request->input('category_id'),
                'name' => $request->input('category_name'),
            ],
            'name' => $request->input('pet_name'),
            'photoUrls' => explode(';', $request->input('photo_urls')), // Split the photo URLs by semicolon
            'tags' => $this->prepareTags($request->input('tags')), // Prepare the tags
            'status' => $request->input('pet_status'),
        ];
        $pet = (new Pet())->putPet($data);

        return redirect()->route('pets')->with('success', 'Pet updated successfully!');
    }


    private function prepareTags($tagsInput)
    {
        $tags = [];
        $tagEntries = explode(';', $tagsInput);

        foreach ($tagEntries as $entry) {
            $entry = trim($entry);
            if (empty($entry))
                continue;

            [$name, $id] = array_map('trim', explode(',', $entry));

            $tags[] = [
                'id' => (int) $id,
                'name' => $name
            ];
        }

        return $tags;
    }

}
