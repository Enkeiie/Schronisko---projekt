@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <a href="{{ url('/admin-panel/animal-list') }}"><button class="btn btn-danger">Powróć</button></a>
                <div class="card-body">
                    <h1>Dane Zwierzaka</h1>
                    <div class="l-side-profile">
                        <p><img style="width: 150px; height: 150px" src="{{ asset('images').'\a'.$animal->id.'.png' }}"></p>
                    </div>
                    <div class="r-side-profile">
                        <p>Imię: {{ $animal->name }}</p>
                        @foreach ($races as $race)
                        @foreach ($species as $specie)
                        @if($race->species==$specie->id && $race->id==$animal->race)
                            <p>Rasa: {{ $specie->name.' '.$race->name }}</p>
                        @endif
                        @endforeach
                        @endforeach
                        <p>Wiek: {{ $animal->age }}</p>
                        <p>Płeć: {{ $animal->gender }}</p>
                    </div>
                    @if($animal->shelter==Auth::user()->shelter || Auth::user()->id==$animal->user || Auth::user()->role==1)
                        <a href="{{ url('/admin-panel/animal-list/edit/'.$animal->id) }}"><button class="btn btn-danger">Edytuj</button></a>
                    @endif
                    <hr>
                    <div class="l-side-profile">
                        <h1>Kontakt do znaleźcy</h1>
                        @if($animal->shelter!=null)
                        <a href="{{ url('/shelter/'.$shelter->id) }}">Profil Schroniska</a>
                        <p>Email: {{ $shelter->mail }}</p>
                        <p>Telefon: {{ $shelter->phone }}</p>
                        @else
                        <p>Email: {{ $user->email }}</p>
                        @endif
                        @if($animal->shelter==Auth::user()->shelter || Auth::user()->id==$animal->user || Auth::user()->role==1)
                            <h2>Dodaj cechę</h2>
                            <form method="post" action="{{ url('/animal-panel/animalinfo/add') }}">
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
                                <input type="hidden" name="id" value="{{ $animal->id }}">
                                <p>Nazwa<p>
                                <input type="text" class="input-text" name="name">
                                <p>Wartość<p>
                                <input type="text" class="input-text" name="value">
                                <input type="submit" value="Dodaj cechę">
                            </form>
                            <hr>
                        @endif
                        <h1>Cechy szczególne</h1>
                        @foreach($animaldetails as $animaldetail)
                        @foreach ($attributes as $attribute)
                            @if($animaldetail->attribute==$attribute->id)
                                <p>{{ $attribute->name.' : '.$attribute->value}}
                                    @if($animal->shelter==Auth::user()->shelter || Auth::user()->id==$animal->user || Auth::user()->role==1)
                                    <a href="{{ url('/animal-panel/animalinfo/delete/'.$animaldetail->id) }}">
                                    <button class="">Usuń</button></a>
                                    @endif
                                </p>
                            @endif
                        @endforeach
                        @endforeach
                    </div>
                    <div class="r-side-profile">
                        <h1>Karta zdrowia</h1>
                        @if($animal->shelter==Auth::user()->shelter || Auth::user()->id==$animal->user || Auth::user()->role==1)
                            <h2>Dodaj zabieg</h2>
                            <form method="post" action="{{ url('/animal-panel/healthcard/add') }}">
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
                                <p>Wydanie<p>
                                <input type="hidden" name="id" value="{{ $animal->id }}">
                                <input type="date" name="start">
                                <p>Wygaśnięcie<p>
                                <input type="date" name="expiration">
                                <p>Operacja<p>
                                <input type="text" class="input-text" name="name">
                                <input type="submit" value="Dodaj zabieg">
                            </form>
                            <hr>
                        @endif
                        @foreach($healthcards as $healthcard)
                            @foreach ($assesments as $assesment)
                                @if($healthcard->assesment==$assesment->id)
                                    <p>{{ $assesment->start.'-'.$assesment->expiration.' : '.$assesment->name }}
                                        @if($animal->shelter==Auth::user()->shelter || Auth::user()->id==$animal->user || Auth::user()->role==1)
                                        <a href="{{ url('/animal-panel/healthcard/delete/'.$healthcard->id) }}">
                                        <button class="">Usuń</button></a>
                                        @endif
                                    </p>
                                @endif
                            @endforeach
                        @endforeach
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection
