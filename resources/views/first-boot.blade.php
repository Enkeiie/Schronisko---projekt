@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form class="form form-control " style="background-color: white;" method="post" action="{{url('/first-boot/add')}}">
                    @csrf
                    <table>
                    <tr>
                        <td>
                            <label for="country">Kraj</label></td><td>
                            <input  class="form-text" style="width: 300px;" style="width: 300px;" type="text" name="country" id="country"></input>
                        </td>
                    </tr>
                        <tr>
                            <td>
                            <label for="region">Region</label></td><td>
                            <input class="form-text" style="width: 300px;" type="text" name="region" id="region" ></input>
                        </td>
                        </tr>
                        <tr>
                            <td>
                            <label for="city">Miasto</label></td><td>
                            <input class="form-text" style="width: 300px;" type="text" name="city" id="city" ></input>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="street">Ulica</label></td><td>
                                <input class="form-text" style="width: 300px;" type="text" name="street" id="street"></input>
                            </td>
                        </tr>
                        <tr>
                            <td>
                            <label for="local">Numer lokalu</label></td><td>
                            <input class="form-text" style="width: 300px;" type="text" name="local" id="local"></input>
                            </td>
                        </tr>
                        <tr>
                            <td>
                            <label for="postal">Kod pocztowy</label></td><td>
                            <input class="form-text" style="width: 300px;" type="text" name="postal" id="postal"></input>
                            </td>
                        </tr>
                    </table>
                    <center><input type="submit"  class="btn btn-primary" value="Zatwierdź zmiany"></center>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
