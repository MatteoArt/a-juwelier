@extends('layouts.app')


@section('content')
    <a href="{{ route('dashboard') }}" class="btn btn-outline-dark m-3"><i class="fa-solid fa-arrow-left"></i> Back</a> 
    <div class="container py-3">
        <h2>Add a watch</h2>

        <form action="{{ route('watches.store') }}" method="POST" enctype="multipart/form-data"
        class="w-50">
            @csrf

            <div class="mb-3">
                <label for="brandInput" class="form-label text-body-secondary">Brand</label>
                <input type="text" name="brand" class="form-control" id="brandInput">
            </div>
            <div class="mb-3">
                <label for="modelInput" class="form-label text-body-secondary">Model</label>
                <input type="text" name="model" class="form-control" id="modelInput">
            </div>
            <div class="mb-3">
                <label for="priceInput" class="form-label text-body-secondary">Price</label>
                <input type="text" name="price" class="form-control" id="priceInput">
            </div>
            <div class="mb-3">
                <label for="refInput" class="form-label text-body-secondary">Ref. </label>
                <input type="text" name="ref" class="form-control" id="refInput">
            </div>
            <div class="mb-3">
                <fieldset class="border p-4">
                    <legend style="font-size: 1.3rem" class="text-body-secondary mb-3">Characteristics</legend>
                    @foreach ($labels as $label)
                       <label for="label{{ $label }}" class="form-label text-body-secondary">{{ $label }}</label>
                       <input type="text" name="characteristics[]" class="form-control" id="label{{ $label }}">
                    @endforeach
                </fieldset>
            </div>
            <div class="mb-3">
                <label for="imagesInput" class="form-label text-body-secondary">Images</label>
                <input type="file" class="form-control" name="images[]" id="imagesInput" accept="image/*" multiple>
            </div>
            <button type="submit" class="btn btn-outline-success mb-2">Send</button>
        </form>
    </div>
@endsection