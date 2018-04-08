@extends('layout')

@section('content')

    <section class="page-section cta">
        <div class="container">
            <div class="row">
                <div class="col-xl-9 mx-auto">
                    <div class="cta-inner rounded">
                        <h2 class="section-heading mb-5">
                            <span class="section-heading-upper">Zamów {{ $products->nazwa }}</span>
                            <span class="section-heading-lower"></span>
                        </h2>
                        <div class="row">
                            <div class="col-lg-3 col-md-4 col-sm-6 portfolio-item">
                                <div class="card h-100" style="background-color: lightgrey;">
                                    <img class="card-img-top" src='{{url("/storage/products_img/".$products->filename)}}' alt="">
                                </div>
                            </div>
                            @if($wybik = count($_POST['tablica_terminow'])>0)
                                Z powodu zbyt dużej ilości zamówień, niektóre terminy są już niedostępne:<br>
                                @foreach($_POST['tablica_terminow'] as $termin)
                                   {{$termin}},
                                @endforeach
                                <br>Przepraszamy i prosimy o składanie zamówień na wolne dni, dziękujemy!
                            @endif
                            </div>
                        <div class="row">
                            <div class="container" style="max-width: 700px; color: orange; z-index: 1;">
                                {!! Form::open(['route' => ['order.store', $products->id], 'method' => 'POST']) !!}

                                @if($errors->any())
                                    @foreach ($errors->all() as $error)
                                        <div class="btn btn-danger">{{ $error }}</div>
                                    @endforeach
                                @endif

                                <div class="form-group">
                                    {!! Form::label('termin', "Termin:") !!}
                                    {!! Form::text('termin', '', ['class' => 'datepicker', 'id' => 'datepicker']) !!}
                                </div>

                                <div class="form-group">
                                    {!! Form::label('wielkosc', "Wielkość brytfanki:") !!}
                                    {!! Form::select('wielkosc', ['24x37cm', '17x24cm']) !!}
                                </div>

                                <div class="form-group">
                                    {!! Form::label('ilosc', "Ilość brytfanek:") !!}
                                    {!! Form::number('ilosc', null, ['class' => 'form-control']) !!}
                                </div>

                                <div class="form-group">
                                    {!! Form::label('info', "Dodatkowe informacje:") !!}
                                    {!! Form::textarea('info', null, ['class' => 'form-control']) !!}
                                </div>

                                <div class="form-group">
                                    {!! Form::submit('Dodaj do koszyka', ['class' => 'btn btn-success']) !!}
                                    {!! link_to(URL::previous(),'Powrót', ['class' => 'btn btn-primary']) !!}
                                </div>

                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection