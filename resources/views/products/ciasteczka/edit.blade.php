@extends('layout')

@section('content')

    <section class="page-section cta">
        <div class="container">
            <div class="row">
                <div class="col-xl-9 mx-auto">
                    <div class="cta-inner rounded">
                        <h2 class="section-heading mb-5">
                            <span class="section-heading-upper" style="margin-bottom: 30px;">Edytuj produkt - ciasteczka</span>
                        </h2>
                        <div class="container" style="position: relative; max-width: 700px; z-index: 25;">
                            {!! Form::model($products, ['route' => ['ciasteczko.update', $products->id], 'method' => 'POST']) !!}

                            @if($errors->any())
                                @foreach ($errors->all() as $error)
                                    <div class="btn btn-danger">{{ $error }}</div>
                                @endforeach
                            @endif

                            <div class="form-group">
                                {!! Form::label('nazwa', "Nazwa produktu:") !!}
                                {!! Form::text('nazwa', $products->nazwa, ['class' => 'form-control']) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('cena', "Cena za paczkę 30 szt.:") !!}
                                {!! Form::number('cena', $products->cena, ['class' => 'form-control']) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('cena_mala', "Cena za paczkę 15 szt.:") !!}
                                {!! Form::number('cena_mala', $products->cena_mala, ['class' => 'form-control']) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('description', "Opis:") !!}
                                {!! Form::textarea('description', $products->description, ['class' => 'form-control']) !!}
                            </div>


                                <span style=" color: black;">
                                    Jeżeli nie chcesz zmieniać zdjęcia, to nie musisz dodawać żadnego nowego.</span><br><br>

                                <div class="col-lg-4 col-md-3 col-sm-6 portfolio-item">
                                    <div class="card h-100">
                                        Aktualne zdjęcie:
                                        <img class="card-img-top" src='{{url("/storage/products_img/".$products->filename)}}' alt="">
                                    </div>
                                    <div class="intro-button mx-auto" style="margin-top: 5px;">
                                        <a class="btn btn-danger btn-x2" href="{{route('tort_zdjecie.delete', ['id' => $products->id])}}">Usuń zdjęcie</a>
                                    </div>
                                </div>


                            <div class="form-group">
                                {!! Form::label('filename', "Zdjęcie:") !!}
                                {!! Form::file('filename', null, ['class' => 'form-control']) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::submit('Zapisz', ['class' => 'btn btn-success']) !!}
                                {!! link_to(URL::previous(),'Powrót', ['class' => 'btn btn-primary']) !!}
                            </div>

                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection