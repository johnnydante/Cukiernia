@extends('layout')

@section('content')

    <style>
        .card-img-top{
            border-radius: 50px;
            box-shadow: 5px 5px 10px grey;
        }

        .card {
            margin-right: auto;
            margin-left: auto;
            background: none;
            border: none;
            position: relative;
            max-width: 800px;
        }
    </style>


    <div class="container" style="margin-bottom: 30px; margin-top: 30px; text-align: center;">

        <div class="card h-100">
            <div class="numer" style="z-index: 10; min-width: 72px; background-color: rgba(47,23,15,.9); color: darkgray; padding: 15px; position: absolute; right: 5px; bottom: 5px;  border-radius: 36px; text-align: center;"><h3><b>{{$number-1}}</b></h3></div>
            <img class="card-img-top"  src='{{url("/storage/gallery/new/".$jedno->filename)}}' alt="" >
        </div>

    </div>

        <div class="intro-button mx-auto" style="margin-bottom: 13px; text-align: center;">
           {{-- <a class="btn btn-outline-warning btn-x2" href="{{route('gallery.show', ['id' => $photo->id])}}">Poprzedni</a>--}}

            <a class="btn btn-primary btn-x2" href="{{ URL::previous() }}" style="color: rgba(47,23,15,.9);">Powrót</a>

           {{-- <a class="btn btn-outline-warning btn-x2" href="{{route('gallery.show', ['id' => $photo->id])}}">Następny</a>--}}
        </div>

@endsection