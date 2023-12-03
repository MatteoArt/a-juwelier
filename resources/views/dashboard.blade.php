@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="fs-4 text-secondary my-4">
            Welcome to your <span class="text-uppercase">dashboard</span>,
            <span class="text-primary-emphasis">{{ Auth::user()->name }}</span>
        </h2>
        <div class="row justify-content-center">
            @dump($watches)
            <div class="col">
                <div class="card">
                    <div class="card-header">See all your watches</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="row">
                            @foreach ($watches as $watch)
                                <div class="col-sm-4">
                                    <div class="card">
                                        @php
                                            $path = json_decode($watch->images)
                                        @endphp
                                        <img src="{{ $path[0] }}" class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <h5 class="card-title"> {{ $watch->brand }} </h5>
                                            <h6 class="card-subtitle mb-2 text-body-secondary"> {{ $watch->model }} </h6>
                                            <span>Price: €{{ $watch->price }}</span>
                                            <p class="card-text">Some quick example text to build on the card title and make
                                                up the bulk of the card's content.</p>
                                            <a href="#" class="btn btn-primary">Go somewhere</a>
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
