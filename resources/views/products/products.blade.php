@extends('layout')

@section('content')



<div class="container" style="margin-top: 30px;">

    <div class="row">

        @foreach($products as $product)
        <div class="col-lg-3 col-md-4 col-sm-6 portfolio-item">
            <div class="card h-100">
                <a href="{{route('product.index',['id'=>$product->id])}}">
                    <img class="card-img-top" src='{{url("/storage/products_img/".$product->filename)}}' alt=""></a>
                    <div class="intro-button mx-auto" style="margin-top: 1px;">
                        <a class="btn btn-primary btn-x2" href="{{route('product.index',['id'=>$product->id])}}">{{ $product->nazwa }}</a>
                    </div>
                @auth()
                <div class="intro-button mx-auto" style="margin-top: 1px;">
                    <a class="btn btn-info btn-x2" href="{{route('product.edit',['id'=>$product->id])}}">Edytuj</a>
                    <a class="btn btn-danger btn-x2" href="{{route('product.delete',['id'=>$product->id])}}">Usuń</a>
                </div>
                @endauth
            </div>
        </div>
        @endforeach
        @auth()
        <div class="col-lg-3 col-md-4 col-sm-6 portfolio-item">
            <div class="card h-100" style="text-align: center;">
                <a href="{{route('product.create')}}" style="display: inline-block; ">
                    <div class="intro-button mx-auto" style="margin-top: 13px;">
                        <i class="fas fa-plus fa-10x"></i>
                    </div>
                </a>

                    <div class="intro-button mx-auto" style="margin-top: 13px;">
                        <a class="btn btn-success btn-x2" href="{{route('product.create')}}">Dodaj produkt</a>
                    </div>

            </div>
        </div>
        @endauth
    </div>

</div>

@endsection