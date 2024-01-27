@extends('layouts.app')
@section('content')

<div class="jumbotron p-5 rounded-3 my-bg-home">
    <div class="container py-5">
        <div class="my-logo-container">
            <img src="{{ asset('images/a-juwelier.jpg') }}" class="img-fluid" alt="a juwelier logo">
        </div>
        <h1 class="display-5 fw-bold">
            Welcome to your personal area
        </h1>

        <p class="col-md-8 fs-4 mt-3 mb-4">Here you can manage your website A Juwelier</p>
        <a href="{{ env(APP_FRONTEND_URL) }}" class="btn btn-outline-success btn-lg" target="_blank" type="button">Go to site</a>
    </div>
</div>
@endsection