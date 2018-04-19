@extends('layout')

@section('content')
    <section class="page-section cta">
        <div class="container">
            <div class="row">
                <div class="col-xl-9 mx-auto">
                    <div class="cta-inner rounded">
                        <h2 class="section-heading mb-5">
                            <span class="section-heading-upper" style="margin-bottom: 30px;">Dodaj kategorię tortu</span>
                        </h2>
                        <div class="container" style="position: relative; max-width: 700px; z-index: 25;">
                            {!! Form::open(['route' => 'tort.store', 'files' => true]) !!}

                            @if($errors->any())
                                @foreach ($errors->all() as $error)
                                    <div class="btn btn-danger">{{ $error }}</div>
                                @endforeach
                            @endif

                            <div class="form-group">
                                {!! Form::label('nazwa', "Nazwa kategorii:") !!}
                                {!! Form::text('nazwa', null, ['class' => 'form-control']) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('opis', "Opis:") !!}
                                {!! Form::textarea('opis', null, ['class' => 'form-control']) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('filename', "Zdjęcie:") !!}
                                {!! Form::file('filename', null, ['class' => 'form-control']) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::submit('Zapisz', ['class' => 'btn btn-primary']) !!}
                                {!! link_to(URL::previous(),'Powrót', ['class' => 'btn btn-primary']) !!}
                            </div>

                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection