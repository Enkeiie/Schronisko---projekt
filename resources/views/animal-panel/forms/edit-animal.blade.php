@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <a href="{{ url('/admin-panel/animal-list') }}"><button class="btn btn-danger">Powróć</button></a>
                <form class="form form-control" method="POST" action="{{ url('animal-panel/edit/'.$animal->id.'/apply') }}" enctype="multipart/form-data">
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
                    <input type="hidden" value="{{ $animal->id }}" name="id">
                    <input type="file" name="image" placeholder="Choose image" id="image">
                    <p>Imię:</p>
                    <input class="input-text" type="text" name="name" value="{{ $animal->name }}">
                    <p>Gatunek:</p>
                    <select name="race">
                        @foreach ($races as $race)
                            @foreach ($species as $specie)
                                @if($race->species==$specie->id && $race->id==$animal->race)
                                    <option value="{{ $race->id }}" selected>{{ $specie->name.' '.$race->name }}</option>
                                @else
                                <option value="{{ $race->id }}">{{ $specie->name.' '.$race->name }}</option>
                                @endif
                            @endforeach
                        @endforeach
                    </select>
                    <p>Płeć:</p>
                    <select name="gender">
                        @if ($animal->gender=="Męska")
                            <option value="Męska" selected>Męska</option>
                        @else
                            <option value="Męska">Męska</option>
                        @endif
                        @if ($animal->gender=="Damska")
                            <option value="Damska" selected>Damska</option>
                        @else
                            <option value="Męska">Męska</option>
                        @endif
                    </select>
                    <p>Wiek:</p>
                    <input class="input-text" type="number" name="age" value="{{ $animal->age }}">
                    <input class="btn btn-info"  type="submit" value="Dodaj zwierzaka">
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
