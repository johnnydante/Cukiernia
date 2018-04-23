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

    <h1 class="site-heading text-center text-white d-none d-lg-block">
        <span class="site-heading-lower text-primary"><b>Torty</b></span>
    </h1>
    <div class="row" style="margin-right: auto; margin-left: auto;">


        @foreach($torts as $tort)
            <div class="col-lg-3 col-md-4 col-sm-6 portfolio-item" >
                <div class="card h-100" style="background: none; border: none;">

                    <a href="{{route('tort.show',['id'=>$tort->id])}}">

                        <img class="card-img-top" style="border: solid 1px; border-color: rgba(47,23,15,.9); border-radius: 15px; box-shadow: 3px 3px 7px darkgray;" src='{{url("/storage/products_img/".$tort->filename)}}' alt=""></a>

                    <div class="intro-button mx-auto" style="margin-top: 1px;">
                        <a class="btn btn-primary btn-x2" style="color: rgba(47,23,15,.9);" href="{{route('tort.show',['id'=>$tort->id])}}">{{ $tort->nazwa }}</a>
                    </div>
                    @auth()
                    @if (Auth::user()->isAdmin())
                        <div class="intro-button mx-auto" style="margin-top: 1px;">
                            <a class="btn btn-info btn-x2" href="{{route('torty.edit',['id'=>$tort->id])}}">Edytuj</a>
                            <a onclick="return confirm('Czy na pewno chcesz usunąć tę kategorię?')" class="btn btn-danger btn-x2" href="{{route('tort.usun',['id'=>$tort->id])}}">Usuń</a>
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
                <a class="btn btn-success btn-x2" href="{{route('tort.dodaj')}}">Dodaj kategorię</a>
            </div>

        @endif
        @endauth
        <div class="intro-button mx-auto" style="margin-bottom: 13px;">
            <a class="btn btn-primary btn-x2" href="{{route('productsGlowna.index')}}">Powrót</a>
        </div>

    </div>

</div>

@endsection