@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="card">
            <table class="table table-striped">
                <tr style="text-align: center;" class="table table-dark">
                    <th>Zdjęcie</th>
                    <th>Imię</th>
                    <th>Wiek</th>
                    <th>Płeć</th>
                    <th>Rasa</th>
                    <th>Zgłaszający</th>
                    <th>Adres</th>
                </tr>
                @foreach ($animals as $animal)
                    <tr onclick="window.location.href='{{ url('/animal-panel/animal/'.$animal->id) }}';" >
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
                        @if($animal->shelter!=null)
                            @foreach ($shelters as $shelter)
                                @if($shelter->id==$animal->shelter)
                                    <td>{{$shelter->name}}</td>
                                        @foreach ($addresses as $address)
                                            @if($shelter->address == $address->id)
                                                <td>{{ $address->country.' '.$address->region.' '.$address->city.' '.$address->street.'/'.$address->local.' '.$address->postal}}</td>
                                            @endif
                                        @endforeach
                                @endif
                            @endforeach
                        @else
                        @foreach ($users as $user)
                        @if($user->id==$animal->user)
                            <td>{{ $user->name }}</td>
                                @foreach ($addresses as $address)
                                    @if($user->address == $address->id)
                                        <td>{{ $address->country.' '.$address->region.' '.$address->city.' '.$address->street.'/'.$address->local.' '.$address->postal}}</td>
                                    @endif
                                @endforeach
                        @endif
                        @endforeach
                        @endif
                    </tr>
                @endforeach
                </table>
        </div>
    </div>
</div>
@endsection
