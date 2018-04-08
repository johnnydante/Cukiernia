@extends('layout')

@section('content')

<div class="container" style="max-width: 700px; color: orange">
    {!! Form::open(['route' => 'gallery.store', 'files' => true]) !!}

    @if($errors->any())
        @foreach ($errors->all() as $error)
            <div class="btn btn-danger">{{ $error }}</div>
        @endforeach
    @endif

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