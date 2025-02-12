@extends('layouts.app')

@section('content')
    <h1>{{ $title }}</h1>

    <form id="add-pet-form" method="POST" action="{{ $pet ? route('petUpdate', $pet['id']) : route('petStore') }}">
        @csrf
        @if ($pet)
            @method('PUT')
        @endif

        <div class="mb-2">
            <label for="pet-id">Pet ID</label>
            <input type="number" id="pet-id" name="pet_id" value="{{ old('pet_id', $pet['id'] ?? 0) }}" required>
        </div>

        <div class="mb-2">
            <label for="pet-name">Pet Name</label>
            <input type="text" id="pet-name" name="pet_name" value="{{ old('pet_name', $pet['name'] ?? '') }}" required>
        </div>

        <div class="mb-2">
            <label for="pet-status">Pet Status</label>
            <select name="pet_status" id="pet-status">
                <option value="available" {{ old('pet_status', $pet['status'] ?? '') == 'available' ? 'selected' : '' }}>
                    Available
                </option>
                <option value="pending" {{ old('pet_status', $pet['status'] ?? '') == 'pending' ? 'selected' : '' }}>
                    Pending
                </option>
                <option value="sold" {{ old('pet_status', $pet['status'] ?? '') == 'sold' ? 'selected' : '' }}>
                    Sold
                </option>
            </select>
        </div>

        <div class="mb-2">
            <label for="category-id">Category ID</label>
            <input type="number" name="category_id" id="category-id"
                value="{{ old('category_id', $pet['category']['id'] ?? 0) }}" required>
        </div>

        <div class="mb-2">
            <label for="category-name">Category Name</label>
            <input type="text" name="category_name" id="category-name"
                value="{{ old('category_name', $pet['category']['name'] ?? '') }}" required>
        </div>

        <div class="mb-2">
            <label for="photo-urls" class="form-label">Photo URLs (separated by semicolon)</label>
            <input type="text" name="photo_urls" id="photo-urls" placeholder="e.g., url1; url2"
                value="{{ old('photo_urls', isset($pet) && $pet['photoUrls'] ? implode('; ', $pet['photoUrls']) : '') }}">
        </div>

        <div class="mb-2">
            <label for="tags" class="form-label">Tags (separated by semicolon and indexes separated by comma)</label>
            <input type="text" name="tags" id="tags" placeholder="e.g., tag1, index1; tag2, index2;"
                value="{{ old('tags',isset($pet) && $pet['tags']? implode('; ',array_map(function ($tag) {return $tag['name'] . ', ' . $tag['id'];}, $pet['tags'])): '') }}">
        </div>

        <div>
            <button type="submit" class="btn btn-primary">{{ $pet ? 'Update Pet' : 'Add Pet' }}</button>
        </div>
    </form>
@endsection
