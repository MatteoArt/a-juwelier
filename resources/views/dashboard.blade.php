@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-md-flex align-items-md-center justify-content-md-between">
            <h2 class="fs-4 text-secondary my-4">
                Welcome to your <span class="text-uppercase">dashboard</span>,
                <span class="text-primary-emphasis">{{ Auth::user()->name }}</span>
            </h2>
            <div class="text-end text-md-start mb-3 mb-md-0">
                <a href="{{ route('watches.create') }}" class="btn btn-outline-success">Add <i
                        class="fa-solid fa-plus"></i></a>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header d-sm-flex align-items-sm-center gap-4 my-padding-small">
                        <span class="d-inline-block mb-2 mb-sm-0">Your watches</span>
                        <form action="" style="width: 300px" class="my-form-width">
                            <div class="input-group">
                                <input type="text" class="form-control my-form-control" placeholder="Filter by brand/model/ref">
                                <button type="submit" class="btn btn-dark my-form-button"><i class="fa-solid fa-magnifying-glass"></i></button>
                            </div>
                        </form>
                    </div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="row row-gap-3">
                            @foreach ($watches as $watch)
                                <div class="col-md-6 col-lg-4">
                                    <div class="card h-100">
                                        @php
                                            $path = json_decode($watch->images);
                                        @endphp
                                        <div class="my-img-container">
                                            <img src="{{ asset('/storage/' . $path[0]) }}" class="card-img-top"
                                                alt="{{ $watch->brand }}">
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
                                            @php
                                                $strings = json_decode($watch->characteristics);
                                            @endphp
                                            <p class="card-text">
                                                @foreach ($strings as $string)
                                                    @if ($loop->last)
                                                        <span>{{ $string }}.</span>
                                                    @else
                                                        <span>{{ $string }},</span>
                                                    @endif
                                                @endforeach
                                            </p>
                                            <div class="d-flex justify-content-between mt-auto">
                                                <a href="{{ route('watches.show', $watch->slug) }}"
                                                    class="btn btn-outline-info">
                                                    <i class="fa-solid fa-eye"></i>
                                                </a>
                                                <div>
                                                    <a href="{{ route('watches.edit', $watch->slug) }}"
                                                        class="btn btn-outline-warning">
                                                        Edit
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                    </a>
                                                    <form action="{{ route('watches.destroy', $watch->slug) }}"
                                                        class="d-inline-block ms-1 my-delete" method="POST">
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
