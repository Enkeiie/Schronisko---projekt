@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Panel administratora') }}</div>
                <div class="card-body">
                    <ul>
                        <a href='{{ url('/admin-panel/user-list') }}'><li>Lista użytkowników</li></a>
                        <a href='{{ url('/admin-panel/address-list') }}'><li>Lista adresów</li></a>
                        <a href='{{ url('/admin-panel/races-list') }}'><li>Lista ras</li></a>
                        <a href='{{ url('/admin-panel/shelters-list') }}'><li>Lista schronisk</li></a>
                        <a href='{{ url('/admin-panel/animal-list') }}'><li>Lista zwierzaków</li></a>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
