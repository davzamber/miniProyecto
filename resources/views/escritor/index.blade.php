@extends('layouts.app')
@section('content')
<div class="container">

@if(Session::has('mensaje'))
<div class="alert alert-success alert-dismissible" role="alert">
{{ Session::get('mensaje') }}
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>

</div>
@endif


   

<a href="{{ url('escritor/create') }}" class="btn btn-success">Registrar nuevo escritor</a> <br><br>
<table class="table">
    <thead class="thead-light">
        <tr>
            <th>#</th>
            <th>Foto</th>
            <th>Nombres</th>
            <th>Apellidos</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach( $datosEscritor as $escritores )
        <tr>
            <td>{{$escritores->id}}</td>

            <td>
                <img class="img-thumbnail img-fluid" src="{{ asset('storage').'/'.$escritores->Foto }}" alt="" width="100">

            </td>

            <td>{{$escritores->Nombres}}</td>
            <td>{{$escritores->Apellidos}}</td>
            <td>
            <a href="{{ url('/escritor/' .$escritores->id. '/edit') }}" class="btn btn-warning d-inline">
            Editar
            </a>
            | <form method="post" action="{{ url('/escritor/'.$escritores->id ) }} class="d-inline">
            @csrf
            {{ method_field('DELETE') }}
                <input class="btn btn-danger d-inline" type="submit" onclick="return confirm('¿Quieres borrarlo? 🥺')" value="Borrar">
            </form>
            
            </td>
            
        </tr>
        @endforeach
        <tr>
            <td scope="row"></td>
            <td></td>
            <td></td>
        </tr>
    </tbody>
</table>
{!! $datosEscritor->links() !!}
</div>
@endsection