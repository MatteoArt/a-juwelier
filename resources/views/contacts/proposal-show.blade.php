@extends('layouts.app')

@section('content')
    <div class="container-fluid mb-5">
        <a href="{{ route('proposals') }}" class="btn btn-outline-dark m-2"><i class="fa-solid fa-arrow-left"></i> Back</a>
        <form action="{{ route('proposal-delete', $proposal->id) }}" class="d-inline-block ms-5"
            method="POST">
            @csrf

            @method('DELETE')

            <button type="submit" class="btn btn-outline-danger"
                onclick="return confirm('Are you sure you want to proceed?')">
                Delete
            </button>
        </form>
        <div class="p-3">
            <h3>User details</h3>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Name: <span class="fw-semibold">{{ $proposal->fullname }}</span></li>
                <li class="list-group-item">Email: <span class="fw-semibold">{{ $proposal->email }}</span></li>
                <li class="list-group-item">Phone number: <span class="fw-semibold">{{ $proposal->phone }}</span></li>
                <li class="list-group-item">City:
                    @if ($proposal->city)
                        <span class="fw-semibold">{{ $proposal->city }}</span>
                    @else
                        //
                    @endif

                </li>
                <li class="list-group-item">Address:
                    @if ($proposal->address)
                        <span class="fw-semibold">{{ $proposal->address }}</span>
                    @else
                        //
                    @endif

                </li>
            </ul>
            <h3>Watch details</h3>
            <h4>User price quote: <span class="fw-bold">{{ $proposal->price }} €</span></h4>
            @php
                $informations = json_decode($proposal->informations);
            @endphp
            <div class="row gy-3">
                @foreach ($labels as $label)
                    <div class="col-3">
                        {{ $label }}:
                        @if ($informations[$loop->index])
                            <span class="fw-semibold">{{ $informations[$loop->index] }}</span>
                        @else
                            //
                        @endif
                    </div>
                @endforeach
            </div>
            <h4>Photos:</h4>
            <div class="row">
                @if($proposal->photo1)
                    <div class="col-4">
                        <img src="{{ asset('/storage/' . $proposal->photo1) }}" class="img-fluid" alt="photo1">
                    </div>
                @endif
                @if($proposal->photo2)
                    <div class="col-4">
                        <img src="{{ asset('/storage/' . $proposal->photo2) }}" class="img-fluid" alt="photo2">
                    </div>
                @endif
                @if($proposal->photo3)
                    <div class="col-4">
                        <img src="{{ asset('/storage/' . $proposal->photo3) }}" class="img-fluid" alt="photo3">
                    </div>
                @endif
            </div>
            <div class="mt-4 w-25">Note: 
                @if($proposal->note)
                    <p>{{ $proposal->note }}</p>
                @else
                    //
                @endif
            </div>
        </div>
    </div>
@endsection
