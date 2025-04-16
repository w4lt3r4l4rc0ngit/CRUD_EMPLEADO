@extends('layouts.app')
@section('content')
<div class="container">
    <h2>{{ $modo }} Empleado</h2>

    @if (count($errors) > 0)
    <div class="alert alert-danger" role="alert">
        @foreach($errors->all() as $error)
        <ul>
            <li>
                {{ $error }}
            </li>
        </ul>
        @endforeach
    </div>

    @endif

    <div class="form-group">
        <label for="">Nombre</label>
        <input class="form-control" type="text" name="nombre" id="nombre" value="{{ old('nombre', $empleado->nombre ?? '') }}">

    </div>
    <div class="form-group">
        <label for="">Apellido 1</label>
        <input class="form-control" type="text" name='apellido1' id='apellido1' value="{{ old('apellido1', $empleado->apellido1 ?? '') }}">
    </div>
    <div class="form-group">
        <label for="">Apellido 2</label>
        <input class="form-control" type="text" name='apellido2' id='apellido2' value="{{ old('apellido2', $empleado->apellido2 ?? '') }}">
    </div>
    <div class="form-group">
        <label for="">Correo</label>
        <input class="form-control" type="mail" name='correo' id='correo' value="{{ old('correo', $empleado->correo ?? '') }}">
    </div>
    <div class="form-group">
        <label for="">Foto</label>
        @if(isset($empleado->foto))
        <img class="img-thumbnail img-fluid" width="100px" height="100px" src="{{asset('storage').'/'.$empleado->foto}}" alt="">
        @endif
        <input type="file" name='foto' id='foto' value="@if(isset($empleado)) {{$empleado->foto}} @endif">
    </div>
    <br><br>
    <div class="form-group" style="text-align: center;">
        <input type="submit" value="{{ $modo }} Datos" class="btn btn-success">
        <a class="btn btn-info" href="{{url('/empleado')}}">Regresar</a>
    </div>
</div>
@endsection