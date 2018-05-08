@extends('layout')

@section('content')
    <style>
        .img-fluid {
            border-radius: 50px!important;

        }
        .bg-faded {
            border-radius: 20px!important;
        }
        .clearfix {
            margin-top: 0;
            margin-bottom: 20px;
        }
        .about-heading {
            margin-bottom: 20px;
        }
        .napis {
            border-bottom: solid 1px;
            padding-bottom: 15px;
        }

    </style>

    <section class="page-section about-heading">
        <div class="container">

            <div class="about-heading-content">
                <div class="row">
                    <div class="col-xl-9 col-lg-10 mx-auto">
                        <div class="bg-faded text-center rounded p-4" style="margin-top: 20px;">
                            <h2 class="section-heading mb-4">
                                <span class="section-heading-low">Zamówienie weselne</span>

                            </h2>
                            <p>Nie musisz się zapoznawać z żadną ofertą, wszystko wybierasz sam. Dzięki naszemu kreatorowi zamówień weselnych, możesz ustalić wszystkie szczegóły zanim się z Tobą skontaktujemy.</p>
                            <p>Sam decydujesz co chcesz: Tort, ciasta, paczki - w dowolnej kompozycji!</p>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="container" style="max-width: 1000px;">
    {!! Form::open(['route' => 'wesele.show', 'method' => 'GET']) !!}
    <section class="page-section clearfix" >
        <div class="container">
            <div class="intro">
                <img class="intro-img img-fluid mb-2 mb-lg-0 rounded" src="{{"/temp/img/tort.jpg"}}" alt="">
                <div class="intro-text left-0 text-center bg-faded p-4 rounded">
                    <h2 class="section-heading mb-4">
                        <span class="section-heading-upper">Tort weselny</span>
                    </h2>
                    <p class="mb-3 napis">Wesele to wyjątkowy i magiczny moment. Wierzymy, że tort weselny musi być nieodłącznym elementem całej weselnej magii! Kliknij dodaj poniżej, a następnie przejdź dalej, aby samemu zdecydować o szczegółach dotyczących tortu na Twoje wesele.
                    </p>
                    <div class="form-group">
                        {!! Form::label('tort', "Dodaj") !!}
                        {!! Form::checkbox('tort', null, ['class' => 'form-control']) !!}
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="page-section clearfix">
        <div class="container">
            <div class="intro">
                <img class="intro-img img-fluid mb-2 mb-lg-0 rounded" src="{{"/temp/img/ciasta-sala.jpg"}}" alt="">
                <div class="intro-text ciasta left-0 text-center bg-faded p-4 rounded">
                    <h2 class="section-heading mb-4">
                        <span class="section-heading-upper">Ciasta i ciasteczka na salę</span>
                    </h2>
                    <p class="mb-3 napis">Czymże byłoby wesele bez przepysznych ciast, babeczek i innych słodkości, które szczególnie podkreślają aurę miłości unoszącej się na sali weselnej? Kliknij dodaj poniżej, a następnie przejdź dalej, aby samemu zdecydować o szczegółach dotyczących ciast i ciasteczek na salę.
                    </p>
                    <div class="form-group">
                    {!! Form::label('ciasta', "Dodaj") !!}
                    {!! Form::checkbox('ciasta', null, ['class' => 'form-control']) !!}
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="page-section clearfix">
        <div class="container">
            <div class="intro">
                <img class="intro-img img-fluid mb-2 mb-lg-0 rounded" src="{{"/temp/img/paczka.jpg"}}" alt="">
                <div class="intro-text left-0 text-center bg-faded p-4 rounded">
                    <h2 class="section-heading mb-4">
                        <span class="section-heading-upper">Paczki dla gości</span>
                    </h2>
                    <p class="mb-3 napis">Najważniejsi na każdym weselu są oczywiście goście! To dla nich Młoda Para szykuje całe uroczyste przyjęcie, dlatego paczki dla gości również muszą być wyjątkowe! Kliknij dodaj poniżej, a następnie przejdź dalej, aby samemu zdecydować o szczegółach dotyczących paczek dla gości.
                    </p>
                    <div class="form-group">
                    {!! Form::label('paczki', "Dodaj") !!}
                    {!! Form::checkbox('paczki', null, ['class' => 'form-control']) !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="form-group" style="text-align: center;">
        {!! Form::submit('Przejdź dalej', ['class' => 'btn btn-primary', 'style' => 'color: rgba(47,23,15,.9)']) !!}
    </div>

    {!! Form::close() !!}
    </div>
@endsection