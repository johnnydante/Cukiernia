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
           <tr style="text-align: center;">
            <th scope="col">ID</th>
            <th scope="col">Użytkownik</th>
            <th scope="col">E-mail</th>
            <th scope="col">Nr tel</th>
            <th scope="col">Zamówienia</th>
            <th scope="col">Do zapłaty</th>
           </tr>
           </thead>
           <tbody>

           @foreach($users as $user)
           <tr>
            <td>{{$user->id}}</td>
            <td>{{$user->name}} {{$user->surname}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->tel}}</td>
            <td style="text-align: center;">
             @if($user->getOrder()->whereIn('status', ['oczekuje', 'w realizacji'])->count()>0 || $user->getTort()->whereIn('status', ['oczekuje', 'w realizacji'])->count()>0)
               <b>{{$user->getOrder()->where('status', 'oczekuje')->count()+$user->getTort()->where('status', 'oczekuje')->count()}}</b> oczekujące<br>
               <b>{{$user->getOrder()->where('status', 'w realizacji')->count()+$user->getTort()->where('status', 'w realizacji')->count()}}</b> w realizacji
              @elseif($user->getOrder()->where('status', 'koszyk')->count()>0 || $user->getTort()->where('status', 'koszyk')->count()>0)
              <b>{{$user->getOrder()->where('status', 'koszyk')->count()+$user->getTort()->where('status', 'koszyk')->count()}}</b> w koszyku<br>
              @else
               brak
              @endif
            </td>

            <td style="text-align: center;">
             @if($user->getOrder()->whereIn('status', ['oczekuje', 'w realizacji'])->count()>0 || $user->getTort()->whereIn('status', ['oczekuje', 'w realizacji'])->count()>0)
              <?php
                    $_POST['koszt'] = $user->getOrder()->where('status', 'w realizacji')->sum('suma');
                    $_POST['koszt_tortow'] = $user->getTort()->where('status', 'w realizacji')->sum('cena');
                    $_POST['koszt_oczekuje'] = $user->getOrder()->where('status', 'oczekuje')->sum('suma');
                    $_POST['koszt_tortow_oczekuje'] = $user->getTort()->where('status', 'oczekuje')->sum('cena');

                    ?>
             {{$_POST['koszt_oczekuje']+$_POST['koszt_tortow_oczekuje']}} zł<br>
              {{$_POST['koszt']+$_POST['koszt_tortow']}} zł
             @else
              ---
             @endif
            </td>
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
