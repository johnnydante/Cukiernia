@extends('layout')

@section('content')

    <style>
        .card-img-top{
            filter: brightness(100%);
        }

        .card-img-top:hover{
            filter: brightness(115%);
        }

    </style>

<div class="container" style="margin-top: 30px;">

    <h1 class="site-heading text-center text-white d-none d-lg-block">
        <span class="site-heading-lower text-primary"><b>Inne</b></span>
    </h1>

    <div class="row" style="margin-top: 30px;">

        @foreach($inne as $jedno)
        <div class="col-lg-3 col-md-4 col-sm-6 portfolio-item" >
            <div class="card h-100" style="background: none; border: none;">

                <a href="{{route('inne_jedno.index',['id'=>$jedno->id])}}">

                    <img class="card-img-top" style="border-radius: 25px; box-shadow: 3px 3px 7px darkgray; border: solid 1px; border-color: rgba(47,23,15,.9);;" src='{{url("/storage/products_img/".$jedno->filename)}}' alt=""></a>

                    <div class="intro-button mx-auto" style="margin-top: 1px;">
                        <a class="btn btn-primary btn-x2" style="color: rgba(47,23,15,.9);" href="{{route('inne_jedno.index',['id'=>$jedno->id])}}">{{ $jedno->nazwa }}</a>
                    </div>
                @auth()
                    @if (Auth::user()->isAdmin())
                <div class="intro-button mx-auto" style="margin-top: 1px;">
                    <a class="btn btn-info btn-x2" href="{{route('inne_jedno.edit',['id'=>$jedno->id])}}">Edytuj</a>
                    <a onclick="return confirm('Czy na pewno chcesz usunąć ten produkt?')" class="btn btn-danger btn-x2" href="{{route('inne_jedno.delete',['id'=>$jedno->id])}}">Usuń</a>
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
                            <a class="btn btn-success btn-x2" href="{{route('inne_jedno.create')}}">Dodaj produkt</a>
                        </div>

            @endif
        @endauth
                <div class="intro-button mx-auto" style="margin-bottom: 13px;">
                    <a class="btn btn-primary btn-x2" href="{{route('productsGlowna.index')}}">Powrót</a>
                </div>

    </div>
    {{$inne->links()}}
</div>

@endsection