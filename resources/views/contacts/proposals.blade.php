@extends('layouts.app')

@section('content')
    <div class="container-fluid mb-5">
        <a href="{{ route('dashboard') }}" class="btn btn-outline-dark m-2"><i class="fa-solid fa-arrow-left"></i> Back</a>

        <div class="row gy-4">
            @foreach ($proposals as $proposal)
                <div class="col-md-6 col-lg-4 col-xxl-3">
                    <div class="card bg-light">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <h5 class="card-title">User details</h5>
                                <form action="{{ route('proposal-delete', $proposal->id) }}" class="d-inline-block"
                                    method="POST">
                                    @csrf

                                    @method('DELETE')

                                    <button type="submit" class="btn btn-outline-danger"
                                        onclick="return confirm('Are you sure you want to proceed?')">
                                        Delete
                                    </button>
                                </form>
                            </div>

                            <ul class="list-group list-group-flush">
                                <li class="list-group-item bg-transparent">Name: {{ $proposal->fullname }}</li>
                                <li class="list-group-item bg-transparent">Email: {{ $proposal->email }}</li>
                                <li class="list-group-item bg-transparent">Phone number: {{ $proposal->phone }}</li>
                                <li class="list-group-item bg-transparent">City:
                                    @if ($proposal->city)
                                        {{ $proposal->city }}
                                    @else
                                        //
                                    @endif

                                </li>
                            </ul>
                            <h5 class="card-title mt-3">Watch details</h5>
                            @php
                                $informations = json_decode($proposal->informations);
                            @endphp
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item bg-transparent">Brand: {{ $informations[0] }}</li>
                                <li class="list-group-item bg-transparent">Model: {{ $informations[1] }}</li>
                            </ul>

                            <h6 class="card-subtitle mb-2 text-body-secondary mt-4 d-inline-block">Price:
                                {{ $proposal->price }} €</h6>
                            <a href="{{ route('proposal-show', $proposal->id) }}" class="btn btn-outline-info ms-3">See all
                                details -></a>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
@endsection
