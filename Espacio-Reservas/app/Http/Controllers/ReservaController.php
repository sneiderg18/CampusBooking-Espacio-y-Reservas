<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use App\Models\Espacio;
use Illuminate\Http\Request;

class ReservaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reservas = Reserva::with('espacio')->paginate(10);
        return view('reservas.index', compact('reservas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $espacios = Espacio::all();
        return view('reservas.create', compact('espacios'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'espacio_id' => 'required|exists:espacios,id',
        'solicitante' => 'required|string|max:255',
        'fecha' => 'required|date|after_or_equal:today',
        'hora_inicio' => 'required|date_format:H:i',
        'hora_fin' => 'required|date_format:H:i|after:hora_inicio',
        'motivo' => 'nullable|string|max:255',
    ], [
        'fecha.after_or_equal' => 'No puedes reservar en una fecha pasada.',
        'hora_fin.after' => 'La hora final debe ser mayor que la hora de inicio.',
    ]);

    $espacio = Espacio::find($request->espacio_id);

    if ($request->cantidad_personas > $espacio->capacidad) {
        return back()
            ->withErrors([
                'cantidad_personas' => "La cantidad de personas excede la capacidad del espacio ({$espacio->capacidad})."
            ])
            ->withInput();
    }

    // 2. Validar choque de horarios
    $reservaExiste = Reserva::where('espacio_id', $request->espacio_id)
        ->where('fecha', $request->fecha)
        ->where(function ($query) use ($request) {
            $query->whereBetween('hora_inicio', [$request->hora_inicio, $request->hora_fin])
                  ->orWhereBetween('hora_fin', [$request->hora_inicio, $request->hora_fin])
                  ->orWhere(function ($q) use ($request) {
                      $q->where('hora_inicio', '<=', $request->hora_inicio)
                        ->where('hora_fin', '>=', $request->hora_fin);
                  });
        })
        ->exists();

    if ($reservaExiste) {
        return back()
            ->withErrors(['hora_inicio' => 'El ambiente ya está reservado en este horario.'])
            ->withInput();
    }

    Reserva::create($request->all());

    return redirect()->route('reservas.index')
        ->with('success', 'Reserva creada correctamente.');
}



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reserva $reserva)
    {
        $espacios = Espacio::all();
        return view('reservas.edit', compact('reserva', 'espacios'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reserva $reserva)
{
    // 1. Validación básica
    $request->validate([
        'espacio_id' => 'required|exists:espacios,id',
        'solicitante' => 'required|string|max:255',
        'fecha' => 'required|date|after_or_equal:today',
        'hora_inicio' => 'required|date_format:H:i',
        'hora_fin' => 'required|date_format:H:i|after:hora_inicio',
        'cantidad_personas' => 'required|integer|min:1',
        'motivo' => 'nullable|string|max:255',
    ], [
        'fecha.after_or_equal' => 'No puedes reservar en una fecha pasada.',
        'hora_fin.after' => 'La hora final debe ser mayor que la hora de inicio.',
    ]);

    // 2. Validación de capacidad
    $espacio = Espacio::find($request->espacio_id);

    if ($request->cantidad_personas > $espacio->capacidad) {
        return back()
            ->withErrors([
                'cantidad_personas' =>
                    'La cantidad de personas (' . $request->cantidad_personas .
                    ') supera la capacidad del espacio (' . $espacio->capacidad . ').'
            ])
            ->withInput();
    }

    // 3. Validación de conflicto de horarios
    $conflicto = Reserva::where('espacio_id', $request->espacio_id)
        ->where('fecha', $request->fecha)
        ->where('id', '!=', $reserva->id) // Ignorar la reserva actual
        ->where(function ($query) use ($request) {
            $query->whereBetween('hora_inicio', [$request->hora_inicio, $request->hora_fin])
                  ->orWhereBetween('hora_fin', [$request->hora_inicio, $request->hora_fin])
                  ->orWhere(function ($q) use ($request) {
                      $q->where('hora_inicio', '<=', $request->hora_inicio)
                        ->where('hora_fin', '>=', $request->hora_fin);
                  });
        })
        ->exists();

    if ($conflicto) {
        return back()
            ->withErrors(['hora_inicio' => 'El ambiente ya está reservado en este horario.'])
            ->withInput();
    }

    // 4. Guardar cambios
    $reserva->update($request->all());

    return redirect()->route('reservas.index')
        ->with('success', 'Reserva actualizada correctamente.');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reserva $reserva)
    {
        $reserva->delete();
        return redirect()->route('reservas.index')->with('success', 'Reserva eliminada correctamente.');
    }
}
