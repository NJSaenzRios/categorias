

<h1>{{ $modo }} Categoria </h1>

@if(count($errors)>0)

    <div class="alert-danger" role="alert">
        
    
    <ul>

    
    @foreach($errors->all() as $error)

    <li>{{ $error }}</li>

    @endforeach

    </ul>
    </div>


@endif

<div class="form-group">

<label for="Nombre"> Nombre </label>
<input type="text" class="form-control" name="Nombre"  id="Nombre" 

value="{{ isset($categoria->Nombre)?$categoria->Nombre:old('') }}">

</div>


<div class="form-group">

<label for="Descripcion"> Descripcion </label>
<input type="text"  class="form-control" name="Descripcion"  id="Descripcion" value="{{ isset($categoria->Descripcion)?$categoria->Descripcion:old('') }}" >

</div>


<div class="form-group">

<label for="Foto">Foto</label>

@if(isset($categoria->Foto))

<img class="img-thumbnail img-fluid" src="{{ asset('storage').'/'.$categoria->Foto }}" width="75" alt="">

@endif

<input class="btn btn-success" type="file" class="form-control" name="Foto" value="" id="Foto">

</div>
<br>

<input class="btn btn-success" type="submit" value="{{ $modo}}  datos">
<a href="{{ url('categoria/create') }}">Regresar</a>
<br>

