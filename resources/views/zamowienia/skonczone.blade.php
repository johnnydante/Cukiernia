@extends('layout')

@section('content')
    <section class="page-section cta">
        <div class="container">
            <div class="row">
                <div class="col-xl-9 mx-auto">
                    <div class="cta-inner rounded">
                        <h2 class="section-heading mb-5">
                            <span class="section-heading-upper" >Moje zamowienia -

                                @if(request()->routeIs('zamowienia.show'))
                                    Oczekujące
                                @elseif(request()->routeIs('wRealizacji.show'))
                                    W trakcie realizacji
                                @elseif(request()->routeIs('skonczone.show'))
                                    Zrealizowane
                                @endif
                            </span>
                        </h2>

                        <div class="row" style="margin-bottom: 30px; margin-top: -50px;">
                            <div class="intro-button mx-auto" style="position: relative; margin-top: 20px; z-index: 20;">
                                <a class="btn btn-outline-danger btn-x2" href="{{route('zamowienia.show')}}">Oczekujące
                                    @if( ($zamowienia->where('status', 'oczekuje')->count() >0) || $torty->where('status', 'oczekuje')->count() >0 )
                                        ({{ $zamowienia->where('status', 'oczekuje')->count()+ $torty->where('status', 'oczekuje')->count() }})
                                    @endif
                                </a>
                            </div>
                            <div class="intro-button mx-auto" style="position: relative; margin-top: 20px; z-index: 20;">
                                <a class="btn btn-outline-info btn-x2" href="{{route('wRealizacji.show')}}">W realizacji
                                    @if( ($zamowienia->where('status', 'w realizacji')->count() >0) || $torty->where('status', 'w realizacji')->count() >0 )
                                        ({{ $zamowienia->where('status', 'w realizacji')->count()+ $torty->where('status', 'w realizacji')->count() }})
                                    @endif
                                </a>
                            </div>
                            <div class="intro-button mx-auto" style="position: relative; margin-top: 20px; z-index: 20;">
                                <a class="btn btn-outline-success btn-x2" href="{{route('skonczone.show')}}">Zrealizowane
                                </a>
                            </div>
                        </div>

                                @foreach($zamowienia->where('status', 'zrealizowane') as $zamowienie)
                                <div class="row" style="border-top: 1px solid; padding-top: 5px;">
                                    <div class="col-lg-3 col-md-4 col-sm-6 portfolio-item">
                                        <div class="card h-100" style="background-color: lightgrey;">
                                            <img class="card-img-top" src='{{url("/storage/products_img/".$zamowienie->getProduct()->filename)}}' alt="">
                                        </div>
                                    </div>
                                    @if($zamowienie->rodzaj == 'ciasteczko')
                                        <div class="section-heading-upper" style="margin-top: 15px;">
                                            <b>{{ $zamowienie->ilosc }}</b>  x <b>{{ $zamowienie->getProduct()->nazwa }}</b> <br>
                                            Paczki wielkości:
                                            @if( $zamowienie->wielkosc  == 0)
                                                <b>{{ '30 szt.' }}</b>
                                                <br>
                                                Termin: <b>{{ $zamowienie->termin }}</b>

                                            @elseif($zamowienie->wielkosc  == 1)
                                                <b>{{ '15 szt.' }}</b>
                                                <br>
                                                Termin: <b>{{ $zamowienie->termin }}</b>

                                            @endif

                                        </div>
                                    @elseif($zamowienie->rodzaj == 'ciasto')
                                        <div class="section-heading-upper" style="margin-top: 15px;">
                                            <b>{{ $zamowienie->ilosc }}</b>  x <b>{{ $zamowienie->getProduct()->nazwa }}</b> <br>
                                            w brytfance wielkości:
                                            @if( $zamowienie->wielkosc  == 0)
                                                <b>{{ '24x37' }}</b>
                                                <br>
                                                Termin: <b>{{ $zamowienie->termin }}</b>

                                            @elseif($zamowienie->wielkosc  == 1)
                                                <b>{{ '17x24' }}</b>
                                                <br>
                                                Termin: <b>{{ $zamowienie->termin }}</b>

                                            @endif

                                        </div>
                                    @endif
                                    @if($zamowienie->status == 'oczekuje')
                                    <div class="col text-center" style="margin-top: 20px;">
                                           <b>Status:</b> {{ $zamowienie->status }}<br>
                                        <div class="intro-button mx-auto" style="margin-top: 5px;">
                                            <a class="btn btn-danger btn-x2" href="{{ route('order.delete', ['id' => $zamowienie->id]) }}">Wycofaj</a>
                                        </div>
                                    </div>
                                        @else
                                        <div class="col text-center" style="margin-top: 20px;">
                                            <b>Status:</b><h4 style="color: green; border: 1px solid green; margin-left: 50px; margin-right: 50px;"> {{ $zamowienie->status }}</h4>

                                        </div>
                                    @endif
                                </div>
                                <div class="row" style="margin-left: 20px; margin-right: 20px;">
                                    <div class="section-heading-upper" style="margin-top: -25px; margin-bottom: 20px;">
                                        <b>Dodatkowe informacje:</b><br>->
                                       {{ $zamowienie->info }}
                                    </div>
                                </div>

                                @endforeach

                        @foreach($torty->where('status', 'zrealizowane') as $tort)
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
                                    @if($tort->cena != null)

                                        @endif
                                </div>

                                @if($tort->status == 'oczekuje')
                                    <div class="col text-center" style="margin-top: 20px;">
                                        <b>Status:</b> {{ $tort->status }}<br>
                                        <div class="intro-button mx-auto" style="margin-top: 5px;">
                                            <a class="btn btn-danger btn-x2" href="{{ route('tort_order.delete', ['id' => $tort->id]) }}">Wycofaj</a>
                                        </div>
                                    </div>
                                @else
                                    <div class="col text-center" style="margin-top: 20px;">
                                        <b>Status:</b><h4 style="color: green; border: 1px solid green; margin-left: 50px; margin-right: 50px;"> {{ $tort->status }}</h4>


                                    </div>
                                @endif
                            </div>
                            <div class="row" style="margin-left: 20px; margin-right: 20px;">
                                <div class="section-heading-upper" style="margin-top: -25px; margin-bottom: 20px;">
                                    <b>Dodatkowe informacje:</b><br>->
                                    {{ $tort->info }}
                                </div>
                            </div>
                        @endforeach

                        <div class="intro-button mx-auto" style="position: relative; margin-top: 20px; z-index: 20;">
                            <a class="btn btn-primary btn-x2" href="{{route('profile.index')}}">Mój profil</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
