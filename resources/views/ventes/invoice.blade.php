@extends('layout')
@section('content')
    <div class="container">
        <div id="app">
            <invoice :sale='@json($sale)' :company='@json($company)'> </invoice>
        </div>
    </div>
@endsection
