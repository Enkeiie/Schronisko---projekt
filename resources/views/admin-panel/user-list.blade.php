@extends('layouts.app')

@section('content')
<div class="container">
    <a href="{{ url('/admin-panel') }}"><button class="btn btn-danger">Powróć</button></a>
    <div class="row justify-content-center">
                <table class="table table-striped">
                    <tr style="text-align: center;" class="table table-dark">
                        <th>Id</th>
                        <th>Nazwa</th>
                        <th>Email</th>
                        <th>Hasło</th>
                        <th>Adres</th>
                        <th>Schronisko</th>
                        <th>Rola</th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->password }}</td>
                        <td>{{ $user->address }}</td>
                        <td>{{ $user->shelter }}</td>
                        <td>{{ $user->role }}</td>
                        <td><a href="{{ url('/admin-panel/user-list/edit/'.$user->id) }}"><button class="btn btn-info">Edytuj</button></a></td>
                        <td><a href="{{ url('/admin-panel/user-list/delete/'.$user->id) }}"><button class="btn btn-danger">Usuń</button></a></td>
                        @if($user->role==0)
                            <td><a href="{{ url('/admin-panel/user-list/change-permission/'.$user->id.'/1') }}">
                                <button style="width: 400px;" class="btn btn-success">
                                    Nadaj uprawienia administratora
                                </button></a></td>
                        @else
                            <td><a href="{{ url('/admin-panel/user-list/change-permission/'.$user->id.'/0') }}">
                                <button style="width: 400px;" class="btn btn-danger">
                                    Zabierz uprawienia administratora
                                </button></a></td>
                        @endif
                    </tr>
                @endforeach
                </table>
    </div>
</div>
@endsection
