@extends('layout')
@section('content')
    <div class="container">
        @include('dashboard.daily')
        <br>
        @include('dashboard.monthly')
        <br>
        @include('dashboard.weekly')
    </div>
@endsection