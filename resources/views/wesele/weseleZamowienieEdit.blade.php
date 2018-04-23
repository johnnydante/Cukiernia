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

                        <div class="row">
                            <div class="container" style="max-width: 700px; color: orange; z-index: 1;">


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

                                @if(!$wesele->tort==null)
                                    <br>
                                    <b style="color: black;">Szczególy dotyczące torta:</b><br><br>
                                    <div class="form-group">
                                        {!! Form::label('na_ile_osob_tort', "Na ile osób tort:") !!}
                                        {!! Form::number('na_ile_osob_tort',  $wesele->na_ile_osob_tort, ['class' => 'form-control']) !!}
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('rodzaj_tortu', "Rodzaj Tortu:") !!}
                                        {!! Form::select('rodzaj_tortu',  ['tradycyjny', 'nowoczesny', 'oryginalny kształt', 'inny(dodaj w opisie)']) !!}
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('smak', "Smak Tortu:") !!}
                                        {!! Form::select('smak',  ['waniliowy', 'orzechowy', 'czekoladowy', 'owocowy(dodaj w opisie jaki)']) !!}
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
                                <div class="form-group">
                                    {!! Form::label('info', "Dodatkowe informacje:") !!}
                                    {!! Form::textarea('info', $wesele->info, ['class' => 'form-control']) !!}
                                </div>
                                @if(!$wesele->ciasta==null)
                                    <br>
                                    <b style="color: black;">Podaj ilości brytfanek ciast, które chcesz na salę:</b><br><br>
                                    <div class="form-group">
                                        {!! Form::label('sernik', "Sernik:") !!}
                                        {!! Form::number('sernik',  $wesele->sernik, ['class' => 'form-control']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('smietana_galaertka', "Ciasto z bitą śmietaną i galaretką:") !!}
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
                                        {!! Form::label('owocowe', "Ciasto owocowe:") !!}
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
                                        {!! Form::label('czekoladowe', "Czekoladowe:") !!}
                                        {!! Form::number('czekoladowe',  $wesele->czekoladowe, ['class' => 'form-control']) !!}
                                    </div>
                                @endif

                                @if(!$wesele->paczki==null)
                                    <br>
                                    <b style="color: black;">Szczególy dotyczące paczek dla gości:</b><br><br>
                                    <div class="form-group">
                                        {!! Form::label('ile_paczek', "Ile paczek:") !!}
                                        {!! Form::number('ile_paczek',  $wesele->ile_paczek, ['class' => 'form-control']) !!}
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
                                    {!! Form::submit('Zapisz zmiany', ['class' => 'btn btn-success']) !!}
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