

@extends('layouts.app')

@section('content')

<div class="container">

   
@if(Session::has('mensaje'))

<div class="alert alert-success alert-dismissible" role="alert">

{{ Session::get('mensaje')}} <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
</button>


</div>
@endif

<a href="{{ url('categoria/create') }}" class="btn btn-success">Registrar nueva Categoria</a>

<br>
<br>


<table class="table table-light">
   
    
    <thead class="thead-light">
        <tr>
            <th>id</th>
            <th>Foto</th>
            <th>Nombre</th>
           <th>Descripcion</th>                                

        </tr>
    </thead>

    <tbody>

        @foreach( $categorias as $categoria)

        <tr>

            <td>{{ $categoria->id }}</td>
            
            <td>                
            <img class="img-thumnail img-fluid" src="{{ asset('storage').'/'.$categoria->Foto }}" alt="">
            </td>
            
            <td>{{ $categoria->Nombre }}</td>
            <td>{{ $categoria->Descripcion }}</td>
          
            <td>

              <a href="{{ url('/categoria/'.$categoria->id.'/edit') }}" class="btn btn-warning">                          
                Editar 
    
            </a>
            
            <form action="{{ url('/categoria/'.$categoria->id ) }}" class="d-inline" method="post"> 

            @csrf
            {{ method_field('DELETE') }}                        
            <input class="btn btn-danger" type="submit"  onclick="return confirm('¿Quieres borrar?')"
            value="Borrar">
            
           
            </form>

            </td>
        </tr>
        @endforeach


    </tbody>
</table>

{!! $categorias->links() !!}
</div>
@endsection