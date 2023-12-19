@extends('layouts.app')


@section('content')
    <a href="{{ route('dashboard') }}" class="btn btn-outline-dark m-3"><i class="fa-solid fa-arrow-left"></i> Back to dashboard</a>
    <div class="container py-3">
        <h2>Edit watch</h2>
        <form action="{{ route('watches.update', $watch->slug) }}" method="POST" class="w-50" enctype="multipart/form-data">
            @csrf

            @method('PUT')

            <div class="mb-3">
                <label for="brandInput" class="form-label text-body-secondary">Brand</label>
                <input type="text" name="brand" class="form-control" id="brandInput" value="{{ $watch->brand }}">
            </div>
            <div class="mb-3">
                <label for="modelInput" class="form-label text-body-secondary">Model</label>
                <input type="text" name="model" class="form-control" id="modelInput" value="{{ $watch->model }}">
            </div>
            <div class="mb-3">
                <label for="priceInput" class="form-label text-body-secondary">Price</label>
                <input type="text" name="price" class="form-control" id="priceInput" value="{{ $watch->price }}">
            </div>
            <div class="mb-3">
                <label for="refInput" class="form-label text-body-secondary">Ref. </label>
                <input type="text" name="ref" class="form-control" id="refInput" value="{{ $watch->ref }}">
            </div>
            <div class="mb-3">
                @php
                    $labels = json_decode($watch->labels);
                    $characteristics = json_decode($watch->characteristics)
                @endphp
                <fieldset class="border p-4">
                    <legend style="font-size: 1.3rem" class="text-body-secondary mb-3">Characteristics</legend>
                    @foreach ($labels as $label)
                        <label for="label{{ $label }}" class="form-label text-body-secondary">{{ $label }}</label>
                        <input type="text" name="characteristics[]" class="form-control" id="label{{ $label }}"
                        value="{{ $characteristics[$loop->index] }}">
                    @endforeach
                </fieldset>
            </div>
            <div class="mb-3">
                <label for="imagesInput" class="form-label text-body-secondary">Images</label>
                @php
                    $imagesArr = json_decode($watch->images);
                @endphp
                <div class="my-old-img-container pb-3 pt-2 mb-3">
                    <p>Old images</p>
                    @foreach ($imagesArr as $image)
                        <img src="{{ asset('/storage/' . $image) }}" class="img-thumbnail my-thumb"
                            alt="{{ $watch->brand . $loop->index }}">
                    @endforeach
                </div>

                <input type="file" class="form-control" name="images[]" id="imagesInput" accept="image/*" multiple>
            </div>
            <button type="submit" class="btn btn-outline-success mb-2">Send</button>
        </form>
    </div>
@endsection
