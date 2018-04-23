@extends('layout')

@section('content')


    <section class="page-section cta">
        <div class="container">
            <div class="row">
                <div class="col-xl-9 mx-auto">
                    <div class="cta-inner rounded">
                        <h2 class="section-heading mb-5">
                            <span class="section-heading-upper">Masz jakieś pytania?</span>
                            <span class="section-heading-lower">Skontaktuj się z nami</span>
                        </h2>
                        <div style="position:relative; z-index: 1;">
                            {!! Form::open(['route' => 'contact.postContact', 'method' => 'POST']) !!}

                            @if($errors->any())
                                @foreach ($errors->all() as $error)
                                    <div class="btn btn-danger">{{ $error }}</div>
                                @endforeach
                            @endif

                            <div class="form-group">
                                {!! Form::label('imie', "Imię:") !!}
                                @auth
                                {!! Form::text('imie', Auth::user()->name, ['class' => 'form-control']) !!}
                                    @else
                                    {!! Form::text('imie', null, ['class' => 'form-control']) !!}
                                @endauth
                            </div>

                            <div class="form-group">
                                {!! Form::label('nazwisko', "Nazwisko:") !!}
                                @auth
                                {!! Form::text('nazwisko', Auth::user()->surname, ['class' => 'form-control']) !!}
                                    @else
                                    {!! Form::text('nazwisko', null, ['class' => 'form-control']) !!}
                                @endauth
                            </div>

                            <div class="form-group">
                                {!! Form::label('wiadomosc', "Wiadomość:") !!}
                                {!! Form::textarea('wiadomosc', null, ['class' => 'form-control']) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('tel', "Numer telefonu:") !!}
                                @auth
                                    {!! Form::text('tel', Auth::user()->tel, ['class' => 'form-control']) !!}
                                @else
                                    {!! Form::text('tel', null, ['class' => 'form-control']) !!}
                                @endauth
                            </div>

                            <div class="form-group">
                                {!! Form::label('email', "Twój email:") !!}
                                @auth
                                    {!! Form::email('email', Auth::user()->email, ['class' => 'form-control']) !!}
                                @else
                                   {!! Form::email('email', null, ['class' => 'form-control']) !!}
                                @endauth
                            </div>

                            <div class="form-group">
                                {!! Form::submit('Wyślij', ['class' => 'btn btn-primary']) !!}
                            </div>

                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection

