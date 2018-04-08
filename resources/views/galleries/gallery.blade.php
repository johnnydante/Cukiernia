@extends('layout')

@section('content')



    <div class="container" style="margin-top: 30px;">

        <div class="row">

            @foreach($photos as $photo)
                <div class="col-lg-3 col-md-4 col-sm-6 portfolio-item">

                    <div class="card h-100" style="background: none; border: none;">
                        <span class="border border-warning rounded">
                            <img class="card-img-top" src='{{url("/storage/gallery/".$photo->filename)}}' alt="">
                            </span>
                        @auth()
                            @if (Auth::user()->isAdmin())
                            <div class="intro-button mx-auto" style="margin-top: 1px;">
                                <a class="btn btn-danger btn-x2" href="{{route('gallery.delete',['id'=>$photo->id])}}">Usuń</a>
                            </div>
                                @endif
                        @endauth
                    </div>

                </div>
            @endforeach
        </div>
        <div class="row">
            @auth
                @if (Auth::user()->isAdmin())
                    <div class="col-lg-3 col-md-4 col-sm-6 portfolio-item">
                        <div class="intro-button mx-auto" >
                            <a class="btn btn-success btn-x2" href="{{route('gallery.create')}}">Dodaj zdjęie</a>
                        </div>
                    </div>
                @endif
            @endauth
        <div style="margin-left: auto; margin-right: auto;">{{$photos->links()}}</div>
    </div>


@endsection