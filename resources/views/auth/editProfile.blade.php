@extends('layout')

@section('content')
    <section class="page-section cta">
        <div class="container">
            <div class="row">
                <div class="col-xl-9 mx-auto">
                    <div class="cta-inner rounded">
                        <h2 class="section-heading mb-5">
                            <span class="section-heading-upper">Edytuj profil</span>
                            <span class="section-heading-lower"></span>
                        </h2>
                        <div style="position:relative; z-index: 1;">
                            {!! Form::model($user, ['route' => ['profile.update', $user->id], 'method' => 'POST']) !!}

                            @if($errors->any())
                                @foreach ($errors->all() as $error)
                                    <div class="btn btn-danger">{{ $error }}</div>
                                @endforeach
                            @endif

                            <div class="form-group">
                                {!! Form::label('name', "Imię:") !!}
                                {!! Form::text('name', $user->name, ['class' => 'form-control']) !!}

                            </div>

                            <div class="form-group">
                                {!! Form::label('surname', "Nazwisko:") !!}
                                {!! Form::text('surname', $user->surname, ['class' => 'form-control']) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('tel', "Numer telefonu:") !!}
                                {!! Form::text('tel', $user->tel, ['class' => 'form-control']) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('email', "Email:") !!}
                                {!! Form::email('email', $user->email, ['class' => 'form-control']) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::submit('Zapisz', ['class' => 'btn btn-primary']) !!}
                            </div>


                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
