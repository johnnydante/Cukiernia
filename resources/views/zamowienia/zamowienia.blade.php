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
                        @if($_POST['koszt_oczekuje']>0 || $_POST['koszt_tortow_oczekuje']>0 || $_POST['koszt_wesel_oczekuje']>0)
                            <h3 class="section-heading mb-5" style="margin-bottom: 30px;">
                            <span class="section-heading-upper" style="margin-bottom: 30px;">

                                     Łączny koszt:
                                {{ floor($_POST['koszt_oczekuje'])+$_POST['koszt_tortow_oczekuje']+$_POST['koszt_wesel_oczekuje'] }} zł
                                {{ round(($_POST['koszt_oczekuje']-floor($_POST['koszt_oczekuje']))*100) }} gr

                            </span>
                            </h3>
                        @endif

                            <div class="row" style="margin-bottom: 30px; margin-top: -50px;">
                                <div class="intro-button mx-auto" style="position: relative; margin-top: 20px; z-index: 20;">
                                    <a class="btn btn-outline-danger btn-x2" href="{{route('zamowienia.show')}}">Oczekujące
                                        @if( ($zamowienia->where('status', 'oczekuje')->count() >0) ||
                                        $torty->where('status', 'oczekuje')->count() >0 ||
                                        $wesela->where('status', 'oczekuje')->count() >0)
                                            ({{ $zamowienia->where('status', 'oczekuje')->count()+
                                            $torty->where('status', 'oczekuje')->count() +
                                            $wesela->where('status', 'oczekuje')->count()}})
                                        @endif
                                    </a>
                                </div>
                                <div class="intro-button mx-auto" style="position: relative; margin-top: 20px; z-index: 20;">
                                    <a class="btn btn-outline-info btn-x2" href="{{route('wRealizacji.show')}}">W realizacji
                                        @if( ($zamowienia->where('status', 'w realizacji')->count() >0) ||
                                        $torty->where('status', 'w realizacji')->count() >0 ||
                                        $wesela->where('status', 'w realizacji')->count() >0)
                                            ({{ $zamowienia->where('status', 'w realizacji')->count()+
                                            $torty->where('status', 'w realizacji')->count() +
                                            $wesela->where('status', 'w realizacji')->count()}})
                                        @endif
                                    </a>
                                </div>
                                <div class="intro-button mx-auto" style="position: relative; margin-top: 20px; z-index: 20;">
                                    <a class="btn btn-outline-success btn-x2" href="{{route('skonczone.show')}}">Zrealizowane
                                    </a>
                                </div>
                            </div>

                                @foreach($zamowienia->where('status', 'oczekuje') as $zamowienie)
                                <div class="row" style="border-top: 1px solid; padding-top: 5px;">
                                    <div class="col-lg-3 col-md-4 col-sm-6 portfolio-item">
                                        <div class="card h-100" style="background-color: lightgrey;">
                                            <img class="card-img-top" src='{{url("/storage/products_img/".$zamowienie->getProduct()->filename)}}' alt="">
                                        </div>
                                    </div>

                                    @if($zamowienie->rodzaj == 'ciasteczko')
                                        <div class="section-heading-upper" style="margin-top: 15px;">
                                            <b>{{ $zamowienie->ilosc }}</b>  x <b>{{ $zamowienie->getProduct()->nazwa }}</b> <br>
                                            Termin: <b>{{ $zamowienie->termin }}</b><br>
                                            Koszt: <b>{{ floor(($zamowienie->getProduct()->cena*$zamowienie->ilosc)/100) }} zł
                                                {{ round((($zamowienie->getProduct()->cena*$zamowienie->ilosc)/100 -
                                                 floor(($zamowienie->getProduct()->cena*$zamowienie->ilosc)/100))*100) }} gr</b>
                                        </div>
                                    @elseif($zamowienie->rodzaj == 'ciasto')
                                        <div class="section-heading-upper" style="margin-top: 15px;">
                                            <b>{{ $zamowienie->ilosc }}</b>  x <b>{{ $zamowienie->getProduct()->nazwa }}</b> <br>
                                            w brytfance wielkości: <b>{{ $zamowienie->wielkosc }}</b><br>
                                            Termin: <b>{{ $zamowienie->termin }}</b><br>
                                            Koszt: <b>{{ $zamowienie->getProduct()->cena_mala*$zamowienie->ilosc }} zł</b>
                                        </div>
                                    @elseif($zamowienie->rodzaj == 'inne')
                                        <div class="section-heading-upper" style="margin-top: 15px;">
                                            <b>{{ $zamowienie->ilosc }}</b>  x <b>{{ $zamowienie->getProduct()->nazwa }}</b> <br>
                                            Termin: <b>{{ $zamowienie->termin }}</b><br>
                                            Koszt: <b>{{ $zamowienie->getProduct()->cena*$zamowienie->ilosc }} zł</b>
                                        </div>
                                    @endif

                                    @if($zamowienie->status == 'oczekuje')
                                    <div class="col text-center" style="margin-top: 20px;">
                                           <b>Status:</b> {{ $zamowienie->status }}<br>
                                        <div class="intro-button mx-auto" style="margin-top: 5px;">
                                            <a onclick="return confirm('Czy na pewno chcesz wycofać zamówienie?')" class="btn btn-danger btn-x2" href="{{ route('order.delete', ['id' => $zamowienie->id]) }}">Wycofaj</a>
                                        </div>
                                    </div>
                                        @else
                                        <div class="col text-center" style="margin-top: 20px;">
                                            <b>Status:</b><h4 style="color: green; border: 1px solid green; margin-left: 50px; margin-right: 50px;"> {{ $zamowienie->status }}</h4>

                                        </div>
                                    @endif
                                </div>
                                <div class="row" style="margin-left: 20px; margin-right: 20px;">
                                    <div class="section-heading-upper" style="margin-bottom: 20px;">
                                        <b>Dodatkowe informacje:</b>
                                       {{ $zamowienie->info }}
                                    </div>
                                </div>

                                @endforeach

                        @foreach($torty->where('status', 'oczekuje') as $tort)
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
                                    Smak: <b>{{ $tort->smak }}</b><br>
                                    Rodzaj dekoracji: <b>{{ $tort->rodzaj_dekoracji }}</b> <br>
                                    Rodzaj masy w torcie:<b> {{ $tort->rodzaj_masy }} </b><br>
                                    Termin: <b>{{ $tort->termin }}</b><br>
                                    @if($tort->cena != null)
                                        Koszt: <b>{{ $tort->cena }}</b> zł
                                    @endif
                                </div>

                                @if($tort->status == 'oczekuje')
                                    <div class="col text-center" style="margin-top: 20px;">
                                        <b>Status:</b> {{ $tort->status }}<br>
                                        <div class="intro-button mx-auto" style="margin-top: 5px;">
                                            <a onclick="return confirm('Czy na pewno chcesz wycofać zamówienie?')"
                                               class="btn btn-danger btn-x2" href="{{ route('tort_order.delete', ['id' => $tort->id]) }}">
                                                Wycofaj
                                            </a>
                                        </div>
                                    </div>
                                @else
                                    <div class="col text-center" style="margin-top: 20px;">
                                        <b>Status:</b><h4 style="color: green; border: 1px solid green; margin-left: 50px; margin-right: 50px;"> {{ $tort->status }}</h4>
                                    </div>
                                @endif
                            </div>
                            <div class="row" style="margin-left: 20px; margin-right: 20px;">
                                <div class="section-heading-upper" style="margin-bottom: 20px;">
                                    <b>Dodatkowe informacje:</b>
                                    {{ $tort->info }}
                                </div>
                            </div>
                        @endforeach

                        @foreach($wesela->where('status', 'oczekuje') as $wesele)
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
                                </div>
                                @if($wesele->status == 'oczekuje')
                                    <div class="col text-center" style="margin-top: 20px;">
                                        <b>Status:</b> {{ $wesele->status }}<br>
                                        <div class="intro-button mx-auto" style="margin-top: 5px;">
                                            <a onclick="return confirm('Czy na pewno chcesz wycofać zamówienie?')"
                                               class="btn btn-danger btn-x2" href="{{ route('wesele.delete', ['id' => $wesele->id]) }}">
                                                Wycofaj
                                            </a>
                                        </div>
                                    </div>
                                @else
                                    <div class="col text-center" style="margin-top: 20px;">
                                        <b>Status:</b><h4 style="color: green; border: 1px solid green; margin-left: 50px; margin-right: 50px;"> {{ $wesele->status }}</h4>
                                    </div>
                                @endif
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
                        <div class="intro-button mx-auto" style="position: relative; margin-top: 20px; z-index: 20;">
                            <a class="btn btn-primary btn-x2" href="{{route('profile.index')}}">Mój profil</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
