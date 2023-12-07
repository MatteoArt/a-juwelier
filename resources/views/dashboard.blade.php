@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex align-items-center justify-content-between">
            <h2 class="fs-4 text-secondary my-4">
                Welcome to your <span class="text-uppercase">dashboard</span>,
                <span class="text-primary-emphasis">{{ Auth::user()->name }}</span>
            </h2>
            <a href="{{ route('watches.create') }}" class="btn btn-outline-success">Add <i class="fa-solid fa-plus"></i></a>
        </div>
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">See all your watches</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="row row-gap-3">
                            @foreach ($watches as $watch)
                                <div class="col-sm-4">
                                    <div class="card h-100">
                                        @php
                                            $path = json_decode($watch->images);
                                        @endphp
                                        <div class="my-img-container">
                                            <img src="{{ $path[0] }}" class="card-img-top" alt="{{ $watch->brand }}">
                                        </div>

                                        <div class="card-body d-flex flex-column">
                                            <h5 class="card-title"> {{ $watch->brand }} </h5>
                                            <h6 class="card-subtitle mb-2 text-body-secondary"> {{ $watch->model }} </h6>
                                            <div>Ref. {{ $watch->ref }}</div>
                                            <div class="mt-2">Price: <span class="d-inline-block ms-1">
                                                    € {{ number_format((float) $watch->price, 2, '.', '') }}
                                                </span>
                                            </div>
                                            <div class="mt-3">Characteristics:</div>
                                            <p class="card-text">
                                                {{ $watch->characteristics }}.
                                            </p>
                                            <div class="d-flex justify-content-between mt-auto">
                                                <a href="{{ route('watches.show', $watch->slug) }}"
                                                    class="btn btn-outline-info">
                                                    <i class="fa-solid fa-eye"></i>
                                                </a>
                                                <div>
                                                    <a href="{{ route('watches.edit', $watch->slug) }}" class="btn btn-outline-warning">
                                                        Edit
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                    </a>
                                                    <form action="{{ route('watches.destroy', $watch->slug) }}" class="d-inline-block ms-1 my-delete" method="POST">
                                                        @csrf

                                                        @method('DELETE')

                                                        <button type="submit" class="btn btn-outline-danger"
                                                        onclick="return confirm('Are you sure you want to proceed?')">
                                                            Delete
                                                            <i class="fa-solid fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
