@extends('layout')

@section('content')
    <section class="page-section cta">
        <div class="container">
            <div class="row">
                <div class="col-xl-9 mx-auto">
                    <div class="cta-inner rounded">
                        <h2 class="section-heading mb-5">
                            <span class="section-heading-upper" style="margin-bottom: 30px;">Dodaj produkt - ciasto</span>
                        </h2>
                        @if (session('status'))
                            <div class="alert alert-danger">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="container" style="position: relative; max-width: 700px; z-index: 25; color: #d77d00">
                            {!! Form::open(['route' => 'product.store', 'files' => true]) !!}

                            @if($errors->any())
                                @foreach ($errors->all() as $error)
                                    <div class="btn btn-danger">{{ $error }}</div>
                                @endforeach
                            @endif

                            <div class="form-group">
                                {!! Form::label('nazwa', "Nazwa produktu:") !!}
                                {!! Form::text('nazwa', null, ['class' => 'form-control']) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('cena', "Cena za brytfankę 24x37:") !!}
                                {!! Form::number('cena', null, ['class' => 'form-control']) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('cena_mala', "Cena za brytfankę 17x24:") !!}
                                {!! Form::number('cena_mala', null, ['class' => 'form-control']) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('description', "Opis:") !!}
                                {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('filename', "Zdjęcie:") !!}
                                {!! Form::file('filename', null, ['class' => 'form-control']) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::submit('Zapisz', ['class' => 'btn btn-success']) !!}
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