@extends('layout')

@section('content')


    <section class="page-section cta">
        <div class="container">
            <div class="row">
                <div class="col-xl-9 mx-auto">
                    <div class="cta-inner rounded">
                        <h2 class="section-heading mb-5">
                            <span class="section-heading-upper">Zamów {{ $order->getProduct()->nazwa }}</span>
                            <span class="section-heading-lower"></span>
                        </h2>
                        <div class="row">
                        <div class="col-lg-3 col-md-4 col-sm-6 portfolio-item">
                            <div class="card h-100" style="background-color: lightgrey;">
                                <img class="card-img-top" src='{{url("/storage/products_img/".$order->getProduct()->filename)}}' alt="">
                            </div>
                        </div>
                        @if($wybik = count($_POST['tablica_terminow'])>0)
                                Z powodu zbyt dużej ilości zamówień, niektóre terminy mogą być niedostępne,
                                poniżej formularza znajduje się się kalendarz terminów, w którym wykluczone terminy będą zaznaczone na
                                <span style="color: red;"><b><i>czerwono</i></b></span>.
                                Przepraszamy i prosimy o składanie zamówień na wolne dni, dziękujemy!
                        @endif
                    </div>
                        <div class="row">
                            <div class="container" style="max-width: 700px; color: orange; z-index: 1;">
                                {!! Form::model($order, ['route' => ['order.update', $order], 'method' => 'POST']) !!}

                                @if($errors->any())
                                    @foreach ($errors->all() as $error)
                                        <div class="btn btn-danger">{{ $error }}</div>
                                    @endforeach
                                @endif

                                <div class="form-group">
                                    {!! Form::label('termin', "Termin:") !!}
                                    {!! Form::text('termin', $order->termin, ['class' => 'datepicker', 'id' => 'datepicker']) !!}
                                </div>

                                @if($order->rodzaj == 'ciasto')
                                    <div class="form-group">
                                        {!! Form::label('wielkosc', "Wielkość brytfanki:") !!}
                                        {!! Form::select('wielkosc', ['24x37cm' => '24x37cm', '23x28cm' => '23x28cm']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('ilosc', "Ilość brytfanek:") !!}
                                        {!! Form::number('ilosc', $order->ilosc, ['class' => 'form-control']) !!}
                                    </div>
                                @else
                                    <div class="form-group">
                                        {!! Form::label('ilosc', "Ilość:") !!}
                                        {!! Form::number('ilosc', $order->ilosc, ['class' => 'form-control']) !!}
                                    </div>
                                @endif

                                <div class="form-group">
                                    {!! Form::label('info', "Dodatkowe informacje:") !!}
                                    {!! Form::textarea('info', $order->info, ['class' => 'form-control']) !!}
                                </div>

                                <div class="form-group">
                                    {!! Form::submit('Zapisz zmiany', ['class' => 'btn btn-success']) !!}
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
