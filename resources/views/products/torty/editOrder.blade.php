@extends('layout')

@section('content')


    <section class="page-section cta">
        <div class="container">

            <div class="row">
                <div class="col-xl-9 mx-auto">
                    <div class="cta-inner rounded" style="float: left;">
                        <h2 class="section-heading mb-5">
                            <span class="section-heading-upper">Edutuj zamówienie torta - {{ $tort->getCategory()->nazwa }}</span>
                            <span class="section-heading-lower"></span>
                        </h2>
                        @if (session('status'))
                            <div class="alert alert-danger">
                                {{ session('status') }}
                            </div>
                        @endif
                            <div class="row">
                                <div class="container" style="max-width: 700px; color: #d77d00; z-index: 1;">

                                @if($wybik = count($_POST['tablica_terminow'])>0)
                                    <span style="text-align: justify; color: black;">
                                        <i>Ceny tortów ustalane są indywidualnie z klientem w zależności od wielkości, rodzaju dekoracji i innych dodatków</i><br><br>
                                    Z powodu zbyt dużej ilości zamówień, niektóre terminy mogą być niedostępne,
                            poniżej formularza znajduje się się kalendarz terminów, w którym wykluczone terminy będą zaznaczone na
                            <span style="color: red;"><b><i>czerwono</i></b></span>.
                            <br>Przepraszamy i prosimy o składanie zamówień na wolne dni, dziękujemy!
                                    </span><br><br>
                                @endif

                                {!! Form::model($tort, ['route' => ['tort_order.update', $tort->id], 'files' => true, 'method' => 'POST']) !!}

                                @if($errors->any())
                                    @foreach ($errors->all() as $error)
                                        <div class="btn btn-danger">{{ $error }}</div>
                                    @endforeach
                                @endif

                                <div class="form-group">
                                    {!! Form::label('termin', "Termin:") !!}
                                    {!! Form::text('termin', $tort->termin, ['class' => 'datepicker', 'id' => 'datepicker']) !!}
                                </div>

                                <div class="form-group">
                                    {!! Form::label('na_ile_osob', "Na ile osób:") !!}
                                    {!! Form::number('na_ile_osob',  $tort->na_ile_osob, ['class' => 'form-control']) !!}
                                </div>

                                <div class="form-group">
                                    {!! Form::label('smak', "Smak Tortu:") !!}
                                    {!! Form::select('smak',  ['waniliowy' => 'waniliowy', 'orzechowy' => 'orzechowy',
                                    'czekoladowy' => 'czekoladowy', 'chałwowy' => 'chałwowy', 'adwokatowy' => 'adwokatowy',
                                     'owocowy' => 'owocowy', 'inny(dodaj w opisie jaki)' => 'inny(dodaj w opisie jaki)']) !!}
                                </div>

                                <div class="form-group">
                                    {!! Form::label('rodzaj_dekoracji', "Rodzaj dekoracji:") !!}
                                    {!! Form::select('rodzaj_dekoracji',  ['tradycyjny' => 'tradycyjny',
                                     'zdjęcie na opłatku' => 'zdjęcie na opłatku',
                                     'w stylu angielskim(pokryty masą cukrową)' => 'w stylu angielskim(pokryty masą cukrową)',
                                     'obsypany płatkami kokosa' => 'obsypany płatkami kokosa',
                                      'inny(dodaj w opisie)' => 'inny(dodaj w opisie)']) !!}
                                </div>

                                <div class="form-group">
                                    {!! Form::label('rodzaj_masy', "Rodzaj masy w torcie:") !!}
                                    {!! Form::select('rodzaj_masy',  ['bita śmietana' => 'bita śmietana',
                                     'krem z masy' => 'krem z masy', 'krem budyniowy' => 'krem budyniowy']) !!}
                                </div>

                                @if($tort->filename != null)

                                    <div class="col-lg-4 col-md-3 col-sm-6 portfolio-item">
                                            <div class="card h-100">
                                                Zdjęcie pomocnicze:
                                                <img class="card-img-top" src='{{url("/storage/products_img/".$tort->filename)}}' alt="">
                                            </div>
                                        <div class="intro-button mx-auto" style="margin-top: 5px;">
                                            <a class="btn btn-danger btn-x2" href="{{route('tort_zdjecie.delete', ['id' => $tort->id])}}">Usuń zdjęcie</a>
                                        </div>
                                    </div>
                                @else

                                <div class="form-group">
                                    {!! Form::label('filename', "Zdjęcie:") !!}
                                    {!! Form::file('filename', null, ['class' => 'form-control']) !!}
                                </div>
                                @endif

                                <div class="form-group">
                                    {!! Form::label('info', "Dodatkowy opis:") !!}
                                    {!! Form::textarea('info', $tort->info, ['class' => 'form-control']) !!}
                                </div>

                                <div class="form-group">
                                    {!! Form::submit('Zapisz', ['class' => 'btn btn-success']) !!}
                                    {!! link_to(URL::previous(),'Powrót', ['class' => 'btn btn-primary']) !!}
                                </div>

                                {!! Form::close() !!}
                            </div>

                            @if($wybik = count($_POST['tablica_terminow'])>0)
                                <div class="container" style="float: left; border-top: solid 2px; padding: 20px;">
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