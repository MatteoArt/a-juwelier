@extends('layouts.app')


@section('content')
    <div class="container py-3">
        <h2>Add a watch</h2>

        <form action="{{ route('watches.store') }}" method="POST" class="w-50">
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
                <label for="formTextarea1" class="form-label text-body-secondary">Characteristics</label>
                <textarea name="characteristics" class="form-control" id="formTextarea1" rows="3"></textarea>
            </div>
            <div class="mb-3">
                <label for="formTextarea2" class="form-label text-body-secondary">Images</label>
                <textarea name="images" class="form-control" id="formTextarea2" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-outline-success mb-2">Send</button>
        </form>
    </div>
@endsection