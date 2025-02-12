@extends('layouts.app')
{{-- @section('title')
Main page
@endsection --}}
@section('content')
    <h1>Pet</h1>
    <ul class="list-group">
        <li class="list-group-item"><b>Name: </b>{{ $pet['name'] ?? '' }}</li>
        <li class="list-group-item"><b>Status: </b>{{ $pet['status'] ?? '' }}</li>
        <li class="list-group-item"><b>Id: </b>{{ $pet['id'] ?? '' }}</li>
        <li class="list-group-item"><b>Category name: </b>{{ $pet['category']['name'] ?? '' }}</li>
        <li class="list-group-item"><b>Category id: </b>{{ $pet['category']['id'] ?? '' }}</li>
        <li class="list-group-item">
            <b>Photo URLs: </b>
            <ul>
                @foreach ($pet['photoUrls'] as $url)
                    <li>{{ $url }}</li>
                @endforeach
            </ul>

        </li>
        <li class="list-group-item">
            <b>Tags: </b>
            <ul>
                @foreach ($pet['tags'] as $tag)
                    <li>Id: {{ $tag['id'] }}</br> Name: {{ $tag['name'] }}</li>
                @endforeach
            </ul>

        </li>
    </ul>
@endsection
