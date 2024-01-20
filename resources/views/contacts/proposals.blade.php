@extends('layouts.app')

@section('content')
    @dump($proposals)
    <div class="container-fluid">
        <a href="{{ route('dashboard') }}" class="btn btn-outline-dark m-2"><i class="fa-solid fa-arrow-left"></i> Back</a>

        <div class="row">
            @foreach ($proposals as $proposal)
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                          <h5 class="card-title">User details</h5>
                          <ul class="list-group list-group-flush">
                            <li class="list-group-item">Name: {{ $proposal->fullname }}</li>
                            <li class="list-group-item">Email: {{ $proposal->email }}</li>
                            <li class="list-group-item">Phone number: {{ $proposal->phone }}</li>
                            <li class="list-group-item">City: 
                                @if($proposal->city)
                                    {{ $proposal->city }}
                                @else
                                    //
                                @endif
                                
                            </li>
                          </ul>
                          <h5 class="card-title mt-3">Watch details</h5>
                            @php
                                $informations = json_decode($proposal->informations)
                            @endphp
                          <ul class="list-group list-group-flush">
                            <li class="list-group-item">Brand: {{ $informations[0] }}</li>
                            <li class="list-group-item">Model: {{ $informations[1] }}</li>
                            <h6 class="card-subtitle mb-2 text-body-secondary mt-4">Price: {{ $proposal->price }} €</h6>
                          </ul>

                        </div>
                      </div>
                </div>
            @endforeach
            
        </div>
    </div>
@endsection