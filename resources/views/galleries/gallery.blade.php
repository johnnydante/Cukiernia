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

        <div class="row">
            @foreach($photos as $photo)
                <div class="col-lg-3 col-md-4 col-sm-6 portfolio-item" >

                    <div class="card h-100" style="background: none; border: none; position: relative; ">
                        <div class="numer" style="z-index: 10; min-width: 36px; background-color: rgba(47,23,15,.9); color: darkgray; padding: 5px; position: absolute; right: 4px; bottom: 4px;  border-radius: 18px; text-align: center;"><b>{{$_POST['i']++}}</b></div>
                           <a href="{{route('gallery.show', ['id' => $photo->id, 'numer'=>$_POST['i']])}}">
                               <img class="card-img-top" style="border-radius: 25px; box-shadow: 4px 4px 10px grey;"
                                    src='{{url("/storage/gallery/new/".$photo->filename)}}' alt="" >
                           </a>

                        @auth()
                            @if (Auth::user()->isAdmin())
                            <div class="intro-button mx-auto" style="margin-top: 1px;">
                                <a onclick="return confirm('Czy na pewno chcesz usunąć to zdjęcie?')" class="btn btn-danger btn-x2"
                                   href="{{route('gallery.delete',['id'=>$photo->id])}}">
                                        Usuń
                                </a>
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

        </div>
        <div style="text-align: center;">{{$photos->links()}}</div>
    </div>


@endsection