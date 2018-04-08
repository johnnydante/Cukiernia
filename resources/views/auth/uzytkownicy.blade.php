@extends('layout')

@section('content')
 <section class="page-section cta">
  <div class="container">
   <div class="row">
    <div class="col-xl-9 mx-auto">
     <div class="cta-inner rounded">
      <h2 class="section-heading mb-5">
       <span class="section-heading-upper" style="margin-bottom: 30px;">Użytkownicy</span>
      </h2>
        <div class="row">
          <table class="table">
           <thead>
           <tr>
            <th scope="col">ID</th>
            <th scope="col">Imię</th>
            <th scope="col">Nazwisko</th>
            <th scope="col">E-mail</th>
            <th scope="col">Nr telefonu</th>
           </tr>
           </thead>
           <tbody>
           @foreach($users as $user)
           <tr>
            <td>{{$user->id}}</td>
            <td>{{$user->name}}</td>
            <td>{{$user->surname}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->tel}}</td>
           </tr>
           @endforeach
           </tbody>
          </table>
         </div>
      {{$users->links()}}
     </div>
    </div>
   </div>
  </div>
 </section>
@endsection
