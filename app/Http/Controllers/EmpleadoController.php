<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datos = Empleado::paginate(2);
        return view('empleados/index', compact('datos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('empleados/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $campos = [
            'nombre' => 'required|string|max:100',
            'apellido1' => 'required|string|max:100',
            'apellido2' => 'required|string|max:100',
            'correo' => 'required|email',
            'foto' => 'required|max:10000|mimes:jpg,png,jpeg',
        ];

        $mensaje = [
            'required' => 'El :attribute es requerido.',
            'email' => 'Ingrese un correo valido',
            'foto.required' => 'La foto es requerida.',
        ];

        $this->validate($request, $campos, $mensaje);



        $datosEmpleado = request()->except('_token');
        if ($request->hasFile('foto')) {
            $datosEmpleado['foto'] = $request->file('foto')->store('uploads', 'public');
        }
        Empleado::insert($datosEmpleado);
        //return response()->json($datosEmpleado);
        //$datos = Empleado::paginate(5);
        return redirect('empleado')->with('mensaje', 'Empleado guardado');
    }

    /**
     * Display the specified resource.
     */
    public function show(Empleado $empleado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $empleado = Empleado::findOrFail($id);
        return view('empleados/edit', compact('empleado'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $campos = [
            'nombre' => 'required|string|max:100',
            'apellido1' => 'required|string|max:100',
            'apellido2' => 'required|string|max:100',
            'correo' => 'required|email',
        ];

        $mensaje = [
            'required' => 'El :attribute es requerido.',
            'email' => 'Ingrese un correo valido',
        ];

        if ($request->hasFile('foto')) {
            $campos = ['foto' => 'required|max:10000|mimes:jpg,png,jpeg'];
            $mensaje = ['foto.required' => 'La foto es requerida.'];
        }

        $this->validate($request, $campos, $mensaje);

        $datosEmpleado = request()->except('_token', '_method');
        if ($request->hasFile('foto')) {
            $empleado = Empleado::findOrFail($id);
            Storage::delete('public/' . $empleado->foto);
            $datosEmpleado['foto'] = $request->file('foto')->store('uploads', 'public');
        }

        Empleado::where('id', '=', $id)->update($datosEmpleado);

        //$datos = Empleado::paginate(10);
        return redirect('empleado')->with('mensaje', 'Empleado Modificado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $empleado = Empleado::findOrFail($id);
        if (Storage::delete('public/' . $empleado->foto)) {
            Empleado::destroy($id);
        }
        return redirect('empleado')->with('mensaje', 'Empleado borrado');
    }
}
