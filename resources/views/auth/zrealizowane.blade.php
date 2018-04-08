@extends('layout')

@section('content')
    <section class="page-section cta">
        <div class="container">
            <div class="row">
                <div class="col-xl-9 mx-auto">
                    <div class="cta-inner rounded">
                        <h2 class="section-heading mb-5">
                            <span class="section-heading-upper" style="margin-bottom: 30px;">Moje zamowienia -
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
                                    @if( $orders->where('status', 'oczekuje')->count() >0)
                                        ({{ $orders->where('status', 'oczekuje')->count() }})
                                    @endif
                                </a>
                            </div>
                            <div class="intro-button mx-auto" style="position: relative; margin-top: 20px; z-index: 20;">
                                <a class="btn btn-outline-info btn-x2" href="{{route('order.index_wTrakcie')}}">W realizacji
                                    @if( $orders->where('status', 'w realizacji')->count() >0)
                                        ({{ $orders->where('status', 'w realizacji')->count() }})
                                    @endif
                                </a>
                            </div>
                            <div class="intro-button mx-auto" style="position: relative; margin-top: 20px; z-index: 20;">
                                <a class="btn btn-outline-success btn-x2" href="{{route('order.index_zrealizowane')}}">Zrealizowane
                                </a>
                            </div>
                        </div>
                        @foreach($orders->where('status', 'zrealizowane') as $order)
                            <b> {{$order->getUser()->name}} {{$order->getUser()->surname}} - {{$order->getUser()->email}} - tel: {{$order->getUser()->tel}}</b>
                            <div class="row" style="border-top: 1px solid; padding-top: 5px; text-align: center;">

                                <div class="col-lg-3 col-md-4 col-sm-6 portfolio-item">
                                    <div class="card h-100" style="background-color: lightgrey;">
                                        <img class="card-img-top" src='{{url("/storage/products_img/".$order->getProduct()->filename)}}' alt="">
                                    </div>
                                </div>
                                <div class="section-heading-upper" style="margin-top: 15px;">
                                    <b>{{ $order->ilosc }}</b>  x <b>{{ $order->getProduct()->nazwa }}</b> <br>
                                    w brytfance wielkości:
                                    @if( $order->wielkosc  == 0)
                                        <b>{{ '24x37' }}</b>
                                    @elseif($order->wielkosc  == 1)
                                        <b>{{ '17x24' }}</b>
                                    @endif
                                    <br>
                                    Termin: <b>{{ $order->termin }}</b>
                                </div>
                                <div class="col text-center" style="margin-top: 20px;">
                                    <b>Status:</b> <h4 style="color: green; border: 1px solid green; margin-left: 50px; margin-right: 50px;"> {{ $order->status }}</h4>

                                </div>
                            </div>
                            <div class="row" style="margin-left: 20px; margin-right: 20px;">
                                <div class="section-heading-upper" style="margin-top: -25px; margin-bottom: 20px;">
                                    <b>Dodatkowe informacje:</b><br>->
                                    {{ $order->info }}
                                </div>
                            </div>
                        @endforeach
                        {{$orders->links()}}

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
