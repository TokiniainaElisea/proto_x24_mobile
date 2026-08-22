@extends('layout')
@section('content')
    <div class="container-fluid">
        @if (session('success'))
            <div class="card-body bg-success text-light">
                {{session('success')}}
            </div>
        @endif
        @include('products.options', ['categories' => $categories])
        @include('products.category', ['categories' => $categories])
        @include('products.listes', ['products' => $products])
    </div>
@endsection