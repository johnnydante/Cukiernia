<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Copyright (c) 2013-2018 Blackrock Digital LLC

    Permission is hereby granted, free of charge, to any person obtaining a copy
    of this software and associated documentation files (the "Software"), to deal
    in the Software without restriction, including without limitation the rights
    to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
    copies of the Software, and to permit persons to whom the Software is
    furnished to do so, subject to the following conditions:

    The above copyright notice and this permission notice shall be included in
    all copies or substantial portions of the Software.

    THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
    IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
    FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
    AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
    LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
    OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
    THE SOFTWARE. -->

    <!-- Copyright (c) 2015 Adam Shaw

    Permission is hereby granted, free of charge, to any person obtaining
    a copy of this software and associated documentation files (the
    "Software"), to deal in the Software without restriction, including
    without limitation the rights to use, copy, modify, merge, publish,
    distribute, sublicense, and/or sell copies of the Software, and to
    permit persons to whom the Software is furnished to do so, subject to
    the following conditions:

    The above copyright notice and this permission notice shall be
    included in all copies or substantial portions of the Software.

    THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
    EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
    MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
    NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE
    LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION
    OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION
    WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE. -->

    <!-- Copyright (c) 2014 David Bushell BSD & MIT license

    The MIT License (MIT)

    Copyright (c) 2014 David Bushell

    Permission is hereby granted, free of charge, to any person obtaining a copy
    of this software and associated documentation files (the "Software"), to deal
    in the Software without restriction, including without limitation the rights
    to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
    copies of the Software, and to permit persons to whom the Software is
    furnished to do so, subject to the following conditions:

    The above copyright notice and this permission notice shall be included in
    all copies or substantial portions of the Software.

    THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
    IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
    FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
    AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
    LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
    OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
    THE SOFTWARE.

    The BSD License

    Copyright (c) 2014 David Bushell
    All rights reserved.

    Redistribution and use in source and binary forms, with or without modification, are permitted provided that the following conditions are met:

    1. Redistributions of source code must retain the above copyright notice, this list of conditions and the following disclaimer.

    2. Redistributions in binary form must reproduce the above copyright notice, this list of conditions and the following disclaimer in the documentation and/or other materials provided with the distribution.

    THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE. -->

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Cukiernia</title>

    <!-- Bootstrap core CSS -->
    <link href="{{url("/temp/vendor/bootstrap/css/bootstrap.min.css")}}" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{url("/temp/css/business-casual.min.css")}}" rel="stylesheet">

    <!-- Custom styles for products -->
    <link href="{{url("/temp/css/4-col-portfolio.css")}}" rel="stylesheet">

    <!-- font awesome -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.8/js/all.js" integrity="sha384-SlE991lGASHoBfWbelyBPLsUlwY1GwNDJo3jSJO04KZ33K2bwfV9YBauFfnzvynJ" crossorigin="anonymous"></script>

    <link href="{{url("/css/pikaday.css")}}" rel="stylesheet">
    <link href="{{url("/css/theme.css")}}" rel="stylesheet">

    <link href="{{url("/css/fullcalendar.css")}}" rel="stylesheet">


</head>

<body>

<h1 class="site-heading text-center text-white d-none d-lg-block">
    <span class="site-heading-lower mb-3">Cukiernia</span>
    <span class="site-heading-upper text-primary">słodkości nigdy za wiele</span>

</h1>
@guest
    <li><a class="btn btn-outline-warning btn-x2" style="position: absolute; top: 30px; right: 40px;" href="{{ route('login') }}">{{ __('Logowanie') }}</a></li>
    <li><a class="btn btn-outline-warning btn-x2" style="position: absolute; top: 80px; right: 40px;" href="{{ route('register') }}">{{ __('Rejestracja') }}</a></li>
@else
    <li>

        <a class="btn btn-outline-warning btn-x2" style="position: absolute; top: 30px; right: 40px;"
           href="{{ route('profile.index') }}">Mój profil</a>
    </li>
    <a class="btn btn-outline-danger btn-x2" style="position: absolute; top: 80px; right: 40px;" href="{{ route('logout') }}"
        onclick="event.preventDefault();
        document.getElementById('logout-form').submit();">
    {{ __('Wyloguj') }}
    </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
             @csrf
        </form>
    <div class="intro-button mx-auto" style="position: absolute; top: 30px; right: 170px;">
        <a class="btn btn-outline-success btn-x2" href="{{route('koszyk.index')}}">Koszyk <i class="fas fa-cart-arrow-down"></i>
            @if( Auth::user()->getOrder()->where('status', 'koszyk')->count() >0)
                ({{ Auth::user()->getOrder()->where('status', 'koszyk')->count() }})
            @endif
        </a>
    </div>
@endguest

