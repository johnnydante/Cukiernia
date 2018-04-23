@extends('layout')

@section('content')

<style>
    .card-img-top{
        filter: brightness(90%);
    }

    .card-img-top:hover{
        filter: brightness(100%);
    }

</style>
<div class="container" style="margin-top: 30px;">


    <div class="row" style="margin-right: auto; margin-left: auto;">

        <div class="col-lg-4 col-md-3 col-sm-6 portfolio-item">
            <div class="card h-100" style="background: none; border: none;">

                <a href="{{route('torty.index')}}">

                    <img class="card-img-top" style="border-radius: 30px; border: solid 1px; border-color: rgba(47,23,15,.9); box-shadow: 5px 5px 10px darkgray;" src='{{url("/temp/img/produkty/obraz-1.jpg")}}' alt=""></a>

                <div class="intro-button mx-auto" style="margin-top: 1px;">
                    <a class="btn btn-primary btn-x2" style="color: rgba(47,23,15,.9);" href="{{route('torty.index')}}">Torty</a>
                </div>


            </div>
        </div>

        <div class="col-lg-4 col-md-3 col-sm-6 portfolio-item">
            <div class="card h-100" style="background: none; border: none;">

                <a href="{{route('products.index')}}">

                    <img class="card-img-top" style="border-radius: 30px; border: solid 1px; border-color: black; box-shadow: 5px 5px 10px grey;" src='{{url("/temp/img/produkty/obraz-2.jpg")}}' alt="" ></a>

                    <div class="intro-button mx-auto" style="margin-top: 1px;">
                        <a class="btn btn-primary btn-x2" style="color: rgba(47,23,15,.9);" href="{{route('products.index')}}">Ciasta</a>
                    </div>


            </div>
        </div>

        <div class="col-lg-4 col-md-3 col-sm-6 portfolio-item">
            <div class="card h-100" style="background: none; border: none;">

                <a href="{{route('ciasteczka.index')}}">

                    <img class="card-img-top" style="border-radius: 30px; border: solid 1px; border-color: black; box-shadow: 5px 5px 10px grey;" src='{{url("/temp/img/produkty/obraz-3.jpg")}}' alt=""></a>

                <div class="intro-button mx-auto" style="margin-top: 1px;">
                    <a class="btn btn-primary btn-x2" style="color: rgba(47,23,15,.9);" href="{{route('ciasteczka.index')}}">Ciasteczka</a>
                </div>


            </div>
        </div>



    </div>


</div>

@endsection