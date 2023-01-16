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
<table class="table">
    <thead>
      <tr>
        <th>No</th>
        <th>Nomor Registrasi</th>
        <th>Nama</th>
        <th>Bukti Pembayaran</th>
        <th>Detail Pendaftaran</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($payment as $key => $item)
           <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ $item['ppdb_id'] }}</td>
            <td>{{ $item['nm_rek'] }}</td>
           <td><a href="{{ route('bukti', $item['id']) }}" class="btn btn-outline-primary">Open</a></td>
           <td><a href="{{ route('detail', $item['ppdb_id']) }}" class="btn btn-outline-primary">Detail</a></td>   
           <td>
            <div class="ml-auto">
                @if ($item['status'] == 'Diproses')
                  <div class="d-flex">
                    <form action="{{ route('accepted', $item->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-success me-1">Accepted</button>
                    </form>
                    <form action="{{ route('rejected', $item->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-danger ">Rejected</button>
                    </form>
                  </div>
                @else
                    {{ $item['status'] }}
                @endif
            </div>
        </td> 
        @endforeach 
      </tr>
    </tbody>
  </table>
</div>
@endsection