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

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Cukiernia - Igraszki u Grażki</title>

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

</head>

<body>

<h1 class="site-heading text-center text-white d-none d-lg-block">
    <span class="site-heading-lower mb-3">Wypieki babci Grażynki</span>
    <span class="site-heading-upper text-primary">słodkości nigdy za wiele</span>

</h1>
@auth()
    <a class="btn btn-danger btn-x2" style="position: absolute; top: 30px; right: 40px;" href="{{ route('logout') }}"
       onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
        {{ __('Wyloguj') }}
    </a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
@endif
<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark py-lg-4" id="mainNav">
    <div class="container">
        <a class="navbar-brand text-uppercase text-expanded font-weight-bold d-lg-none" href="#">Start Bootstrap</a>
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
                <li class="nav-item px-lg-4 {{ (request()->routeIs('contact.index')) ? 'active': ''}}">
                    <a class="nav-link text-uppercase text-expanded" href="{{route('contact.index')}}">Kontakt</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
@yield('content')


<footer class="footer text-faded text-center py-5">
    <div class="container">
        <p class="m-0 small">
            Copyright &copy;
            <a href="{{route('login')}}">
               Cukiernia - Igraszki u Grażki
            </a> 2018
        </p>
    </div>
</footer>

<!-- Bootstrap core JavaScript -->
<script src="{{url("/temp/vendor/jquery/jquery.min.js")}}"></script>
<script src="{{url("/temp/vendor/bootstrap/js/bootstrap.bundle.min.js")}}"></script>

</body>

</html>
