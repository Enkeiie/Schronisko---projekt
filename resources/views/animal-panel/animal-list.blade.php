@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="card">
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
            <a href="{{ url('/admin-panel') }}"><button class="btn btn-danger">Powróć</button></a>
            <h1>Lista Zwierzaków:</h1>
            <a href="{{ url('/animal-panel/create') }}"><button class="btn btn-warning">Dodaj</button></a>
            <table class="table table-striped">
                <tr style="text-align: center;" class="table table-dark">
                    <th>Zdjęcie</th>
                    <th>Imię</th>
                    <th>Wiek</th>
                    <th>Płeć</th>
                    <th>Rasa</th>
                    <th>Schronisko</th>
                    <th>Użytkownik</th>
                    <th></th>
                    <th></th>
                </tr>
                @foreach ($animals as $animal)
                    <tr>
                        <td><img style="width: 150px; height: 150px" src="{{ asset('images').'\a'.$animal->id.'.png' }}"></td>
                        <td>{{ $animal->name }}</td>
                        <td>{{ $animal->age }}</td>
                        <td>{{ $animal->gender }}</td>
                            @foreach ($races as $race)
                            @foreach ($species as $specie)
                            @if($race->species==$specie->id && $race->id==$animal->race)
                                <td>{{ $specie->name.' '.$race->name }}</td>
                            @endif
                            @endforeach
                            @endforeach
                            <td>
                            @foreach ($shelters as $shelter)
                                @if($shelter->id==$animal->shelter)
                                    {{$shelter->name}}
                                        @foreach ($addresses as $address)
                                            @if($shelter->address == $address->id)
                                                {{ $address->country.' '.$address->region.' '.$address->city.' '.$address->street.'/'.$address->local.' '.$address->postal}}</td>
                                            @endif
                                        @endforeach
                                @endif
                            @endforeach
                                </td>
                            <td>
                            @foreach ($users as $user)
                                @if($animal->user==$user->id)
                                {{ $user->name }}
                                    @foreach ($addresses as $address)
                                        @if($user->address == $address->id)
                                            {{ $address->country.' '.$address->region.' '.$address->city.' '.$address->street.'/'.$address->local.' '.$address->postal}}</td>
                                        @endif
                                    @endforeach
                                @endif
                            @endforeach
                            </td>
                            <td><a href="{{ url('/admin-panel/animal-list/edit/'.$animal->id) }}"><button class="btn btn-info">Edytuj</button></a></td>
                            <td><a href="{{ url('/animal-panel/delete/'.$animal->id) }}"><button class="btn btn-danger">Usuń</button></a></td>
                    </tr>
                @endforeach
                </table>
        </div>
    </div>
</div>
@endsection