<!-- Navigation -->
@if(Auth::check() and Auth::user()->isAdmin())
    <nav class="navbar navbar-expand-lg navbar-dark py-lg-4" id="mainNav">
        <div class="container">
            <a class="navbar-brand text-uppercase text-expanded font-weight-bold d-lg-none" href="{{route('home')}}">Cukiernia</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item px-lg-4 {{ (request()->routeIs(['home','register'])) ? 'active': ''}}">
                        <a class="nav-link text-uppercase text-expanded" href="{{route('home')}}">Strona główna</a>
                    </li>
                    <li class="nav-item px-lg-4 {{ (request()->routeIs('about.index')) ? 'active': ''}}">
                        <a class="nav-link text-uppercase text-expanded" href="{{route('about.index')}}">O nas</a>
                    </li>
                    <li class="nav-item px-lg-4 {{ (request()->routeIs(['products.index','product.index'])) ? 'active': ''}}">
                        <a class="nav-link text-uppercase text-expanded" href="{{route('products.index')}}">Produkty</a>
                    </li>
                    <li class="nav-item px-lg-4 {{ (request()->routeIs('contact.index', 'contact.postContact')) ? 'active': ''}}">
                        <a class="nav-link text-uppercase text-expanded" href="{{route('contact.index')}}">Kontakt</a>
                    </li>
                    <li class="nav-item px-lg-4 {{ (request()->routeIs('gallery.index')) ? 'active': ''}}">
                        <a class="nav-link text-uppercase text-expanded" href="{{route('gallery.index')}}">Galeria tortów</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <nav class="navbar navbar-expand-lg navbar-light py-lg-4" id="mainNav" style="background-color: darkolivegreen;">
        <div class="container" >
            <a class="navbar-brand text-uppercase text-expanded font-weight-bold d-lg-none" href="{{route('home')}}">Cukiernia</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon" ></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav mx-auto">

                    <li class="nav-item px-lg-4 {{ (request()->routeIs('users.index')) ? 'active': ''}}" >
                        <a class="nav-link text-uppercase text-expanded" href="{{route('users.index')}}">Użytkownicy</a>
                    </li>
                    <li class="nav-item px-lg-4 {{ (request()->routeIs('order.index')) ? 'active': ''}}">
                        <a class="nav-link text-uppercase text-expanded" href="{{route('order.index')}}">Zamówienia</a>
                    </li>
                    <li class="nav-item px-lg-4 {{ (request()->routeIs('kalendarz.index')) ? 'active': ''}}">
                        <a class="nav-link text-uppercase text-expanded" href="{{route('kalendarz.index')}}">Kalendarz zamówień</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
@else
    <nav class="navbar navbar-expand-lg navbar-dark py-lg-4" id="mainNav">
        <div class="container">
            <a class="navbar-brand text-uppercase text-expanded font-weight-bold d-lg-none" href="{{route('home')}}">Cukiernia</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item px-lg-4 {{ (request()->routeIs(['home','register'])) ? 'active': ''}}">
                        <a class="nav-link text-uppercase text-expanded" href="{{route('home')}}">Strona główna</a>
                    </li>
                    <li class="nav-item px-lg-4 {{ (request()->routeIs('about.index')) ? 'active': ''}}">
                        <a class="nav-link text-uppercase text-expanded" href="{{route('about.index')}}">O nas</a>
                    </li>
                    <li class="nav-item px-lg-4 {{ (request()->routeIs(['products.index','product.index'])) ? 'active': ''}}">
                        <a class="nav-link text-uppercase text-expanded" href="{{route('products.index')}}">Produkty</a>
                    </li>
                    <li class="nav-item px-lg-4 {{ (request()->routeIs('contact.index', 'contact.postContact')) ? 'active': ''}}">
                        <a class="nav-link text-uppercase text-expanded" href="{{route('contact.index')}}">Kontakt</a>
                    </li>
                    <li class="nav-item px-lg-4 {{ (request()->routeIs('gallery.index')) ? 'active': ''}}">
                        <a class="nav-link text-uppercase text-expanded" href="{{route('gallery.index')}}">Galeria tortów</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    @endif

@yield('content')

<footer class="footer text-faded text-center py-5">
    <div class="container">
        <p class="m-0 small">
            Copyright &copy; Cukiernia 2018
        </p>
    </div>
</footer>


<!-- Bootstrap core JavaScript -->
<script src="{{url("/temp/vendor/jquery/jquery.min.js")}}"></script>
<script src="{{url("/temp/vendor/bootstrap/js/bootstrap.bundle.min.js")}}"></script>

    <script src="{{url("/js/moment.js")}}"></script>
    <script src="{{url("/js/pikaday.js")}}"></script>
    <script>
        var picker = new Pikaday({
            field: document.getElementById('datepicker'),
            firstDay: 1,
            format: 'YYYY-MM-DD',
            minDate: new Date('1900-01-01'),
            maxDate: new Date('2040-12-31'),
            yearRange: [1900, 2040]
        });

    </script>
    <script>
        var picker = new Pikaday({
            field: document.getElementById('datepicker2'),
            firstDay: 1,
            format: 'YYYY-MM-DD',
            minDate: new Date('1900-01-01'),
            maxDate: new Date('2040-12-31'),
            yearRange: [1900, 2040]
        });

    </script>

    <script src="{{url("/js/fullcalendar.js")}}"></script>
    <script>
        $(function() {

            // page is now ready, initialize the calendar...

            $('#calendar').fullCalendar({
                // put your options and callbacks here
                left:   'title',
                center: 'prevYear nextYear',
                right:  'today prev,next'
            })

        });
    </script>

</body>

</html>
