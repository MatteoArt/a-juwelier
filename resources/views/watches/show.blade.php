@extends('layouts.app')


@section('content')
    <div class="container my-3">
        <h2>{{ $watch->brand }}</h2>
        <h3>{{ $watch->model }}</h3>
        <div class="fs-5">Ref. {{ $watch->ref}}</div>
        <div class="fs-5 mt-2">
            Price: <span class="d-inline-block ms-1">
                € {{ number_format((float)$watch->price, 2, '.', '') }}
            </span>
        </div>
        <div class="mt-3">
            <span>Characteristics:</span>
            @php
                $strings = explode(',', $watch->characteristics);
            @endphp
            <ul class="list-group list-group-flush w-25">
                @foreach ($strings as $string)
                    <li class="list-group-item">{{ ucfirst(trim($string)) }}</li>
                @endforeach
            </ul>
        </div>
        <div class="mt-3">
            <span class="fs-5">All images:</span>
            <div class="row row-gap-3">
                @php
                    $imagesArr = json_decode($watch->images);
                @endphp
                @foreach ($imagesArr as $image)
                    <div class="col-4">
                        <img src="{{ $image }}" class="img-thumbnail" alt="{{ $watch->brand.$loop->index }}">
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
