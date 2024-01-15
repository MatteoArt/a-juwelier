@extends('layouts.app')


@section('content')
    <a href="{{ route('dashboard') }}" class="btn btn-outline-dark m-3"><i class="fa-solid fa-arrow-left"></i> Back</a>
    <div class="container-lg my-3">
        <div class="d-flex align-items-center my-position">
            <h2 class="me-4 my-title-small">{{ $watch->brand }}</h2>
            <a href="{{ route('watches.edit', $watch->slug) }}" class="btn btn-outline-warning ms-5 my-position-btn-1">
                Edit
                <i class="fa-solid fa-pen-to-square fa-lg"></i>
            </a>
            <form action="{{ route('watches.destroy', $watch->slug) }}" class="ms-2 my-position-btn-2 my-position-btn-2-extra-small" method="POST">
                @csrf

                @method('DELETE')

                <button type="submit" class="btn btn-outline-danger"
                onclick="return confirm('Are you sure you want to proceed?')">
                    Delete
                    <i class="fa-solid fa-trash"></i>
                </button>
            </form>
        </div>
        <h3>{{ $watch->model }}</h3>
        <div class="fs-5">Ref. {{ $watch->ref }}</div>
        <div class="fs-5 mt-2">
            Price: <span class="d-inline-block ms-1">
                € {{ number_format((float) $watch->price, 2, '.', '') }}
            </span>
        </div>
        <div class="mt-3">
            <span>Characteristics:</span>
            @php
                $strings = json_decode($watch->characteristics);
            @endphp
            <ul class="list-group list-group-flush my-width">
                @foreach ($strings as $string)
                    <li class="list-group-item d-flex justify-content-between align-items-center ps-0">
                        <span class="fw-semibold">{{ $labels[$loop->index] }}</span>
                        <div class="my-list-width">{{ ucfirst(trim($string)) }}</div>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="mt-3">
            <span class="fs-5 d-block mb-2">All images:</span>
            <div class="d-flex flex-wrap row-gap-3">
                @php
                    $imagesArr = json_decode($watch->images);
                @endphp
                @foreach ($imagesArr as $image)
                <div class="img-show-container">
                    <img src="{{ asset('/storage/' . $image) }}" class="img-fluid me-3"
                        alt="{{ $watch->brand . $loop->index }}">
                </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
