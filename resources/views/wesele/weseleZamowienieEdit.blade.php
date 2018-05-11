@extends('layout')

@section('content')

    <section class="page-section cta">
        <div class="container">

            <div class="row">
                <div class="col-xl-9 mx-auto">
                    <div class="cta-inner rounded" style="float: left;">
                        <h2 class="section-heading mb-5">
                            <span class="section-heading-upper">Edytuj zamówienie weselne</span>
                            <span class="section-heading-lower"></span>
                        </h2>
                        @if (session('status'))
                            <div class="alert alert-danger">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if($wybik = count($_POST['tablica_terminow'])>0)
                            Z powodu zbyt dużej ilości zamówień, niektóre terminy mogą być niedostępne,
                            poniżej formularza znajduje się się kalendarz terminów, w którym wykluczone terminy będą zaznaczone na
                            <span style="color: red;"><b><i>czerwono</i></b></span>.
                            <br>Przepraszamy i prosimy o składanie zamówień na wolne dni, dziękujemy!
                        @endif
                        <div class="row">
                            <div class="container" style="max-width: 700px; color: #d77d00; z-index: 1;">


                                {!! Form::model($wesele, ['route' => ['zamowWesele.update', $wesele->id], 'files' => true, 'method' => 'POST']) !!}

                                @if($errors->any())
                                    @foreach ($errors->all() as $error)
                                        <div class="btn btn-danger">{{ $error }}</div>
                                    @endforeach
                                @endif

                                <div class="form-group">
                                    {!! Form::label('termin', "Termin:") !!}
                                    {!! Form::text('termin', $wesele->termin, ['class' => 'datepicker', 'id' => 'datepicker']) !!}
                                </div>

                                @if($wesele->rodzaj_tortu!=null)
                                    <br>
                                    <b style="color: black;">Szczególy dotyczące torta:</b><br><br>
                                    <div class="form-group">
                                        {!! Form::label('na_ile_osob_tort', "Na ile osób tort:") !!}
                                        {!! Form::number('na_ile_osob_tort',  $wesele->na_ile_osob_tort, ['class' => 'form-control']) !!}
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('smak', "Smak Tortu:") !!}
                                        {!! Form::select('smak',  ['waniliowy' => 'waniliowy', 'orzechowy' => 'orzechowy',
                                        'czekoladowy' => 'czekoladowy', 'chałwowy' => 'chałwowy', 'adwokatowy' => 'adwokatowy',
                                         'owocowy' => 'owocowy', 'inny(dodaj w opisie jaki)' => 'inny(dodaj w opisie jaki)']) !!}
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('rodzaj_tortu', "Rodzaj dekoracji:") !!}
                                        {!! Form::select('rodzaj_tortu',  ['tradycyjny' => 'tradycyjny',
                                         'w stylu angielskim(pokryty masą cukrową)' => 'w stylu angielskim(pokryty masą cukrową)',
                                         'oryginalny(np. samochód, itp - dodaj w opisie)' => 'oryginalny(np. samochód, itp - dodaj w opisie)',
                                          'inny(dodaj w opisie)' => 'inny(dodaj w opisie)']) !!}
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('rodzaj_masy', "Rodzaj masy w torcie:") !!}
                                        {!! Form::select('rodzaj_masy',  ['bita śmietana' => 'bita śmietana',
                                         'krem z masy' => 'krem z masy', 'krem budyniowy' => 'krem budyniowy']) !!}
                                    </div>

                                    @if($wesele->filename != null)
                                        <div class="col-lg-4 col-md-3 col-sm-6 portfolio-item">
                                            <div class="card h-100">
                                                Zdjęcie pomocnicze:
                                                <img class="card-img-top" src='{{url("/storage/products_img/".$wesele->filename)}}' alt="">
                                            </div>
                                            <div class="intro-button mx-auto" style="margin-top: 5px;">
                                                <a class="btn btn-danger btn-x2" href="{{route('wesele_zdjecie.delete', ['id' => $wesele->id])}}">Usuń zdjęcie</a>
                                            </div>
                                        </div>
                                    @else
                                    <div class="form-group">
                                        {!! Form::label('filename', "Zdjęcie:") !!}
                                        {!! Form::file('filename', null, ['class' => 'form-control']) !!}
                                    </div>
                                        @endif
                                @endif

                                    <br>
                                    <b style="color: black;">Podaj ilości brytfanek ciast, które chcesz na salę:</b><br><br>
                                    <div class="form-group">
                                        {!! Form::label('sernik', "Sernik:") !!}
                                        {!! Form::number('sernik',  $wesele->sernik, ['class' => 'form-control']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('smietana_galaertka', "Ciasto z galaretką i owocami:") !!}
                                        {!! Form::number('smietana_galaertka',  $wesele->smietana_galaertka, ['class' => 'form-control']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('jablecznik', "Jabłecznik:") !!}
                                        {!! Form::number('jablecznik',  $wesele->jablecznik, ['class' => 'form-control']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('makowiec', "Makowiec:") !!}
                                        {!! Form::number('makowiec',  $wesele->makowiec, ['class' => 'form-control']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('owocowe', "Ciasto ucierane z owocami:") !!}
                                        {!! Form::number('owocowe',  $wesele->owocowe, ['class' => 'form-control']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('rafaello', "Rafaello:") !!}
                                        {!! Form::number('rafaello',  $wesele->rafaello, ['class' => 'form-control']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('w_z', "W-Z:") !!}
                                        {!! Form::number('w_z',  $wesele->w_z, ['class' => 'form-control']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('miodownik', "Miodownik:") !!}
                                        {!! Form::number('miodownik',  $wesele->miodownik, ['class' => 'form-control']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('czekoladowe', "Czekoladowe z gruszkami:") !!}
                                        {!! Form::number('czekoladowe',  $wesele->czekoladowe, ['class' => 'form-control']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('seromak', "Seromak:") !!}
                                        {!! Form::number('seromak',  $wesele->seromak, ['class' => 'form-control']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('pani_walewska', "Pani Walewska:") !!}
                                        {!! Form::number('pani_walewska',  $wesele->pani_walewska, ['class' => 'form-control']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('ambasador', "Ambasador:") !!}
                                        {!! Form::number('ambasador',  $wesele->ambasador, ['class' => 'form-control']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('brzoskwiniowiec', "Brzoskwiniowiec:") !!}
                                        {!! Form::number('brzoskwiniowiec',  $wesele->brzoskwiniowiec, ['class' => 'form-control']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('pianka_z_malinami', "Pianka z malinami:") !!}
                                        {!! Form::number('pianka_z_malinami',  $wesele->pianka_z_malinami, ['class' => 'form-control']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('królewiec', "Królewiec:") !!}
                                        {!! Form::number('królewiec',  $wesele->królewiec, ['class' => 'form-control']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('szpinakowe', "Szpinakowe z bitą śmietaną i malinami:") !!}
                                        {!! Form::number('szpinakowe',  $wesele->szpinakowe, ['class' => 'form-control']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('powidła_krem', "Ciasto z powidłami i kremem:") !!}
                                        {!! Form::number('powidła_krem',  $wesele->powidła_krem, ['class' => 'form-control']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('rureczki', "Rureczki:") !!}
                                        {!! Form::number('rureczki',  $wesele->rureczki, ['class' => 'form-control']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('babeczki', "Babeczki:") !!}
                                        {!! Form::number('babeczki',  $wesele->babeczki, ['class' => 'form-control']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('ciasteczka_mieszane', "Ciasteczka mieszane:") !!}
                                        {!! Form::number('ciasteczka_mieszane',  $wesele->ciasteczka_mieszane, ['class' => 'form-control']) !!}
                                    </div>

                                @if($wesele->wielkosc_paczki!=null)
                                    <br>
                                    <b style="color: black;">Szczególy dotyczące paczek dla gości:</b><br><br>
                                    <div class="form-group">
                                        {!! Form::label('ile_paczek', "Ile paczek:") !!}
                                        {!! Form::number('ile_paczek',  $wesele->ile_paczek, ['class' => 'form-control']) !!}
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('wielkosc_paczki', "Wielkość paczek:") !!}
                                        {!! Form::select('wielkosc_paczki',  [
                                        '3 kawałki ciasta, 2 rogaliki, 2 rureczki, 6 ciasteczek' => '3 kawałki ciasta, 2 rogaliki, 2 rureczki, 6 ciasteczek',
                                        '4 kawałki ciasta, 6 ciasteczek' => '4 kawałki ciasta, 6 ciasteczek']) !!}
                                    </div>
                                @endif

                                <div class="form-group">
                                    {!! Form::label('info', "Dodatkowe informacje:") !!}
                                    {!! Form::textarea('info', $wesele->info, ['class' => 'form-control']) !!}
                                </div>

                                <div class="form-group">
                                    {!! Form::submit('Zapisz zmiany', ['class' => 'btn btn-success']) !!}
                                    {!! link_to(URL::previous(),'Powrót', ['class' => 'btn btn-primary']) !!}
                                </div>

                                {!! Form::close() !!}
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