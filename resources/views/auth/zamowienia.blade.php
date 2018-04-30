@extends('layout')

@section('content')
    <section class="page-section cta">
        <div class="container">
            <div class="row">
                <div class="col-xl-9 mx-auto">
                    <div class="cta-inner rounded">
                        <h2 class="section-heading mb-5">
                            <span class="section-heading-upper" style="margin-bottom: 30px;">Zamowienia -
                                @if(request()->routeIs('order.index'))
                                    Oczekujące
                                @elseif(request()->routeIs('order.index_wTrakcie'))
                                    W trakcie realizacji
                                @elseif(request()->routeIs('order.index_zrealizowane'))
                                    Zrealizowane
                                @endif
                            </span>
                        </h2>
                        <div class="row" style="margin-bottom: 30px; margin-top: -50px;">
                            <div class="intro-button mx-auto" style="position: relative; margin-top: 20px; z-index: 20;">
                                <a class="btn btn-outline-danger btn-x2" href="{{route('order.index')}}">Oczekujące
                                    @if( ($orders->where('status', 'oczekuje')->count() >0) || $torty->where('status', 'oczekuje')->count() >0 || $wesela->where('status', 'oczekuje')->count() >0)
                                        ({{ $orders->where('status', 'oczekuje')->count()+ $torty->where('status', 'oczekuje')->count() + $wesela->where('status', 'oczekuje')->count()}})
                                    @endif
                                </a>
                            </div>
                            <div class="intro-button mx-auto" style="position: relative; margin-top: 20px; z-index: 20;">
                                <a class="btn btn-outline-info btn-x2" href="{{route('order.index_wTrakcie')}}">W realizacji
                                    @if( ($orders->where('status', 'w realizacji')->count() >0) || $torty->where('status', 'w realizacji')->count() >0 || $wesela->where('status', 'w realizacji')->count() >0 )
                                        ({{ $orders->where('status', 'w realizacji')->count()+ $torty->where('status', 'w realizacji')->count() + $wesela->where('status', 'w realizacji')->count()}})
                                    @endif
                                </a>
                            </div>
                            <div class="intro-button mx-auto" style="position: relative; margin-top: 20px; z-index: 20;">
                                <a class="btn btn-outline-success btn-x2" href="{{route('order.index_zrealizowane')}}">Zrealizowane
                                </a>
                            </div>
                        </div>
                                @foreach($orders->where('status', 'oczekuje') as $order)
                                    <b style="border-top: solid 1px; border-bottom: dashed 3px antiquewhite; border-right: solid 1px; border-left: solid 1px; z-index: 50;"> {{$order->getUser()->name}} {{$order->getUser()->surname}} - {{$order->getUser()->email}} - tel: {{$order->getUser()->tel}}</b>

                                    <div class="row" style="border-top: 1px solid; padding-top: 5px; text-align: center;">

                                    <div class="col-lg-3 col-md-4 col-sm-6 portfolio-item">
                                        <div class="card h-100" style="background-color: lightgrey;">
                                            <img class="card-img-top" src='{{url("/storage/products_img/".$order->getProduct()->filename)}}' alt="">
                                        </div>
                                    </div>
                                        @if($order->rodzaj == 'ciasteczko')
                                            <div class="section-heading-upper" style="margin-top: 15px;">
                                                <b>{{ $order->ilosc }}</b>  x <b>{{ $order->getProduct()->nazwa }}</b> <br>
                                                Paczki wielkości:
                                                @if( $order->wielkosc  == 0)
                                                    <b>{{ '30 szt.' }}</b>
                                                    <br>
                                                    Termin: <b>{{ $order->termin }}</b>
                                                    <br>Koszt: <b>{{ $order->getProduct()->cena*$order->ilosc }} zł</b>
                                                @elseif($order->wielkosc  == 1)
                                                    <b>{{ '15 szt.' }}</b>
                                                    <br>
                                                    Termin: <b>{{ $order->termin }}</b>
                                                    <br>Koszt: <b>{{ $order->getProduct()->cena_mala*$order->ilosc }} zł</b>
                                                @endif

                                            </div>
                                        @elseif($order->rodzaj == 'ciasto')
                                            <div class="section-heading-upper" style="margin-top: 15px;">
                                                <b>{{ $order->ilosc }}</b>  x <b>{{ $order->getProduct()->nazwa }}</b> <br>
                                                w brytfance wielkości:
                                                @if( $order->wielkosc  == 0)
                                                    <b>{{ '24x37' }}</b>
                                                    <br>
                                                    Termin: <b>{{ $order->termin }}</b>
                                                    <br>Koszt: <b>{{ $order->getProduct()->cena*$order->ilosc }} zł</b>
                                                @elseif($order->wielkosc  == 1)
                                                    <b>{{ '17x24' }}</b>
                                                    <br>
                                                    Termin: <b>{{ $order->termin }}</b>
                                                    <br>Koszt: <b>{{ $order->getProduct()->cena_mala*$order->ilosc }} zł</b>
                                                @endif

                                            </div>
                                        @elseif($order->rodzaj == 'inne')
                                            <div class="section-heading-upper" style="margin-top: 15px;">
                                                <b>{{ $order->ilosc }}</b>  x <b>{{ $order->getProduct()->nazwa }}</b> <br>
                                                    Termin: <b>{{ $order->termin }}</b>
                                                    <br>Koszt: <b>{{ $order->getProduct()->cena*$order->ilosc }} zł</b>

                                            </div>
                                        @endif
                                    <div class="col text-center" style="margin-top: 5px;">
                                           <b>Status:</b> {{ $order->status }}<br>

                                        <div class="intro-button mx-auto" style="margin-top: 5px;">
                                            <a onclick="return confirm('Czy na pewno chcesz wycofać zamówienie?')" class="btn btn-danger btn-x2" href="{{ route('order.delete', ['id' => $order->id]) }}">Wycofaj</a>
                                        </div>

                                        <div class="intro-button mx-auto" style="margin-top: 5px;">
                                            <a onclick="return confirm('Czy na pewno chcesz przekazać do realizacji?')" class="btn btn-success btn-x2" href="{{ route('order.updateDoRealizacji', ['id' => $order->id])}}">Przekaż do realizacji</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" style="margin-left: 20px; margin-right: 20px;">
                                    <div class="section-heading-upper" style="margin-bottom: 20px;">
                                        <b>Dodatkowe informacje:</b>
                                       {{ $order->info }}
                                    </div>
                                </div>
                                @endforeach

                        @foreach($torty->where('status', 'oczekuje') as $tort)
                            <b style="border-top: solid 1px; border-bottom: dashed 3px antiquewhite; border-right: solid 1px; border-left: solid 1px; z-index: 50;"> {{$tort->getUser()->name}} {{$tort->getUser()->surname}} - {{$tort->getUser()->email}} - tel: {{$tort->getUser()->tel}}</b>
                            <div class="row" style="border-top: 1px solid; padding-top: 5px;">
                                <div class="col-lg-3 col-md-4 col-sm-6 portfolio-item">

                                    @if($tort->filename != '')
                                        <div class="card h-100">
                                            Zdjęcie pomocnicze:
                                            <img class="card-img-top" src='{{url("/storage/products_img/".$tort->filename)}}' alt="">
                                        </div>
                                    @else
                                        <div class="card h-100" style="min-height: 130px; border: solid 1px; text-align: center;">
                                            <h1> <i class="fas fa-times"></i></h1> brak zdjęcia pomocniczego
                                        </div>
                                    @endif

                                </div>
                                <div class="section-heading-upper" style="margin-top: 15px;">
                                    Tort - <b>{{ $tort->getCategory()->nazwa }}</b> <br>

                                    Na ile osób: <b>{{ $tort->na_ile_osob }}</b><br>
                                    Smak:
                                    @if($tort->smak==0)
                                        <b>{{ 'waniliowy' }}</b>
                                    @elseif($tort->smak==1)
                                        <b>{{ 'orzechowy' }}</b>
                                    @elseif($tort->smak==2)
                                        <b>{{ 'czekoladowy' }}</b>
                                    @elseif($tort->smak==3)
                                        <b>{{ 'owocowy(dodaj w opisie jaki)' }}</b>
                                    @endif
                                    <br>
                                    Rodzaj dekoracji:
                                    @if( $tort->rodzaj_dekoracji  == 0)
                                        <b>{{ 'tradycyjny' }}</b>
                                    @elseif($tort->rodzaj_dekoracji  == 1)
                                        <b>{{ 'zdjęcie na opłatku' }}</b>
                                    @elseif($tort->rodzaj_dekoracji  == 2)
                                        <b>{{ 'kształt z masy cukrowej' }}</b>
                                    @elseif($tort->rodzaj_dekoracji  == 3)
                                        <b>{{ 'inny' }}</b>
                                    @endif

                                    <br>
                                    Termin: <b>{{ $tort->termin }}</b>
                                </div>

                                <div class="col text-center" style="margin-top: 5px;">
                                    <b>Status:</b> {{ $tort->status }}<br>

                                    <div class="intro-button mx-auto" style="margin-top: 5px;">
                                        <a onclick="return confirm('Czy na pewno chcesz wycofać zamówienie?')" class="btn btn-danger btn-x2" href="{{route('tort_order.delete', ['id' => $tort->id])}}">Wycofaj</a>
                                    </div>

                                    @if($tort->cena == null)
                                        {!! Form::model($tort, ['route' => ['tort.nadajCene', $tort->id], 'method' => 'POST']) !!}

                                        @if($errors->any())
                                            @foreach ($errors->all() as $error)
                                                <div class="btn btn-danger">{{ $error }}</div>
                                            @endforeach
                                        @endif

                                        <div class="form-group">
                                            {!! Form::label('cena', "Cena:") !!}
                                            {!! Form::number('cena', null, ['class' => 'form-control']) !!}
                                        </div>

                                        <div class="form-group">
                                            {!! Form::submit('Nadaj cenę', ['class' => 'btn btn-success']) !!}
                                        </div>

                                        {!! Form::close() !!}
                                    @else
                                         Cena: <b>{{$tort->cena}}</b> zł<br>
                                            <div class="intro-button mx-auto" style="margin-top: 5px;">
                                                <a onclick="return confirm('Czy na pewno chcesz przekazać do realizacji?')" class="btn btn-success btn-x2" href="{{ route('order.updateTortDoRealizacji', ['id' => $tort->id])}}">Przekaż do realizacji</a>
                                            </div>
                                        <div class="intro-button mx-auto" style="margin-top: 5px;">
                                            <a class="btn btn-info btn-x2" href="{{ route('cenaTortu.delete', ['id' => $tort->id])}}">Zmień cenę</a>
                                        </div>
                                    @endif

                                </div>
                            </div>
                            <div class="row" style="margin-left: 20px; margin-right: 20px;">
                                <div class="section-heading-upper" style="margin-bottom: 20px;">
                                    <b>Dodatkowe informacje:</b>
                                    {{ $tort->info }}
                                </div>
                            </div>
                        @endforeach
                        @foreach($wesela->where('status', 'oczekuje') as $wesele)
                            <b style="border-top: solid 1px; border-bottom: dashed 3px antiquewhite; border-right: solid 1px; border-left: solid 1px; z-index: 50;"> {{$wesele->getUser()->name}} {{$wesele->getUser()->surname}} - {{$wesele->getUser()->email}} - tel: {{$wesele->getUser()->tel}}</b>
                            <div class="row" style="border-top: 1px solid; padding-top: 5px;">

                                <div class="col-lg-3 col-md-4 col-sm-6 portfolio-item">

                                    @if($wesele->filename != '')
                                        <div class="card h-100">
                                            Zdjęcie pomocnicze:
                                            <img class="card-img-top" src='{{url("/storage/products_img/".$wesele->filename)}}' alt="">
                                        </div>
                                    @else
                                        <div class="card h-100" style="min-height: 130px; border: solid 1px; text-align: center;">
                                            <h1> <i class="fas fa-times"></i></h1> brak zdjęcia pomocniczego
                                        </div>
                                    @endif

                                </div>
                                <div class="section-heading-upper" style="margin-top: 15px;">
                                    <b>ZAMÓWIENIE WESELNE</b><br>
                                    @if(!$wesele->tort==null)
                                        Tort na <b>{{ $wesele->na_ile_osob_tort }}</b> osób<br>
                                        Rodzaj dekoracji:
                                        @if($wesele->rodzaj_tortu==0)
                                            <b>{{ 'tradycyjny' }}</b>
                                        @elseif($wesele->rodzaj_tortu==1)
                                            <b>{{ 'nowoczesny' }}</b>
                                        @elseif($wesele->rodzaj_tortu==2)
                                            <b>{{ 'oryginalny kształt' }}</b>
                                        @elseif($wesele->rodzaj_tortu==3)
                                            <b>{{ 'inny' }}</b>
                                        @endif
                                        <br>
                                        Smak:
                                        @if($wesele->smak==0)
                                            <b>{{ 'waniliowy' }}</b>
                                        @elseif($wesele->smak==1)
                                            <b>{{ 'orzechowy' }}</b>
                                        @elseif($wesele->smak==2)
                                            <b>{{ 'czekoladowy' }}</b>
                                        @elseif($wesele->smak==3)
                                            <b>{{ 'owocowy(dodaj w opisie jaki)' }}</b>
                                        @endif
                                    @endif

                                    <br>
                                    Termin: <b>{{ $wesele->termin }}</b>
                                </div>


                                <div class="col text-center" style="margin-top: 5px;">
                                    <b>Status:</b> {{ $wesele->status }}<br>

                                    <div class="intro-button mx-auto" style="margin-top: 5px;">
                                        <a onclick="return confirm('Czy na pewno chcesz wycofać zamówienie?')" class="btn btn-danger btn-x2" href="{{route('wesele.delete', ['id' => $wesele->id])}}">Wycofaj</a>
                                    </div>

                                    @if($wesele->cena == null)
                                        {!! Form::model($wesele, ['route' => ['wesele.nadajCene', $wesele->id], 'method' => 'POST']) !!}

                                        @if($errors->any())
                                            @foreach ($errors->all() as $error)
                                                <div class="btn btn-danger">{{ $error }}</div>
                                            @endforeach
                                        @endif

                                        <div class="form-group">
                                            {!! Form::label('cena', "Cena:") !!}
                                            {!! Form::number('cena', null, ['class' => 'form-control']) !!}
                                        </div>

                                        <div class="form-group">
                                            {!! Form::submit('Nadaj cenę', ['class' => 'btn btn-success']) !!}
                                        </div>

                                        {!! Form::close() !!}
                                    @else
                                        Cena: <b>{{$wesele->cena}}</b> zł<br>
                                        <div class="intro-button mx-auto" style="margin-top: 5px;">
                                            <a onclick="return confirm('Czy na pewno chcesz przekazać do realizacji?')" class="btn btn-success btn-x2" href="{{ route('wesele.updateDoRealizacji', ['id' => $wesele->id])}}">Przekaż do realizacji</a>
                                        </div>
                                        <div class="intro-button mx-auto" style="margin-top: 5px;">
                                            <a class="btn btn-info btn-x2" href="{{ route('cena.delete', ['id' => $wesele->id])}}">Zmień cenę</a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            @if(!$wesele->ciasta==null)

                                <b> Ciasta na salę:</b><br>-
                                @if($wesele->sernik>0)
                                    <b>{{ $wesele->sernik }}</b> x sernik,
                                @endif
                                @if($wesele->smietana_galaertka>0)
                                    <b>{{ $wesele->smietana_galaertka }}</b> x delikatne z bitą śmietaną i galaretką,
                                @endif
                                @if($wesele->jablecznik>0)
                                    <b>{{ $wesele->jablecznik }}</b> x jabłecznik,
                                @endif
                                @if($wesele->makowiec>0)
                                    <b>{{ $wesele->makowiec }}</b> x makowiec,
                                @endif
                                @if($wesele->owocowe>0)
                                    <b>{{ $wesele->owocowe }}</b> x owocowe,
                                @endif
                                @if($wesele->rafaello>0)
                                    <b>{{ $wesele->rafaello }}</b> x rafaello,
                                @endif
                                @if($wesele->w_z>0)
                                    <b>{{ $wesele->w_z }}</b> x W-Z,
                                @endif
                                @if($wesele->miodownik>0)
                                    <b>{{ $wesele->miodownik }}</b> x miodownik,
                                @endif
                                @if($wesele->czekoladowe>0)
                                    <b>{{ $wesele->czekoladowe }}</b> x czekoladowe,
                                @endif
                            @endif
                            @if(!$wesele->paczki==null)
                                <br>
                                <b>  Paczki dla gości:  <br> - {{ $wesele->ile_paczek }}</b> szt., w których ma być po
                                @if( $wesele->wielkosc_paczki==0)
                                    <b>{{ '5 kawałków ciasta i 5 ciasteczek' }}</b>
                                @else
                                    <b>{{ '10 kawałków ciasta i 10 ciasteczek' }}</b>
                                @endif
                                @if( $wesele->rodzaj_paczki==0)
                                    {{ '(ciasta jak na sali)' }}
                                @else
                                    {{ '(ciasta inne, niż na sali)' }}
                                @endif
                            @endif
                            <div class="row" style="margin-left: 20px; margin-right: 20px;">
                                <div class="section-heading-upper" style=" margin-bottom: 20px;">
                                    <b>Dodatkowe informacje:</b> {{ $wesele->info }}
                                </div>
                            </div>
                        @endforeach

                </div>
            </div>
        </div>
    </section>
@endsection
