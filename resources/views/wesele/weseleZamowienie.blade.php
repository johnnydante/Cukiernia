@extends('layout')

@section('content')

    <section class="page-section cta">
        <div class="container">

            <div class="row">
                <div class="col-xl-9 mx-auto">
                    <div class="cta-inner rounded" style="float: left;">
                        <h2 class="section-heading mb-5">
                            <span class="section-heading-upper">Zamówienie weselne</span>
                            <span class="section-heading-lower"></span>
                        </h2>
                        @if (session('status'))
                            <div class="alert alert-danger">
                                {{ session('status') }}
                            </div>
                        @endif


                        @if($wybik = count($_POST['tablica_terminow'])>0)
                            Z powodu zbyt dużej ilości zamówień, niektóre terminy są już niedostępne,
                            <br> poniżej formularza znajduje się się kalendarz terminów.
                            <br>Przepraszamy i prosimy o składanie zamówień na wolne dni, dziękujemy!
                        @endif
                        <div class="row">
                            <div class="container" style="max-width: 700px; color: #d77d00; z-index: 1;">

                                {!! Form::open(['route' => 'zamowWesele.store', 'files' => true, 'method' => 'POST']) !!}

                                @if($errors->any())
                                    @foreach ($errors->all() as $error)
                                        <div class="btn btn-danger">{{ $error }}</div>
                                    @endforeach
                                @endif

                                <div class="form-group">
                                    {!! Form::label('termin', "Termin wesela:") !!}
                                    {!! Form::text('termin', '', ['class' => 'datepicker', 'id' => 'datepicker']) !!}
                                </div>

                                @if(isset($_GET['tort']))
                                    <br>
                                    <b style="color: black;">Szczególy dotyczące torta:</b><br><br>
                                    <div class="form-group">
                                        {!! Form::label('na_ile_osob_tort', "Na ile osób tort:") !!}
                                        {!! Form::number('na_ile_osob_tort',  null, ['class' => 'form-control']) !!}
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('rodzaj_tortu', "Rodzaj Tortu:") !!}
                                        {!! Form::select('rodzaj_tortu',  ['tradycyjny', 'nowoczesny', 'oryginalny kształt', 'inny(dodaj w opisie)']) !!}
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('smak', "Smak Tortu:") !!}
                                        {!! Form::select('smak',  ['waniliowy', 'orzechowy', 'czekoladowy', 'owocowy(dodaj w opisie jaki)']) !!}
                                    </div>

                                    <span style=" color: black;">
    Jeżeli chcesz, aby tort wyglądał podobnie do innego, lub miał w sobie coś, co chcesz pokazać na zdjęciu, to możesz dodać zdjęcie i uwzględnić szczegóły w opisie.</span><br><br>
                                    <div class="form-group">
                                        {!! Form::label('filename', "Zdjęcie:") !!}
                                        {!! Form::file('filename', null, ['class' => 'form-control']) !!}
                                    </div>
                                @endif
                                <div class="form-group">
                                    {!! Form::label('info', "Dodatkowe informacje:") !!}
                                    {!! Form::textarea('info', null, ['class' => 'form-control']) !!}
                                </div>
                                @if(isset($_GET['ciasta']))
                                    <br>
                                    <b style="color: black;">Podaj ilości brytfanek ciast, które chcesz na salę:</b><br><br>
                                    <div class="form-group">
                                        {!! Form::label('sernik', "Sernik:") !!}
                                        {!! Form::number('sernik',  null, ['class' => 'form-control']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('smietana_galaertka', "Ciasto z bitą śmietaną i galaretką:") !!}
                                        {!! Form::number('smietana_galaertka',  null, ['class' => 'form-control']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('jablecznik', "Jabłecznik:") !!}
                                        {!! Form::number('jablecznik',  null, ['class' => 'form-control']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('makowiec', "Makowiec:") !!}
                                        {!! Form::number('makowiec',  null, ['class' => 'form-control']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('owocowe', "Ciasto owocowe:") !!}
                                        {!! Form::number('owocowe',  null, ['class' => 'form-control']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('rafaello', "Rafaello:") !!}
                                        {!! Form::number('rafaello',  null, ['class' => 'form-control']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('w_z', "W-Z:") !!}
                                        {!! Form::number('w_z',  null, ['class' => 'form-control']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('miodownik', "Miodownik:") !!}
                                        {!! Form::number('miodownik',  null, ['class' => 'form-control']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('czekoladowe', "Czekoladowe:") !!}
                                        {!! Form::number('czekoladowe',  null, ['class' => 'form-control']) !!}
                                    </div>
                                @endif

                                @if(isset($_GET['paczki']))
                                    <br>
                                    <b style="color: black;">Szczególy dotyczące paczek dla gości:</b><br><br>
                                    <div class="form-group">
                                        {!! Form::label('ile_paczek', "Ile paczek:") !!}
                                        {!! Form::number('ile_paczek',  null, ['class' => 'form-control']) !!}
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('wielkosc_paczki', "Wielkość paczek:") !!}
                                        {!! Form::select('wielkosc_paczki',  ['5 kawałków ciasta, 5 ciasteczek', '10 kawałków ciasta, 10 ciasteczek']) !!}
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('rodzaj_paczki', "Rodzaj paczek:") !!}
                                        {!! Form::select('rodzaj_paczki',  ['ciasta z sali', 'inne ciasta']) !!}
                                    </div>
                                @endif


                                <div class="form-group">
                                    {!! Form::submit('Złóż zamówienie', ['class' => 'btn btn-success']) !!}
                                </div>

                                {!! Form::close() !!}
                                <div class="intro-button mx-auto" style="margin-top: 20px;">
                                    <a class="btn btn-primary btn-x2" href="{{route('wesele.index')}}">Powrót</a>
                                </div>
                            </div>
                            @if($wybik = count($_POST['tablica_terminow'])>0)
                                <div class="container" style="float: left; border-top: solid 2px; padding: 20px; margin-top: 20px;">
                                    <div class='calendar' style="z-index: 25;"></div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('scripts')

    <script>

        var terminy = <?php echo json_encode($_POST['wykluczone']) ?>;
        var terminy2 = <?php echo json_encode($_POST['terminyBezZamowien']) ?>;
        var terminy_start = <?php echo json_encode($_POST['terminy_start']) ?>;
        var terminy_end = <?php echo json_encode($_POST['terminy_end']) ?>;
        var events = [];

        var wesela = <?php echo json_encode($_POST['weseles']) ?>;
        var wesela_start = <?php echo json_encode($_POST['weseles_start']) ?>;


        for (var i=0; i < terminy2.length; i++) {

            events.push({
                title: 'Wykluczony',
                start: terminy2[i],
                color: 'red'

            })
        }

        for (var i=0; i < terminy_start.length; i++) {

            events.push({
                title: 'Wykluczony',
                start: terminy_start[i],
                end: terminy_end[i],
                color: 'red'

            })
        }

        for (var i=0; i < wesela.length; i++) {

            events.push({
                title: 'Wykluczony',
                start: wesela[i],
                color: 'red'

            })
        }

        for (var i=0; i < wesela.length; i++) {

            events.push({
                title: 'Wykluczony',
                start: wesela_start[i],
                end: wesela[i],
                color: 'red'

            })
        }

        for (var i=0; i < terminy.length; i++) {

            events.push({
                title: 'Wykluczony',
                start: terminy[i],
                color: 'red'

            })
        }

        $(function() {

            // page is now ready, initialize the calendar...

            $('.calendar').fullCalendar({
                // put your options and callbacks here

                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'prevYear nextYear'
                },
                buttonText: {
                    today: 'dziś'
                },
                themeSystem: 'bootstrap4',
                selectable: true,
                eventLimit: true,
                weekNumberCalculation: 'ISO',
                fixedWeekCount: false,
                dayNamesShort: ['Nd', 'Pon', 'Wt', 'Śr', 'Czw', 'Pt', 'Sb'],
                monthNames: ['Styczeń', 'Luty', 'Marzec', 'Kwiecień', 'Maj', 'Czerwiec', 'Lipiec', 'Sierpień', 'Wrzesień', 'Październik', 'Listopad', 'Grudzień'],


                events: events

            });

        });
    </script>

@endsection