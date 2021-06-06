@extends('layouts.app')
@section('content')
<div class="container">
<form action="{{ url('/escritor/'.$escritores->id) }}" method="POST" enctype="multipart/form-data">
@csrf
{{ method_field('PATCH') }}
@include('escritor.form',['modo'=>'Editar']);
</form>
</div>
@endsection