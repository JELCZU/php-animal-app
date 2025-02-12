<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class Pet extends Model
{
    // Base API URL
    protected $apiUrl = "https://petstore.swagger.io/v2";

    // Custom HTTP client
    protected $customHttp;

    // Constructor to initialize custom HTTP client
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->customHttp = Http::withOptions(['verify' => false]);
    }

    // Upload an image for a specific pet by ID
    public function postPetImage($petId, $imagePath)
    {
        $response = $this->customHttp->attach(
            'image',
            file_get_contents($imagePath),
            'pet-image.jpg'
        )->post("{$this->apiUrl}/pet/{$petId}/uploadImage");

        return $response->json();
    }

    // Create a new pet
    public function postPet($data)
    {
        $response = $this->customHttp->post("{$this->apiUrl}/pet", [
            'id' => $data['id'] ?? null,
            'category' => [
                'id' => $data['category_id'] ?? 0,
                'name' => $data['category_name'] ?? 'Uncategorized',
            ],
            'name' => $data['name'],
            'photoUrls' => $data['photo_urls'] ?? [],
            'tags' => $data['tags'] ?? [],
            'status' => $data['status'] ?? 'available',
        ]);

        return $response->json();
    }

    public function putPet($data)
    {
        $response = $this->customHttp->put("{$this->apiUrl}/pet", $data);

        return $response->json();
    }

    public function getPetsByStatus($status = "available")
    {
        $response = $this->customHttp->get("{$this->apiUrl}/pet/findByStatus", [
            'status' => $status
        ]);

        return $response->json();
    }

    // Get a pet by ID
    public function getPetById($id)
    {
        $response = $this->customHttp->get("{$this->apiUrl}/pet/{$id}");

        return $response->json();
    }

    // Update pet information by ID
    public function putPetById($id, $data)
    {
        // Fix this line by referencing correct $this->customHttp
        $response = $this->customHttp->put("{$this->apiUrl}/pet", $data);

        return $response->json();
    }

    // Delete a pet by ID
    public function deletePet($id)
    {
        $response = $this->customHttp->delete("{$this->apiUrl}/pet/{$id}");

        return $response->json();
    }
}
