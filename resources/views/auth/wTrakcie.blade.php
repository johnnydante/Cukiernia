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
                                    @if( ($orders->where('status', 'oczekuje')->count() >0) || $torty->where('status', 'oczekuje')->count() >0 )
                                        ({{ $orders->where('status', 'oczekuje')->count()+ $torty->where('status', 'oczekuje')->count() }})
                                    @endif
                                </a>
                            </div>
                            <div class="intro-button mx-auto" style="position: relative; margin-top: 20px; z-index: 20;">
                                <a class="btn btn-outline-info btn-x2" href="{{route('order.index_wTrakcie')}}">W realizacji
                                    @if( ($orders->where('status', 'w realizacji')->count() >0) || $torty->where('status', 'w realizacji')->count() >0 )
                                        ({{ $orders->where('status', 'w realizacji')->count()+ $torty->where('status', 'w realizacji')->count() }})
                                    @endif
                                </a>
                            </div>
                            <div class="intro-button mx-auto" style="position: relative; margin-top: 20px; z-index: 20;">
                                <a class="btn btn-outline-success btn-x2" href="{{route('order.index_zrealizowane')}}">Zrealizowane
                                </a>
                            </div>
                        </div>
                                @foreach($orders->where('status', 'w realizacji') as $order)
                                    <b> {{$order->getUser()->name}} {{$order->getUser()->surname}} - {{$order->getUser()->email}} - tel: {{$order->getUser()->tel}}</b>
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
                                        @endif
                                    <div class="col text-center" style="margin-top: 20px;">
                                           <b>Status:</b> {{ $order->status }}<br>

                                        <div class="intro-button mx-auto" style="margin-top: 5px;">
                                            <a class="btn btn-success btn-x2" href="{{route('order.updateZrealizowane', ['id' => $order->id])}}">Zakończ realizację</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" style="margin-left: 20px; margin-right: 20px;">
                                    <div class="section-heading-upper" style="margin-top: -25px; margin-bottom: 20px;">
                                        <b>Dodatkowe informacje:</b><br>->
                                       {{ $order->info }}
                                    </div>
                                </div>
                                @endforeach

                        @foreach($torty->where('status', 'w realizacji') as $tort)
                            <b> {{$tort->getUser()->name}} {{$tort->getUser()->surname}} - {{$tort->getUser()->email}} - tel: {{$tort->getUser()->tel}}</b>
                            <div class="row" style="border-top: 1px solid; padding-top: 5px;">
                                <div class="col-lg-3 col-md-4 col-sm-6 portfolio-item">

                                    @if($tort->filename != '')
                                        <div class="card h-100">
                                            Zdjęcie pomocnicze:
                                            <img class="card-img-top" src='{{url("/storage/products_img/".$tort->filename)}}' alt="">
                                        </div>
                                    @else
                                        <div class="card h-100" style="min-height: 130px; opacity: 0;">
                                        </div>
                                    @endif

                                </div>
                                <div class="section-heading-upper" style="margin-top: 15px;">
                                    Tort - <b>{{ $tort->getCategory()->nazwa }}</b> <br>

                                    Na ile osób: <b>{{ $tort->na_ile_osob }}</b><br>
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
                                    Termin: <b>{{ $tort->termin }}</b><br>
                                    Koszt: <b>{{ $tort->cena }}</b> zł
                                </div>

                                <div class="col text-center" style="margin-top: 5px;">
                                    <b>Status:</b> {{ $tort->status }}<br>

                                    <div class="intro-button mx-auto" style="margin-top: 5px;">
                                        <a class="btn btn-success btn-x2" href="{{route('order.updateTortZrealizowane', ['id' => $tort->id])}}">Zakończ realizację</a>
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="margin-left: 20px; margin-right: 20px;">
                                <div class="section-heading-upper" style="margin-top: -25px; margin-bottom: 20px;">
                                    <b>Dodatkowe informacje:</b><br>->
                                    {{ $tort->info }}
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
