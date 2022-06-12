@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $shelter->name }}</div>
                <img src="{{ asset('images').'\s'.$shelter->id.'.png' }}" style="width: 100%; height: 250px;">
                <div class="card-body">
                    <h1>Dane Schroniska</h1>
                    <div class="l-side-profile">
                        <p>Nazwa:</p>
                        <p>Email:</p>
                        <p>Telefon:</p>
                        <p>NIP:</p>
                        <p>Kraj:</p>
                        <p>Województwo:</p>
                        <p>Miasto:</p>
                        <p>Ulica:</p>
                        <p>Kod pocztowy:</p>
                    </div>
                    <div class="r-side-profile">
                        <p>{{ $shelter->name }}</p>
                        <p>{{ $shelter->mail }}</p>
                        <p>{{ $shelter->phone }}</p>
                        <p>{{ $shelter->NIP }}</p>
                        <p>{{ $address->country }}</p>
                        <p>{{ $address->region }}</p>
                        <p>{{ $address->city }}</p>
                        <p>{{ $address->street.'/'.$address->local }}</p>
                        <p>{{ $address->postal }}</p>
                    </div>
                    @if (Auth::user()->shelter==$shelter->id)
                        <a href="{{ url('/admin-panel/shelters-list/edit/'.$shelter->id) }}"><button class="btn btn-danger">Edytuj</button></a>
                    @endif
                    <hr/>
                    @if (Auth::user()->shelter!=$shelter->id)
                        <h1>Dane kontaktowe</h1>
                        <div class="l-side-profile">
                            <p>Email:</p>
                            <p>Telefon:</p>
                        </div>
                        <div class="r-side-profile">
                            <p>{{ $shelter->mail }}</p>
                            <p>{{ $shelter->phone }}</p>
                        </div>
                    @endif
            </div>
        </div>
    </div>
</div>
@endsection
