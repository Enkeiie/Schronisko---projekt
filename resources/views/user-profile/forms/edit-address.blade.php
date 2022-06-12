@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <a href="{{ url('/profile') }}"><button class="btn btn-danger">Powróć</button></a>
                <form class="form form-control" method="POST" action="{{ url('profile/edit-address/apply') }}">
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
                    <input type="hidden" value="{{ $address->id }}" name="id"/>
                    <p>Kraj:</p>
                    <input class="input-text" type="text" name="country" value="{{ $address->country }}"/>
                    <p>Województwo:</p>
                    <input class="input-text" type="text" name="region" value="{{ $address->region }}"/>
                    <p>Miasto:</p>
                    <input class="input-text" type="text" name="city" value="{{ $address->city }}"/>
                    <p>Ulica:</p>
                    <input class="input-text" type="text" name="street" value="{{ $address->street }}"/>
                    <p>Mieszkanie:</p>
                    <input class="input-number" type="number" name="local" value="{{ $address->local }}"/>
                    <p>Kod pocztowy:</p>
                    <input class="input-text" type="text" name="postal" value="{{ $address->postal }}"/><br>
                    <input class="btn btn-info"  type="submit" value="Zmień dane"/>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
