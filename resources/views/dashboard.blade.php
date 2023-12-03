@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="fs-4 text-secondary my-4">
        Welcome to your <span class="text-uppercase">dashboard</span>,
        <span class="text-primary-emphasis">{{ Auth::user()->name }}</span>
    </h2>
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="card-header">See all your watches</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
