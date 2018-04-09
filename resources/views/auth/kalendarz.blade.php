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

         <div class="row" style="position: relative; z-index: 10;">
          @if($wybik = count($_POST['terminyBezZamowien'])>0)
           Terminy niedostępne z powodu zbyt dużej ilości zamówień:
          <br>
           @foreach($_POST['terminyBezZamowien'] as $termin)
            {{$termin}},
           @endforeach
          @endif

           @if($wybik = count($_POST['wykluczone'])>0)
            <br>Terminy wykluczone przez Ciebie:
            <br>
            @foreach($_POST['wykluczone'] as $termin)
             {{$termin}},
            @endforeach
           @endif
         </div>

         <div id='calendar' style="z-index: 25;"></div>

     </div>
    </div>
   </div>
  </div>
 </section>
@endsection
