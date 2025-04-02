<?php

namespace App\Http\Controllers;

use App\Models\Parking;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ParkingController extends Controller
{
    // Mostrar formulario de entrada
    public function showEntryForm()
    {
        return view('parking.entry');
    }

    // Registrar entrada de vehículo
    public function registerEntry(Request $request)
    {
        try {
            // Validar los datos del formulario usando reglas del modelo
            $validated = $request->validate(Parking::rules());

            // Crear un nuevo registro de parqueadero
            $parking = new Parking();
            $parking->plate = strtoupper($request->plate); // Convertir a mayúsculas
            $parking->vehicle_type = $request->vehicle_type; // Almacenar el tipo de vehículo
            $parking->entry_time = now(); // Registrar la hora de entrada
            $parking->save();

            // Mostrar el ticket de entrada
            return view('parking.ticket-entry', compact('parking'));

        } catch (\Exception $e) {
            return back()->with('error', 'La placa registrada se encuentra dentro del parqueadero');
        }
    }

    // Mostrar formulario de salida
    public function showExitForm()
    {
        return view('parking.exit');
    }

    // Registrar salida de vehículo
    public function registerExit(Request $request)
    {
        try {
            // Validar que la placa exista en la base de datos
            $validated = $request->validate([
                'plate' => ['required', 'exists:parkings,plate'],
            ]);

            // Buscar el último registro del vehículo que aún no ha salido
            $parking = Parking::where('plate', strtoupper($request->plate))
                ->whereNull('exit_time') // Solo registros sin salida registrada
                ->latest() // Obtener el registro más reciente
                ->first();

            // Verificar si el vehículo ya ha salido
            if (!$parking) {
                return back()->with('error', 'El vehículo ya ha salido o no está registrado.');
            }

            // Registrar la hora de salida y calcular el tiempo transcurrido (en minutos)
            $parking->exit_time = now();
            $duration = Carbon::parse($parking->entry_time)->diffInMinutes($parking->exit_time);

            // Calcular el precio según el tipo de vehículo y el tiempo transcurrido
            $rate = $parking->vehicle_type === 'car' ? 3500 : 1500; // Tarifa por hora
            $amount = 0;

            if ($duration > 15) {
                // Calcular el número de horas completas (redondeando hacia arriba)
                $hours = ceil($duration / 60);

                // Cobrar por cada hora completa
                $amount = $hours * $rate;
            }

            // Guardar el monto y actualizar el registro
            $parking->amount = $amount;
            $parking->save();

            // Mostrar el ticket de salida
            return view('parking.ticket-exit', compact('parking', 'duration', 'rate'));

        } catch (\Exception $e) {
            return back()->with('error', 'Ocurrió un error al registrar la salida. Por favor, inténtalo de nuevo.');
        }
    }

    // Cerrar caja
    public function closeCashRegister()
    {
        try {
            // Calcular el total recaudado hoy
            $today = Carbon::today();
            $totalAmount = Parking::whereDate('created_at', $today)->sum('amount');

            // Mostrar el cierre de caja
            return view('parking.cash-register', compact('totalAmount'));

        } catch (\Exception $e) {
            return back()->with('error', 'Ocurrió un error al cerrar la caja. Por favor, inténtalo de nuevo.');
        }
    }

    // Mostrar vehículos que han salido
    public function showExitedVehicles()
    {
        try {
            // Obtener los vehículos que han salido (con hora de salida registrada)
            $exitedVehicles = Parking::whereNotNull('exit_time')
                ->orderBy('exit_time', 'desc')
                ->select('plate', 'vehicle_type', 'entry_time', 'exit_time', 'amount') // Optimización de consulta
                ->get();

            // Mostrar la vista con los vehículos que han salido
            return view('parking.exited-vehicles', compact('exitedVehicles'));

        } catch (\Exception $e) {
            return back()->with('error', 'Ocurrió un error al cargar los vehículos que han salido. Por favor, inténtalo de nuevo.');
        }
    }

    // Mostrar formulario de reportes
    public function showReportsForm()
    {
        return view('parking.reports');
    }


// Generar reporte filtrado por fechas
public function generateReport(Request $request)
{
    try {
        // Validar las fechas ingresadas
        $validated = $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        // Obtener las fechas del formulario
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Agregar horas al rango de fechas para incluir todo el día
        $startDateTime = $startDate . ' 00:00:00';
        $endDateTime = $endDate . ' 23:59:59';

        // Filtrar los registros dentro del rango de fechas
        $reportData = Parking::whereBetween('created_at', [$startDateTime, $endDateTime])
            ->orderBy('created_at', 'desc')
            ->select('plate', 'vehicle_type', 'entry_time', 'exit_time', 'amount') // Optimización de consulta
            ->get();

        // Calcular la sumatoria total de los montos cobrados (solo para vehículos que han salido)
        $totalAmount = $reportData->whereNotNull('exit_time')->sum('amount');

        // Pasar los datos a la vista
        return view('parking.reports', compact('reportData', 'totalAmount', 'startDate', 'endDate'));

    } catch (\Exception $e) {
        return back()->with('error', 'Ocurrió un error al generar el reporte. Por favor, inténtalo de nuevo.');
    }
}
}