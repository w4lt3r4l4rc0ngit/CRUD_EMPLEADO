@extends('layouts.app')
@section('content')
<div class="container">

@if (session('mensaje'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('mensaje') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

    <a class="btn btn-success" href="{{url('empleado/create')}}">Crear Empleado</a>
    <br><br>
    <table class="table table-light">
        <thead class="thead-light">
            <tr>
                <th>#</th>
                <th>Foto</th>
                <th>Nombre</th>
                <th>Apellido 1</th>
                <th>Apellido 2</th>
                <th>Correo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($datos as $empleado)
            <tr>
                <td>{{$empleado->id}}</td>
                <td>
                    <img class="img-thumbnail img-fluid" width="100px" height="50px" src="{{asset('storage').'/'.$empleado->foto}}" alt="">
                </td>
                <td>{{$empleado->nombre}}</td>
                <td>{{$empleado->apellido1}}</td>
                <td>{{$empleado->apellido2}}</td>
                <td>{{$empleado->correo}}</td>
                <td>
                    <a class="btn btn-warning" href="{{url('/empleado/'.$empleado->id.'/edit')}}">
                        Editar
                    </a>
                    <form action="{{url('/empleado/'.$empleado->id)}}" method="post" class="d-inline">
                        @csrf
                        {{ method_field("Delete") }}
                        <input class="btn btn-danger" type="submit" onclick="return confirm('¿Quieres borrar el empleado?')" value="Borrar">
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
    {!! $datos->links() !!}
    </div>
</div>
@endsection