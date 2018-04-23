@extends('layout')

@section('content')

    <style>
        .intro-img {
            border-radius: 50px!important;
        }
        .intro-text {
            border-radius: 20px!important;
        }

    </style>


    <section class="page-section clearfix">
        <div class="container">
            <div class="intro">
                <img class="intro-img img-fluid mb-3 mb-lg-0 rounded" src="{{"/temp/img/intro.jpg"}}" alt="">
                <div class="intro-text left-0 text-center bg-faded p-5 rounded">
                    <h2 class="section-heading mb-4">
                        <span class="section-heading-upper">Słodkie wesela</span>
                        <span class="section-heading-lower">Miłości na nowej drodze </span>
                    </h2>
                    <p class="mb-3">Z nami każde wesele nabierze nowego wymiaru słodkości! Przepyszne ciasta i wspaniały tort weselny zostną w pamięci wszystkich gości na zawsze - jak miłość młodej pary!
                    </p>
                    <div class="intro-button mx-auto">
                        <a class="btn btn-primary btn-xl" href="{{route('wesele.index')}}">Zamów już dziś!</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="page-section cta">
        <div class="container">
            <div class="row">
                <div class="col-xl-9 mx-auto">
                    <div class="cta-inner text-center rounded">
                        <h2 class="section-heading mb-4">
                            <span class="section-heading-upper">Torty na każdą okazję</span>
                            <span class="section-heading-lower">Specjalnie dla Ciebie</span>
                        </h2>
                        <p class="mb-0">Chcesz komuś sprawić niesamowitą i jednocześnie wyśmienitą niespodziankę na urodziny lub dowolną inną okazję? A może po prostu masz ochotę na tradycyjny tort dla całej rodziny? Nieważne jaka okazja, dla Ciebie zrobimy tort jaki sobie tylko zażyczysz i włożymy w to całe nasze serca, bo dla nas cukiernictwo to pasja!</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection