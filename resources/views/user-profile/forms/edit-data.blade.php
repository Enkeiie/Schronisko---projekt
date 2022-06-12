@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <a href="{{ url('/profile') }}"><button class="btn btn-danger">Powróć</button></a>
                <form class="form form-control" method="POST" action="{{ url('profile/edit-data/apply') }}">
                    @csrf
                    @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                    @endif
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <input type="hidden" name="id" value="{{ $user->id }}">
                    <p>Nazwa:</p>
                    <input type="text" name="name" value="{{$user->name}}">
                    <p>Email:</p>
                    <input type="email" name="email" value="{{$user->email}}">
                    <p>Hasło:</p>
                    <input type="password" name="password" value="{{$user->password}}"><br>
                    <input class="btn btn-info"  type="submit" value="Zmień dane">
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
