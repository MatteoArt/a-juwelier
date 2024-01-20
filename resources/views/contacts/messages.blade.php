@extends('layouts.app')

@section('content')
    <div class="container-fluid overflow-auto" style="height: 450px">
        <a href="{{ route('dashboard') }}" class="btn btn-outline-dark m-2"><i class="fa-solid fa-arrow-left"></i> Back</a>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Message</th>
                    <th scope="col">Sent on</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($contacts as $contact)
                    <tr>
                        <td>{{ $contact->name }}</td>
                        <td>{{ $contact->email }}</td>
                        <td>{{ $contact->message }}</td>
                        <td>{{ $contact->created_at }}</td>
                        <td>
                            <form action="{{ route('contacts-delete', $contact->id) }}" class="d-inline-block"
                                method="POST">
                                @csrf

                                @method('DELETE')

                                <button type="submit" class="btn btn-outline-danger"
                                    onclick="return confirm('Are you sure you want to proceed?')">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
@endsection
