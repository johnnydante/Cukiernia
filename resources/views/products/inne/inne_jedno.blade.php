@extends('layout')

@section('content')

    <style>
        .product-item-img {
            border-radius: 50px!important;
        }
        .bg-faded {
            border-radius: 20px!important;
        }

    </style>

    <section class="page-section">
        <div class="container">
            <div class="product-item">
                <div class="product-item-title d-flex">
                    <div class="bg-faded p-5 d-flex mr-auto rounded">
                        <h2 class="section-heading mb-0">
                            <span class="section-heading-upper">Cena: {{ $inne->cena }} zł </span>
                            <span class="section-heading-lower">{{ $inne->nazwa }}</span>
                        </h2>
                    </div>
                </div>
                <img class="product-item-img mx-auto d-flex rounded img-fluid mb-3 mb-lg-0" src="{{url("/storage/products_img/".$inne->filename)}}" alt="">
                <div class="product-item-description d-flex ml-auto">
                    <div class="bg-faded p-5 rounded">
                        <p class="mb-0">{{ $inne->description }}</p><br>
                        <div class="intro-button mx-auto">
                            <a class="btn btn-success btn-x2" href="{{route('order.show', ['id'=>$inne->id])}}">Zamów!</a>
                        </div>

                        <div class="intro-button mx-auto" style="margin-top: 20px;">
                            <a class="btn btn-primary btn-x2" href="{{route('inne.index')}}">Powrót</a>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>

@endsection