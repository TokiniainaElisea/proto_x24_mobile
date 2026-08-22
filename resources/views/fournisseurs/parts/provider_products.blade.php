@extends('layout')

@section('content')
    <div class="container p-2">
        <a href="{{route('provider')}}" class="btn btn-warning"> <i class="bi bi-arrow-left"> </i> Retour </a>
        <h2 class="fw-bold h2 mb-2"> Liste des produits de : {{$provider.name_provider}} </h2>
    </div>
@endsection