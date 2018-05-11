@extends('layout')

@section('content')
    <style>
        .img-fluid {
            border-radius: 50px!important;
        }
        .bg-faded {
            border-radius: 50px!important;
        }

    </style>

    <section class="page-section about-heading">
        <div class="container">
            <img class="img-fluid rounded about-heading-img mb-3 mb-lg-0" src="{{url("/temp/img/about.jpg")}}" alt="" >
            <div class="about-heading-content">
                <div class="row">
                    <div class="col-xl-9 col-lg-10 mx-auto">
                        <div class="bg-faded rounded p-5">
                            <h2 class="section-heading mb-4">
                                <span class="section-heading-upper">słodkie domowe receptury</span>
                                <span class="section-heading-lower">Poznaj naszą pasję</span>
                            </h2>
                            <p>Pieczenie tortów, ciast i różnorodnych słodkości stało się naszą pasją wiele lat temu, kiedy to najbliżsi przyjaciele po raz pierwszy próbowali naszych drobnych domowych wypieków i jak zawsze po takich degustacjach bez wyjątku prosili o więcej. Wtedy zrozumieliśmy, że trzeba to robić dla wszytkich!</p>
                            <p class="mb-0">Ostatnie lata pracy przy pieczeniu i dekorowaniu tortów można nazwać już tylko i wyłącznie doskonaleniem kunsztu. Dzięki opini naszych klientów, której zawsze oczekujemuy o realizacji zamówienia, stale doskonalimy receptury smakowe i konsystencjonalne, dlatego możemy Ci zapewnić gwarancję jakości, smaku i przede wszystkim pełni naturalnych składników, ponieważ nasze produkty są robiony tylko na najzdrowszych i naturalnych składnikach, a właśnie może to jest ich sekret <i class="far fa-smile"></i></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection