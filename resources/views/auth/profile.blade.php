@extends('layout')

@section('content')
    <section class="page-section cta">
        <div class="container">
            <div class="row">
                <div class="col-xl-9 mx-auto">
                    <div class="cta-inner rounded">

                            <div class="intro-button mx-auto" style="position: absolute; top: 50px; right: 50px;">
                                <a class="btn btn-outline-primary btn-x2" href="{{route('zamowienia.show')}}">Moje zamówienia
                                    @if( (Auth::user()->getOrder()->whereIn('status', ['oczekuje', 'w realizacji'])->count() >0) || Auth::user()->getTort()->whereIn('status', ['oczekuje', 'w realizacji'])->count() >0 || Auth::user()->getWesele()->whereIn('status', ['oczekuje', 'w realizacji'])->count() >0)
                                        ({{ Auth::user()->getOrder()->whereIn('status', ['oczekuje', 'w realizacji'])->count()+ Auth::user()->getTort()->whereIn('status', ['oczekuje', 'w realizacji'])->count() + Auth::user()->getWesele()->whereIn('status', ['oczekuje', 'w realizacji'])->count()}})
                                    @endif
                                </a>
                            </div>

                            <div class="intro-button mx-auto" style="position: absolute; top: 110px; right: 50px; z-index: 10;">
                                <a class="btn btn-outline-success btn-x2" href="{{route('koszyk.index')}}">Koszyk <i class="fas fa-cart-arrow-down"></i>
                                    @if( (Auth::user()->getOrder()->where('status', 'koszyk')->count() >0) || Auth::user()->getTort()->where('status', 'koszyk')->count() >0 || Auth::user()->getWesele()->where('status', 'koszyk')->count() >0)
                                        ({{ Auth::user()->getOrder()->where('status', 'koszyk')->count()+ Auth::user()->getTort()->where('status', 'koszyk')->count() +  Auth::user()->getWesele()->where('status', 'koszyk')->count()}})
                                    @endif
                                </a>
                            </div>

                        <h2 class="section-heading mb-5">
                            <span class="section-heading-upper">Mój profil</span>
                        </h2>
                        <div style="position:relative; z-index: 1;">
                            <div class="row">
                                <ul class="list-group">
                                    <p>Imię i nazwisko: <li class="list-group-item list-group-item-warning">{{ Auth::user()->name }} {{ Auth::user()->surname }}</li></p>
                                    <p>Numer telefonu: <li class="list-group-item list-group-item-warning">{{ Auth::user()->tel }}</li></p>
                                    <p>Adres e-mail: <li class="list-group-item list-group-item-warning">{{ Auth::user()->email }}</li></p>
                                </ul>
                            </div>
                            <div class="row" style="margin-top: 30px;">
                                <div class="intro-button mx-auto">
                                    <a class="btn btn-warning btn-x2" href="{{route('profile.edit',[Auth::user()->id])}}">Edytuj profil</a>
                                </div>
                                <div class="intro-button mx-auto">
                                    <a class="btn btn-info btn-x2" href="{{route('password.change',[Auth::user()->id])}}">Zmień hasło</a>
                                </div>
                                <div class="intro-button mx-auto" style="">
                                    <a onclick="return confirm('Czy na pewno chcesz usunąć swój profil?')" class="btn btn-danger btn-x2" href="{{route('user.delete',[Auth::user()->id])}}">Usuń profil</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


