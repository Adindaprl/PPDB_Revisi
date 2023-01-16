@extends('layout.input')
@section('input')

<div class="container pt-5">
    <center>
    <img src="{{asset('assets/img/error.svg')}}" style="width:50%" class="d-blok m-auto">
    <h5 class="text-center mt-3" style="color: white" > You are not allowed to access this page. </h5>
    <div class="d-flex justify-content-center mt-2">
        <a href="{{route('index')}}" class="btn-error">BACK</a>
    </div>
    </center>
</div>
@endsection