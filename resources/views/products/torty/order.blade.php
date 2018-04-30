@extends('layout')

@section('content')


    <section class="page-section cta">
        <div class="container">

            <div class="row">
                <div class="col-xl-9 mx-auto">
                    <div class="cta-inner rounded" style="float: left;">
                        <h2 class="section-heading mb-5">
                            <span class="section-heading-upper">Zamów tort - {{ $products->nazwa }}</span>
                            <span class="section-heading-lower"></span>
                        </h2>
                        @if (session('status'))
                            <div class="alert alert-danger">
                                {{ session('status') }}
                            </div>
                        @endif
                            <div class="row">
                                <div class="container" style="max-width: 700px; color: orange; z-index: 1;">
                                    <i>Ceny tortów ustalane są indywidualnie z klientem w zależności od wielkości, rodzaju dekoracji i innych dodatków</i><br><br>
                            @if($wybik = count($_POST['tablica_terminow'])>0)
                                <span style="text-align: justify; color: black;">


                                Z powodu zbyt dużej ilości zamówień, niektóre terminy są już niedostępne, poniżej formularza znajduje się się kalendarz terminów.
 {{--                               @foreach($_POST['tablica_terminow'] as $termin)
                                   {{$termin}},
                                @endforeach--}}
                                <br>Przepraszamy i prosimy o składanie zamówień na wolne dni, dziękujemy!
                                </span><br><br>
                            @endif


                                {!! Form::open(['route' => ['zamowTort.store', $products->id], 'files' => true, 'method' => 'POST']) !!}

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
                                    {!! Form::label('na_ile_osob', "Na ile osób:") !!}
                                    {!! Form::number('na_ile_osob',  null, ['class' => 'form-control']) !!}
                                </div>

                                <div class="form-group">
                                    {!! Form::label('smak', "Smak Tortu:") !!}
                                    {!! Form::select('smak',  ['waniliowy', 'orzechowy', 'czekoladowy', 'owocowy(dodaj w opisie jaki)']) !!}
                                </div>

                                <div class="form-group">
                                    {!! Form::label('rodzaj_dekoracji', "Rodzaj dekoracji:") !!}
                                    {!! Form::select('rodzaj_dekoracji',  ['tradycyjny', 'zdjęcie na opłatku', 'kształt z masy cukrowej', 'inny(dodaj w opisie)']) !!}
                                </div>

<span style=" color: black;">
Jeżeli chcesz, aby tort wyglądał podobnie do innego, lub miał w sobie coś, co chcesz pokazać na zdjęciu, to możesz dodać zdjęcie i uwzględnić szczegóły w opisie.</span><br><br>
                                <div class="form-group">
                                    {!! Form::label('filename', "Zdjęcie:") !!}
                                    {!! Form::file('filename', null, ['class' => 'form-control']) !!}
                                </div>

                                <div class="form-group">
                                    {!! Form::label('info', "Dodatkowy opis:") !!}
                                    {!! Form::textarea('info', null, ['class' => 'form-control']) !!}
                                </div>

                                <div class="form-group">
                                    {!! Form::submit('Dodaj do koszyka', ['class' => 'btn btn-success']) !!}
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
    </section>

@endsection

@section('scripts')

    <script>

        var terminy = <?php echo json_encode($_POST['tablica_terminow']) ?>;
        var events = [];


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