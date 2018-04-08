@extends('layout')

@section('content')
    <section class="page-section cta">
        <div class="container">
            <div class="row">
                <div class="col-xl-9 mx-auto">
                    <div class="cta-inner rounded">
                        <h2 class="section-heading mb-5">
                            <span class="section-heading-upper" style="margin-bottom: 30px;">Moje zamowienia</span>
                        </h2>

                                @foreach($zamowienia as $zamowienie)
                                <div class="row" style="border-top: 1px solid; padding-top: 5px;">
                                    <div class="col-lg-3 col-md-4 col-sm-6 portfolio-item">
                                        <div class="card h-100" style="background-color: lightgrey;">
                                            <img class="card-img-top" src='{{url("/storage/products_img/".$zamowienie->getProduct()->filename)}}' alt="">
                                        </div>
                                    </div>
                                    <div class="section-heading-upper" style="margin-top: 15px;">
                                        <b>{{ $zamowienie->ilosc }}</b>  x <b>{{ $zamowienie->getProduct()->nazwa }}</b> <br>
                                        w brytfance wielkości:
                                        @if( $zamowienie->wielkosc  == 0)
                                            <b>{{ '24x37' }}</b>
                                        @elseif($zamowienie->wielkosc  == 1)
                                            <b>{{ '17x24' }}</b>
                                        @endif
                                        <br>
                                        Termin: <b>{{ $zamowienie->termin }}</b>
                                    </div>
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

                        <div class="intro-button mx-auto" style="position: relative; margin-top: 20px; z-index: 20;">
                            <a class="btn btn-primary btn-x2" href="{{route('profile.index')}}">Powrót</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
