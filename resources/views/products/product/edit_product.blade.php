@extends('layout')
@section('title', 'Modifier un produit')

@section('content')
    <livewire:edit-product-page 
        :product="$product"
        :category="$category"
    /> </livewire>
@endsection
