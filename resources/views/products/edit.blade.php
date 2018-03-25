@extends('layout')

@section('content')

    <div class="container">
        {!! Form::model($products, ['route' => ['product.update', $products->id], 'method' => 'POST']) !!}

        @if($errors->any())
            @foreach ($errors->all() as $error)
                <div class="btn btn-danger">{{ $error }}</div>
            @endforeach
        @endif

        <div class="form-group">
            {!! Form::label('nazwa', "Nazwa produktu:") !!}
            {!! Form::text('nazwa', $products->nazwa, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('cena', "Cena:") !!}
            {!! Form::number('cena', $products->cena, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('description', "Opis:") !!}
            {!! Form::textarea('description', $products->description, ['class' => 'form-control']) !!}
        </div>

    <!--    <div class="form-group">
            {!! Form::label('filename', "Zdjęcie:") !!}
            {!! Form::file('filename', null, ['class' => 'form-control']) !!}
        </div>
    -->
        <div class="form-group">
            {!! Form::submit('Zapisz', ['class' => 'btn btn-primary']) !!}
            {!! link_to(URL::previous(),'Powrót', ['class' => 'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}
    </div>


@endsection