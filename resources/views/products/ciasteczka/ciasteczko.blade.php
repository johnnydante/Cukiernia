@extends('layout')

@section('content')

    <style>
        .product-item-img {
            border-radius: 50px!important;
        }
        .bg-faded {
            border-radius: 30px!important;
        }

    </style>

    <section class="page-section">
        <div class="container">
            <div class="product-item">
                <div class="product-item-title d-flex">
                    <div class="bg-faded p-5 d-flex mr-auto rounded">
                        <h2 class="section-heading mb-0">
                            <span class="section-heading-upper">Cena:
                                @if(floor($products->cena/100)==0)
                                    {{ $products->cena-(floor($products->cena/100)*100) }} gr
                                @elseif($products->cena-(floor($products->cena/100)*100)==0)
                                    {{ floor($products->cena/100) }} zł
                                @else
                                    {{ floor($products->cena/100) }} zł {{ $products->cena-(floor($products->cena/100)*100) }} gr
                                @endif
                            </span>
                            <span class="section-heading-lower">{{ $products->nazwa }}</span>
                        </h2>
                    </div>
                </div>
                <img class="product-item-img mx-auto d-flex rounded img-fluid mb-3 mb-lg-0" src="{{url("/storage/products_img/".$products->filename)}}" alt="">
                <div class="product-item-description d-flex ml-auto">
                    <div class="bg-faded p-5 rounded">
                        <p class="mb-0">{{ $products->description }}</p><br>
                        <div class="intro-button mx-auto">
                            <a class="btn btn-success btn-x2" href="{{route('order.show', ['id'=>$products->id])}}">Przejdź do zamówienia!</a>
                        </div>

                        <div class="intro-button mx-auto" style="margin-top: 20px;">
                            <a class="btn btn-primary btn-x2" href="{{route('ciasteczka.index')}}">Powrót</a>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>

@endsection