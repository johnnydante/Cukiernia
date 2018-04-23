@extends('layout')

@section('content')
    <section class="page-section cta">
        <div class="container">
            <div class="row">
                <div class="col-xl-9 mx-auto">
                    <div class="cta-inner rounded">
                        <h2 class="section-heading mb-5">
                            <span class="section-heading-upper" >Mój koszyk</span>
                        </h2>
                        @if($_POST['koszt']>0)
                        <h3 class="section-heading mb-5" style="margin-bottom: 30px;">
                            <span class="section-heading-upper" style="margin-bottom: 30px;">
                                    Łączny koszt: {{ $_POST['koszt'] }} zł
                            </span>
                        </h3>
                        @endif
                        @if( (Auth::user()->getOrder()->where('status', 'koszyk')->count() == 0) && (Auth::user()->getTort()->where('status', 'koszyk')->count() == 0) && (Auth::user()->getWesele()->where('status', 'koszyk')->count() == 0))

                                <h5>Twój koszyk jest pusty</h5>
                            <div class="intro-button mx-auto text-center"  style=" position: relative; border-top: 1px solid; padding-top: 20px; z-index: 20;">
                                <a class="btn btn-primary btn-x2" href="{{route('profile.index')}}">Mój profil</a>
                            </div>
                            @else
                                @foreach($zamowienia as $zamowienie)
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
                                            <b>{{ '30 szt.' }}</b><br>
                                            Termin: <b>{{ $zamowienie->termin }}</b>
                                            <br>Koszt: <b>{{ $zamowienie->getProduct()->cena*$zamowienie->ilosc }} zł</b>
                                        @elseif($zamowienie->wielkosc  == 1)
                                            <b>{{ '15 szt.' }}</b><br>
                                            Termin: <b>{{ $zamowienie->termin }}</b>
                                            <br>Koszt: <b>{{ $zamowienie->getProduct()->cena_mala*$zamowienie->ilosc }} zł</b>
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
                                                <br>Koszt: <b>{{ $zamowienie->getProduct()->cena*$zamowienie->ilosc }} zł</b>
                                            @elseif($zamowienie->wielkosc  == 1)
                                                <b>{{ '17x24' }}</b>
                                                <br>
                                                Termin: <b>{{ $zamowienie->termin }}</b>
                                                <br>Koszt: <b>{{ $zamowienie->getProduct()->cena_mala*$zamowienie->ilosc }} zł</b>
                                            @endif

                                        </div>
                                    @endif
                                    <div class="col text-center" style="margin-top: 20px;">
                                            <div class="intro-button mx-auto">
                                                <a class="btn btn-primary btn-x2" href="{{ route('order.edit', ['id' => $zamowienie->id]) }}">Edytuj zamówienie</a>
                                            </div>
                                            <div class="intro-button mx-auto" style="margin-top: 5px;">
                                                <a onclick="return confirm('Czy na pewno chcesz usunąć zamówienie z koszyka?')" class="btn btn-danger btn-x2" href="{{ route('order.delete', ['id' => $zamowienie->id]) }}">Usuń z koszyka</a>
                                            </div>
                                    </div>
                                </div>
                                <div class="row" style="margin-left: 20px; margin-right: 20px;">
                                    <div class="section-heading-upper" style="margin-bottom: 20px;">
                                        <b>Dodatkowe informacje:</b> {{ $zamowienie->info }}
                                    </div>
                                </div>
                                @endforeach

                                    @foreach($torty as $tort)
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

                                            <div class="col text-center" style="margin-top: 20px;">
                                                <div class="intro-button mx-auto">
                                                    <a class="btn btn-primary btn-x2" href="{{route('tort_order.edit', ['id' => $tort->id])}}">Edytuj zamówienie</a>
                                                </div>
                                                <div class="intro-button mx-auto" style="margin-top: 5px;">
                                                    <a onclick="return confirm('Czy na pewno chcesz usunąć zamówienie z koszyka?')" class="btn btn-danger btn-x2" href="{{route('tort_order.delete', ['id' => $tort->id])}}">Usuń z koszyka</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" style="margin-left: 20px; margin-right: 20px;">
                                            <div class="section-heading-upper" style="margin-bottom: 20px;">
                                                <b>Dodatkowe informacje:</b> {{ $tort->info }}
                                            </div>
                                        </div>
                                    @endforeach

                                    @foreach($wesela as $wesele)

                                        <div class="row" style="border-top: 1px solid; padding-top: 5px;">

                                            <div class="col-lg-3 col-md-4 col-sm-6 portfolio-item">

                                                @if($wesele->filename != '')
                                                    <div class="card h-100">
                                                        Zdjęcie pomocnicze:
                                                        <img class="card-img-top" src='{{url("/storage/products_img/".$wesele->filename)}}' alt="">
                                                    </div>
                                                @else
                                                    <div class="card h-100" style="min-height: 130px; opacity: 0;">
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


                                            <div class="col text-center" style="margin-top: 20px;">
                                                <div class="intro-button mx-auto">
                                                    <a class="btn btn-primary btn-x2" href="{{route('zamowWesele.edit', ['id' => $wesele->id])}}">Edytuj zamówienie</a>
                                                </div>
                                                <div class="intro-button mx-auto" style="margin-top: 5px;">
                                                    <a onclick="return confirm('Czy na pewno chcesz usunąć zamówienie z koszyka?')" class="btn btn-danger btn-x2" href="{{route('wesele.delete', ['id' => $wesele->id])}}">Usuń z koszyka</a>
                                                </div>
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

                            <div class="intro-button mx-auto text-center"  style=" position: relative; border-top: 1px solid; padding-top: 20px; z-index: 20;">
                                <a class="btn btn-primary btn-x2" href="{{route('profile.index')}}">Mój profil</a>
                                <a class="btn btn-success btn-x2" href="{{route('koszyk.update')}}">Złóż zamówienie!</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
