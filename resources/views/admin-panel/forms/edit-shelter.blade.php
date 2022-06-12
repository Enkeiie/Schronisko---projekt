@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <a href="{{ url('/admin-panel/shelters-list') }}"><button class="btn btn-danger">Powróć</button></a>
                <form class="form form-control" method="POST" action="{{ url('admin-panel/shelters-list/edit/'.$shelter->id.'/apply') }}" enctype="multipart/form-data">
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
                    <p>Obrazek</p>
                    <input type="hidden" name="sid" value="{{ $shelter->id }}">
                    <input type="file" name="image" placeholder="Choose image" id="image">
                    <p>Nazwa</p>
                    <input class="input-text" type="text" name="name" value='{{ $shelter->name }}'>
                    <p>Telefon</p>
                    <input class="input-text" type="text" name="phone" value='{{ $shelter->phone }}'>
                    <p>NIP</p>
                    <input class="input-text" type="text" name="NIP" value='{{ $shelter->NIP }}'>
                    <p>Email</p>
                    <input class="input-text" type="email" name="mail" value='{{ $shelter->mail }}'>
                    <p>Kraj:</p>
                    <input type="hidden" name="id" value="{{ $shelter->address }}">
                    <input class="input-text" type="text" name="country" value='{{ $address->country }}'>
                    <p>Województwo:</p>
                    <input class="input-text" type="text" name="region" value='{{ $address->region }}'>
                    <p>Miasto:</p>
                    <input class="input-text" type="text" name="city" value='{{ $address->city }}'>
                    <p>Ulica:</p>
                    <input class="input-text" type="text" name="street" value='{{ $address->street }}' >
                    <p>Mieszkanie:</p>
                    <input class="input-number" type="number" name="local"value='{{ $address->local }}' >
                    <p>Kod pocztowy:</p>
                    <input class="input-text" type="text" name="postal" value='{{ $address->postal }}'><br>
                    <input class="btn btn-info"  type="submit" value="Edytuj schronisko">
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
