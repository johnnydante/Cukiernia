@extends('layout')

@section('content')




    <section class="page-section">
        <div class="container">
            <div class="product-item">
                <div class="product-item-title d-flex">
                    <div class="bg-faded p-5 d-flex mr-auto rounded">
                        <h2 class="section-heading mb-0">
                            <span class="section-heading-upper">Cena: {{ $products->cena }} zł</span>
                            <span class="section-heading-lower">{{ $products->nazwa }}</span>
                        </h2>
                    </div>
                </div>
                <img class="product-item-img mx-auto d-flex rounded img-fluid mb-3 mb-lg-0" src="{{url("/storage/products_img/".$products->filename)}}" alt="">
                <div class="product-item-description d-flex ml-auto">
                    <div class="bg-faded p-5 rounded">
                        <p class="mb-0">{{ $products->description }}</p><br>
                        <div class="intro-button mx-auto">
                            <a class="btn btn-primary btn-x2" href="{{route('products.index')}}">Powrót</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>



@endsection