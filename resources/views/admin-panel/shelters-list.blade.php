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
            <h1>Lista Schronisk:</h1>
            <a href="{{ url('/admin-panel/shelters-list/create') }}"><button class="btn btn-warning">Dodaj</button></a>
            <table class="table table-striped">
                <tr style="text-align: center;" class="table table-dark">
                    <th>Id</th>
                    <th>Nazwa schroniska</th>
                    <th>Telefon</th>
                    <th>NIP</th>
                    <th>Email</th>
                    <th>Kraj</th>
                    <th>Województwo</th>
                    <th>Miasto</th>
                    <th>Ulica</th>
                    <th>Kod pocztowy</th>
                    <th></th>
                    <th></th>
                </tr>
                @foreach ($shelters as $shelter)
                    <tr>
                        <td>{{ $shelter->id }}</td>
                        <td>{{ $shelter->name }}</td>
                        <td>{{ $shelter->phone }}</td>
                        <td>{{ $shelter->NIP }}</td>
                        <td>{{ $shelter->mail }}</td>
                        @foreach ($addresses as $address)
                            @if($shelter->address == $address->id)
                                <td>{{ $address->country }}</td>
                                <td>{{ $address->region }}</td>
                                <td>{{ $address->city }}</td>
                                <td>{{ $address->street.'/'.$address->local }}</td>
                                <td>{{ $address->postal }}</td>
                        @endif
                        @endforeach
                        <td><a href="{{ url('/admin-panel/shelters-list/edit/'.$shelter->id) }}"><button class="btn btn-info">Edytuj</button></a></td>
                        <td><a href="{{ url('/admin-panel/shelters-list/delete/'.$shelter->id) }}"><button class="btn btn-danger">Usuń</button></a></td>
                    </tr>
                @endforeach
                </table>
        </div>
    </div>
</div>
@endsection
