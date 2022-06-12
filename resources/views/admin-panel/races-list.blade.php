@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
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
            <h1>Lista ras:</h1>
            <table class="table table-striped">
                <tr style="text-align: center;" class="table table-dark">
                    <th>Id</th>
                    <th>Nazwa</th>
                    <th></th>
                    <th></th>
                </tr>
            @foreach ($species as $specie)
                <tr>
                    <td>{{ $specie->id }}</td>
                    <td>{{ $specie->name }}</td>
                    <td><a href="{{ url('/admin-panel/races-list/edit-specie/'.$specie->id) }}"><button class="btn btn-info">Edytuj</button></a></td>
                    <td><a href="{{ url('/admin-panel/races-list/delete-specie/'.$specie->id) }}"><button class="btn btn-danger">Usuń</button></a></td>
                </tr>
            @endforeach
            </table>
            <hr>
            <h1>Dodaj rasę:</h1>
            <form class="form" method="POST" action="{{ url('admin-panel/races-list/specie/create') }}">
                @csrf
                <label for="name">Nazwa</label>
                <input type="text" name="name" placeholder="nazwa">
                <input type="submit" class="btn btn-info" value="Utwórz">
            </form>
            <hr>
            <h1>Dodaj gatunek:</h1>
            <form class="form" method="POST" action="{{ url('admin-panel/races-list/race/create') }}">
                @csrf
                <label for="species">Rasa:</label>
                <select name="species">
                    @foreach ($species as $specie)
                        <option value="{{ $specie->id }}">{{ $specie->name }}</option>
                    @endforeach
                </select>
                <label for="name">Nazwa:</label>
                <input type="text" name="name" placeholder="nazwa">
                <input type="submit" class="btn btn-info" value="Utwórz">
            </form>
            <hr>
            <h1>Lista ras:</h1>
                <table class="table table-striped">
                    <tr style="text-align: center;" class="table table-dark">
                        <th>Id</th>
                        <th>Rasa</th>
                        <th>Gatunek</th>
                        <th></th>
                        <th></th>
                    </tr>
                @foreach ($races as $race)
                    <tr>
                        <td>{{ $race->id }}</td>
                        @foreach ($species as $specie)
                            @if($race->species == $specie->id)
                                <td>{{ $specie->name }}</td>
                        @endif
                        @endforeach
                        <td>{{ $race->name }}</td>
                        <td><a href="{{ url('/admin-panel/races-list/edit-race/'.$race->id) }}"><button class="btn btn-info">Edytuj</button></a></td>
                        <td><a href="{{ url('/admin-panel/races-list/delete-race/'.$race->id) }}"><button class="btn btn-danger">Usuń</button></a></td>
                    </tr>
                @endforeach
                </table>
        </div>
    </div>
    </div>
</div>
@endsection
