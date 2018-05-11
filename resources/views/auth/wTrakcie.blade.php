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
                                    @if( ($orders->where('status', 'oczekuje')->count() >0) ||
                                    $torty->where('status', 'oczekuje')->count() >0 ||
                                    $wesela->where('status', 'oczekuje')->count() >0)
                                        ({{ $orders->where('status', 'oczekuje')->count()+
                                        $torty->where('status', 'oczekuje')->count() +
                                        $wesela->where('status', 'oczekuje')->count()}})
                                    @endif
                                </a>
                            </div>
                            <div class="intro-button mx-auto" style="position: relative; margin-top: 20px; z-index: 20;">
                                <a class="btn btn-outline-info btn-x2" href="{{route('order.index_wTrakcie')}}">W realizacji
                                    @if( ($orders->where('status', 'w realizacji')->count() >0) ||
                                    $torty->where('status', 'w realizacji')->count() >0 ||
                                    $wesela->where('status', 'w realizacji')->count() >0 )
                                        ({{ $orders->where('status', 'w realizacji')->count()+
                                        $torty->where('status', 'w realizacji')->count() +
                                        $wesela->where('status', 'w realizacji')->count()}})
                                    @endif
                                </a>
                            </div>
                            <div class="intro-button mx-auto" style="position: relative; margin-top: 20px; z-index: 20;">
                                <a class="btn btn-outline-success btn-x2" href="{{route('order.index_zrealizowane')}}">Zrealizowane
                                </a>
                            </div>
                        </div>

                            @foreach($orders->where('status', 'w realizacji') as $order)
                                <b style="border-top: solid 1px; border-bottom: dashed 3px antiquewhite; border-right: solid 1px; border-left: solid 1px; z-index: 50;">
                                    {{$order->getUser()->name}} {{$order->getUser()->surname}} -
                                    {{$order->getUser()->email}} - tel: {{$order->getUser()->tel}}
                                </b>
                                <div class="row" style="border-top: 1px solid; padding-top: 5px;">
                                    <div class="col-lg-3 col-md-4 col-sm-6 portfolio-item">
                                        <div class="card h-100" style="background-color: lightgrey;">
                                            <img class="card-img-top" src='{{url("/storage/products_img/".$order->getProduct()->filename)}}' alt="">
                                        </div>
                                    </div>

                                    @if($order->rodzaj == 'ciasteczko')
                                        <div class="section-heading-upper" style="margin-top: 15px;">
                                            <b>{{ $order->ilosc }}</b>  x <b>{{ $order->getProduct()->nazwa }}</b> <br>
                                            Termin: <b>{{ $order->termin }}</b><br>
                                            Koszt: <b>{{ floor(($order->getProduct()->cena*$order->ilosc)/100) }} zł
                                                {{ round((($order->getProduct()->cena*$order->ilosc)/100 -
                                                 floor(($order->getProduct()->cena*$order->ilosc)/100))*100) }} gr</b>
                                        </div>
                                    @elseif($order->rodzaj == 'ciasto')
                                        <div class="section-heading-upper" style="margin-top: 15px;">
                                            <b>{{ $order->ilosc }}</b>  x <b>{{ $order->getProduct()->nazwa }}</b> <br>
                                            w brytfance wielkości: <b>{{ $order->wielkosc }}</b><br>
                                            Termin: <b>{{ $order->termin }}</b><br>
                                            Koszt: <b>{{ $order->getProduct()->cena_mala*$order->ilosc }} zł</b>
                                        </div>
                                    @elseif($order->rodzaj == 'inne')
                                        <div class="section-heading-upper" style="margin-top: 15px;">
                                            <b>{{ $order->ilosc }}</b>  x <b>{{ $order->getProduct()->nazwa }}</b> <br>
                                            Termin: <b>{{ $order->termin }}</b><br>
                                            Koszt: <b>{{ $order->getProduct()->cena*$order->ilosc }} zł</b>
                                        </div>
                                    @endif

                                    <div class="col text-center" style="margin-top: 20px;">
                                       <b>Status:</b> {{ $order->status }}<br>
                                        <div class="intro-button mx-auto" style="margin-top: 5px;">
                                            <a onclick="return confirm('Czy na pewno chcesz zakończyć realizację?')"
                                               class="btn btn-success btn-x2"
                                               href="{{route('order.updateZrealizowane', ['id' => $order->id])}}">
                                                Zakończ realizację
                                            </a>
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

                        @foreach($torty->where('status', 'w realizacji') as $tort)
                            <b style="border-top: solid 1px; border-bottom: dashed 3px antiquewhite; border-right: solid 1px; border-left: solid 1px; z-index: 50;"> {{$tort->getUser()->name}} {{$tort->getUser()->surname}} -
                                {{$tort->getUser()->email}} - tel: {{$tort->getUser()->tel}}</b>
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
                                    Tort - <b>{{ $tort->getCategory()->nazwa }}</b><br>
                                    Na ile osób: <b>{{ $tort->na_ile_osob }}</b><br>
                                    Smak: <b>{{ $tort->smak }}</b><br>
                                    Rodzaj dekoracji: <b>{{ $tort->rodzaj_dekoracji }}</b><br>
                                    Rodzaj masy w torcie:<b> {{ $tort->rodzaj_masy }} </b><br>
                                    Termin: <b>{{ $tort->termin }}</b><br>
                                    Koszt: <b>{{ $tort->cena }}</b> zł
                                </div>
                                <div class="col text-center" style="margin-top: 5px;">
                                    <b>Status:</b> {{ $tort->status }}<br>
                                    <div class="intro-button mx-auto" style="margin-top: 5px;">
                                        <a onclick="return confirm('Czy na pewno chcesz zakończyć realizację?')"
                                           class="btn btn-success btn-x2"
                                           href="{{route('order.updateTortZrealizowane', ['id' => $tort->id])}}">
                                            Zakończ realizację
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="margin-left: 20px; margin-right: 20px;">
                                <div class="section-heading-upper" style="margin-bottom: 20px;">
                                    <b>Dodatkowe informacje:</b>
                                    {{ $tort->info }}
                                </div>
                            </div>
                        @endforeach

                        @foreach($wesela->where('status', 'w realizacji') as $wesele)
                            <b style="border-top: solid 1px; border-bottom: dashed 3px antiquewhite; border-right: solid 1px; border-left: solid 1px; z-index: 50;"> {{$wesele->getUser()->name}} {{$wesele->getUser()->surname}} -
                                {{$wesele->getUser()->email}} - tel: {{$wesele->getUser()->tel}}
                            </b>
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
                                    @if($wesele->rodzaj_tortu!=null)
                                        Tort na <b>{{ $wesele->na_ile_osob_tort }}</b> osób<br>
                                        Rodzaj dekoracji: <b>{{ $wesele->rodzaj_tortu }}</b><br>
                                        Smak: <b>{{ $wesele->smak }}</b><br>
                                        Rodzaj masy w torcie: <b>{{ $wesele->rodzaj_masy }}</b><br>
                                    @endif
                                    Termin: <b>{{ $wesele->termin }}</b>
                                    <br>Koszt: <b>{{ $wesele->cena }}</b> zł
                                </div>
                                    <div class="col text-center" style="margin-top: 5px;">
                                        <b>Status:</b> {{ $wesele->status }}<br>
                                        <div class="intro-button mx-auto" style="margin-top: 5px;">
                                            <a onclick="return confirm('Czy na pewno chcesz zakończyć realizację?')"
                                               class="btn btn-success btn-x2"
                                               href="{{route('wesele.updateZrealizowane', ['id' => $wesele->id])}}">
                                                Zakończ realizację
                                            </a>
                                        </div>
                                    </div>
                                </div>

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
                            @if($wesele->seromak>0)
                                <b>{{ $wesele->seromak }}</b> x seromak,
                            @endif
                            @if($wesele->pani_walewska>0)
                                <b>{{ $wesele->pani_walewska }}</b> x pani Walewska,
                            @endif
                            @if($wesele->ambasador>0)
                                <b>{{ $wesele->ambasador }}</b> x ambasador,
                            @endif
                            @if($wesele->brzoskwiniowiec>0)
                                <b>{{ $wesele->brzoskwiniowiec }}</b> x brzoskwiniowiec,
                            @endif
                            @if($wesele->pianka_z_malinami>0)
                                <b>{{ $wesele->pianka_z_malinami }}</b> x Pianka z malinami,
                            @endif
                            @if($wesele->królewiec>0)
                                <b>{{ $wesele->królewiec }}</b> x królewiec,
                            @endif
                            @if($wesele->szpinakowe>0)
                                <b>{{ $wesele->szpinakowe }}</b> x szpinakowe z bitą śmietaną i malinami,
                            @endif
                            @if($wesele->powidła_krem>0)
                                <b>{{ $wesele->powidła_krem }}</b> x ciasto z powidłami i kremem,
                            @endif
                            @if($wesele->rureczki>0)
                                <b>{{ $wesele->rureczki }}</b> x rureczki,
                            @endif
                            @if($wesele->babeczki>0)
                                <b>{{ $wesele->babeczki }}</b> x babeczki,
                            @endif
                            @if($wesele->ciasteczka_mieszane>0)
                                <b>{{ $wesele->ciasteczka_mieszane }}</b> x ciasteczka mieszane,
                            @endif

                            @if($wesele->wielkosc_paczki!=null)
                                <br>
                                <b>  Paczki dla gości:  <br> - {{ $wesele->ile_paczek }}</b> szt.,
                                w których ma być po <b>{{ $wesele->wielkosc_paczki }}</b>
                            @endif

                            <div class="row" style="margin-left: 20px; margin-right: 20px;">
                                <div class="section-heading-upper" style=" margin-bottom: 20px;">
                                    <b>Dodatkowe informacje:</b><br> {{ $wesele->info }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
