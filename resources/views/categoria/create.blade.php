formulario de creacion de producto

@extends('layouts.app')

@section('content')
<div class="container">


<form action="{{ url('/categoria') }}" method="post" enctype="multipart/form-data"> 
 @csrf
 @include('categoria.form', ['modo'=>'Crear'])

</form>

</div>
@endsection