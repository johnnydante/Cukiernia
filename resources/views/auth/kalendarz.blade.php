@extends('layout')

@section('content')
 <section class="page-section cta">
  <div class="container">
   <div class="row">
    <div class="col-xl-9 mx-auto">
     <div class="cta-inner rounded">
      <h2 class="section-heading mb-5">
       <span class="section-heading-upper" style="margin-bottom: 30px;">Kalendarz terminów</span>
      </h2>
        <div class="row" style="position: relative; z-index: 10;">
         {!! Form::open(['route' => 'kalendarz.dodaj', 'method' => 'POST']) !!}
         @if($errors->any())
          @foreach ($errors->all() as $error)
           <div class="btn btn-danger">{{ $error }}</div>
          @endforeach
         @endif
          <div class="form-group">
           {!! Form::label('termin_wykluczony', "Termin:") !!}
           {!! Form::text('termin_wykluczony', '', ['id' => 'datepicker']) !!}
           {!! Form::submit('Wyklucz termin', ['class' => 'btn btn-outline-danger']) !!}
          </div>

         {!! Form::close() !!}
         </div>

      <div class="row" style="position: relative; z-index: 10;">
       {!! Form::open(['route' => 'kalendarz.usun', 'method' => 'POST']) !!}
       @if($errors->any())
        @foreach ($errors->all() as $error)
         <div class="btn btn-danger">{{ $error }}</div>
        @endforeach
       @endif
       <div class="form-group">
        {!! Form::label('termin_odznaczony', "Termin:") !!}
        {!! Form::text('termin_odznaczony', '', ['id' => 'datepicker2']) !!}
        {!! Form::submit('Odznacz wykluczenie', ['class' => 'btn btn-outline-info']) !!}
       </div>

       {!! Form::close() !!}
      </div>

         @if($wybik = count($_POST['terminyBezZamowien'])>0)
            <div class='calendar' style="z-index: 25; margin-top: 20px;"></div>
         @endif


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
        var rodzaj = <?php echo json_encode($_POST['rodzaj']) ?>;
        var events = [];

        var zamowienia = <?php echo json_encode($_POST['orders']) ?>;
        var torty = <?php echo json_encode($_POST['torts']) ?>;
        var ilosc = <?php echo json_encode($_POST['ilosc']) ?>;


        for (var i=0; i < terminy2.length; i++) {

            events.push({
                title: '- Max -',
                start: terminy2[i],
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

        for (var i=0; i < zamowienia.length; i++) {

            events.push({
                title: ilosc[i]+' x '+rodzaj[i],
                start: zamowienia[i]
            })
        }

        for (var i=0; i < torty.length; i++) {

            events.push({
                title: '1 x Tort',
                start: torty[i]
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
                eventLimit: 3,
                weekNumberCalculation: 'ISO',
                fixedWeekCount: false,
                dayNamesShort: ['Nd', 'Pon', 'Wt', 'Śr', 'Czw', 'Pt', 'Sb'],
                monthNames: ['Styczeń', 'Luty', 'Marzec', 'Kwiecień', 'Maj', 'Czerwiec', 'Lipiec', 'Sierpień', 'Wrzesień', 'Październik', 'Listopad', 'Grudzień'],

                events: events

            });

        });
    </script>

@endsection
