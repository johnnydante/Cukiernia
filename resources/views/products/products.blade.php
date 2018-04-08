@extends('layout')

@section('content')



<div class="container" style="margin-top: 30px;">


    <div class="row">

        @foreach($products as $product)
        <div class="col-lg-3 col-md-4 col-sm-6 portfolio-item" >
            <div class="card h-100" style="background: none; border: none;">
                <span class="border border-warning rounded">
                <a href="{{route('product.index',['id'=>$product->id])}}">

                    <img class="card-img-top" src='{{url("/storage/products_img/".$product->filename)}}' alt=""></a>
                    </span>
                    <div class="intro-button mx-auto" style="margin-top: 1px;">
                        <a class="btn btn-primary btn-x2" style="color: rgba(47,23,15,.9);" href="{{route('product.index',['id'=>$product->id])}}">{{ $product->nazwa }}</a>
                    </div>
                @auth()
                    @if (Auth::user()->isAdmin())
                <div class="intro-button mx-auto" style="margin-top: 1px;">
                    <a class="btn btn-info btn-x2" href="{{route('product.edit',['id'=>$product->id])}}">Edytuj</a>
                    <a class="btn btn-danger btn-x2" href="{{route('product.delete',['id'=>$product->id])}}">Usuń</a>
                </div>
                    @endif
                @endauth
            </div>
        </div>
        @endforeach
    </div>

    <div class="row">
        @auth()
            @if (Auth::user()->isAdmin())

                        <div class="intro-button mx-auto" style="margin-bottom: 13px;">
                            <a class="btn btn-success btn-x2" href="{{route('product.create')}}">Dodaj produkt</a>
                        </div>

            @endif
        @endauth
    </div>
    {{$products->links()}}
</div>

@endsection