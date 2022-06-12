@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Profil') }}</div>
                <div class="card-body">
                    <h1>Dane użytkownika</h1>
                    <div class="l-side-profile">
                        <p>Nazwa:</p>
                        <p>Email:</p>
                        <p>Hasło:</p>
                    </div>
                    <div class="r-side-profile">
                        <p>{{ $user->name }}</p>
                        <p>{{ $user->email }}</p>
                        <p>{{ $user->password }}</p>
                    </div>
                    <a href="{{ url('/profile/edit-data') }}"><button class="btn btn-danger">Edytuj</button></a>
                    <hr>
                    <h1>Adres użytkownika</h1>
                    <div class="l-side-profile">
                        <p>Kraj:</p>
                        <p>Województwo:</p>
                        <p>Miasto:</p>
                        <p>Ulica/Mieszkanie:</p>
                        <p>Kod pocztowy:</p>
                    </div>
                    <div class="r-side-profile">
                        <p>{{ $address->country }}</p>
                        <p>{{ $address->region }}</p>
                        <p>{{ $address->city }}</p>
                        <p>{{ $address->street }}/{{ $address->local }}</p>
                        <p>{{ $address->postal }}</p>
                    </div>
                    <a href="{{ url('/profile/edit-address') }}"><button class="btn btn-danger">Edytuj</button></a>
            </div>
        </div>
    </div>
</div>
@endsection
