<?php $i = 1; ?>
@extends('layouts.app')

@section('content')
    <h1>Pets</h1>
    <div class='d-flex justify-content-between mb-3'><a href="{{ route('petCreate') }}"><button type="button"
                class="btn btn-primary">Add new
                pet</button></a>
        <div>
            <form method="GET" action="{{ route('pets') }}">

                <select class="form-select" aria-label="Filter Pets" name="status" onchange="this.form.submit()">

                    <option value="available" {{ request('status') == 'available' ? 'selected' : '' }}>
                        Available
                    </option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="sold" {{ request('status') == 'sold' ? 'selected' : '' }}>Sold</option>
                </select>
            </form>
        </div>
    </div>
    <table class="table table-striped ">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Status</th>
                <th scope="col">Id</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pets as $pet)
                <tr>
                    <th scope="row">{{ $i }}</th>
                    <td>{{ $pet['name'] ?? '' }}</td>
                    <td>{{ $pet['status'] ?? '' }}</td>
                    <td>{{ $pet['id'] ?? '' }}</td>
                    <td class="d-flex ">
                        <div class='p-1'><a href="{{ route('pet', ['id' => $pet['id']]) }}"><button type="button"
                                    class="btn btn-primary">Pet
                                    details</button></a></div>
                        <div class='p-1'>
                            <a href="{{ route('petEdit', ['id' => $pet['id']]) }}">
                                <button type="button" class="btn btn-secondary">Edit pet</button>
                            </a>
                        </div>
                        <div class='p-1'>
                            <form id="delete-pet-form" method="POST"
                                action="{{ route('petDelete', ['id' => $pet['id']]) }}">
                                @csrf
                                @method('DELETE')<button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Are you sure you want to delete this pet?')">Delete
                                    pet</button></form>
                        </div>

                    </td>
                </tr>
                <?php $i++; ?>
            @endforeach
        </tbody>
    </table>
@endsection
