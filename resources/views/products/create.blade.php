@extends('layout')

@section('content')

<div class="container">
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
        {!! Form::label('cena', "Cena:") !!}
        {!! Form::number('cena', null, ['class' => 'form-control']) !!}
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
        {!! Form::submit('Zapisz', ['class' => 'btn btn-primary']) !!}
        {!! link_to(URL::previous(),'Powrót', ['class' => 'btn btn-primary']) !!}
    </div>

    {!! Form::close() !!}
</div>


@endsection