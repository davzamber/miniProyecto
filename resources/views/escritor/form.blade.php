
<h1>{{$modo}} escritor</h1>

@if(count($errors)>0)
    <div class="alert alert-danger" role="alert">
        <ul>
          @foreach( $errors->all() as $error)
              <li>{{ $error }}</li>
          @endforeach
        <ul>
    </div>
    
@endif


<div class="form-group">
<label for="Nombre">Nombre</label>
<input type="text" class="form-control" name="Nombres" value="{{ isset($escritores->Nombres)?$escritores->Nombres:old('Nombre') }}" id="nombre">
<br>
</div>
<div class="form-group">
<label for="Apellidos">Apellidos</label>
<input type="text" class="form-control" name="Apellidos" value="{{ isset($escritores->Apellidos)?$escritores->Apellidos:old('Apellidos') }}" id="apellidos">
<br>
</div>
<div class="form-group">
<label for="Foto">Foto</label>
@if(isset($escritores->Foto))
<img class="img-thumbnail img-fluid" src="{{ asset('storage').'/'.$escritores->Foto }}" alt="" width="100">
@endif
<input type="file" value="" name="Foto">
<br>
</div>
<input class="btn btn-success d-inline" type="submit" value="{{$modo}}">
<br>
<a class="btn btn-primary" href="{{ url('escritor/') }}">Regresar</a>