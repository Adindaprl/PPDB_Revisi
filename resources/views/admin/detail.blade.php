@extends('layout.sidebar')
@section('sdbar')
<div id="sidebar">
    <header>
      <a href="#">PPDB 2023-2024</a>
    </header>
    <ul class="nav">
       <li>
          <div class="card-sb" style=" width: 250px;">
              <div class="cardsb">
                  <div class="card-body">
                      <img style="width:30px" src="{{asset('/assets/img/home.png')}}" alt="">
                      <a href="/admindash">
                          <i></i> Dashboard
                        </a>
                  </div>
                </div>
              <div class="cardsb">
                  <div class="card-body">
                      <img style="width:30px" src="{{asset('/assets/img/payment.png')}}" alt="">
                      <a href="/verifikasi">
                          <i></i> Pembayaran
                        </a>
                  </div>
              </div>
        </li>
    </ul>
  </div>
  </div>
<div class="dashboard" style="padding-left:20%">
    <div class="profile d-flex">
              <img src="{{asset('/assets/img/profile.png')}}" style="width:40px;margin-left:70%" alt="">
              <div class="dropdown">
                <button class="mt-1" style="border:none;background-color:transparent;color:white;" type="button" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
                      {{Auth::user()->name}}
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                  <li><a class="dropdown-item" type="button" href="/logout" >Logout</a></li>
                </ul>
              </div>
            </div>
    <div class="card1 d-flex bg-light " style="border: none">
        <div class="card-body" style="width: 18rem;">
                <h4>Hi, {{Auth::user()->name}}</h4>
                <p> Selamat Datang di dashboard!</p>
         </div>
</div>

<div class="card">
    <div class="detail">
        <div class="mt-5 mb-5">
            <ul>
                <li>
                    <p class="fw-bold">No.Registrasi : <span class="fw-normal">{{$ppdb->id}}</span></p>
                </li>
                <li>
                    <p class="fw-bold">Nama : <span class="fw-normal">{{$ppdb->name}}</span></p>
                </li>
                <li>
                    <p class="fw-bold">NISN : <span class="fw-normal">{{$ppdb->nisn}}</span></p>
                </li>
                <li>
                    <p class="fw-bold">Asal Sekolah : <span class="fw-normal">{{$ppdb->asalSekolah}}</span></p>
                </li>
                <li>
                    <p class="fw-bold">Email : <span class="fw-normal">{{$ppdb->email}}</span></p>
                </li>
                <li>
                    <p class="fw-bold">Nomor Telephone : <span class="fw-normal">{{$ppdb->nomor}}</span></p>
                </li>
            </ul>
            <a href="{{route('verifikasi')}}" class="btn-back">BACK</a>
        </div>
    </div>
</div>
@endsection
