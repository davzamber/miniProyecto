@extends('layouts.app')
@section('content')
<div class="container">
<form action="{{ url('/escritor') }}" method="POST" enctype="multipart/form-data">
@csrf 
@include('escritor.form',['modo'=>'Crear']);
</form>
</div>
@endsection