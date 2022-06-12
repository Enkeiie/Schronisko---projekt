@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <a href="{{ url('/browser')}}"><img alt="TU DUŻY OBRAZEK Z PRZEJŚCIEM DO WYSZUKIWARKI" style="width: 2000px; height: 1000px; border: 2px solid black;"></a>
            <div class="card" style="display: flex; flex-direction: row;">
                <a href="{{ url('/article/1')}}"><img alt="TU MALY KWADRATOWY OBRAZEK Z PRZEJŚCIEM DO ARTYKULU" style="width: 500px; height: 500px; border: 2px solid black;"></a>
                <a href="{{ url('/article/2')}}"><img alt="TU MALY KWADRATOWY OBRAZEK Z PRZEJŚCIEM DO ARTYKULU" style="width: 500px; height: 500px; border: 2px solid black;"></a>
                <a href="{{ url('/article/3')}}"><img alt="TU MALY KWADRATOWY OBRAZEK Z PRZEJŚCIEM DO ARTYKULU" style="width: 500px; height: 500px; border: 2px solid black;"></a>
            </div>
            </div>
        </div>
    </div>
</div>
@endsection
