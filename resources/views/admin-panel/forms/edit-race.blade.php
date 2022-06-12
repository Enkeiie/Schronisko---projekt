@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <a href="{{ url('/admin-panel/races-list') }}"><button class="btn btn-danger">Powróć</button></a>
                <form class="form form-control" method="POST" action="{{ url('admin-panel/races-list/edit-race/'.$race->id.'/apply') }}">
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
                    <input type="hidden" name="id" value="{{ $race->id }}">
                    <p>Rasa:</p>
                    <select name="species">
                        @foreach ($species as $specie)
                            @if($specie->id==$race->species)
                                <option value="{{ $specie->id }}" selected>{{ $specie->name }}</option>
                            @else
                                <option value="{{ $specie->id }}">{{ $specie->name }}</option>
                            @endif
                        @endforeach
                    </select>
                    <p>Gatunek:</p>
                    <input type="text" name="name" value="{{$race->name}}">
                    <input class="btn btn-info"  type="submit" value="Zmień dane">
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
