<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportes de Ventas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <!-- Botón de Volver al Inicio -->
        <div class="mb-4">
            <a href="{{ url('/') }}" class="btn btn-secondary">Volver al Inicio</a>
        </div>

        <h2 class="text-center mb-4">Reportes de Ventas</h2>

        <!-- Formulario de búsqueda -->
        <form action="{{ route('generate.report') }}" method="POST" class="mb-5">
            @csrf
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <label for="start_date" class="form-label">Fecha de Inicio:</label>
                    <input type="date" name="start_date" id="start_date" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label for="end_date" class="form-label">Fecha de Fin:</label>
                    <input type="date" name="end_date" id="end_date" class="form-control" required>
                </div>
                <div class="col-md-4 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">Buscar</button>
                </div>
            </div>
        </form>

        <!-- Resultados del reporte -->
        @if(isset($reportData))
            <div class="card shadow">
                <div class="card-body">
                    <h4 class="text-center mb-3">Resultados del Reporte</h4>
                    <p class="text-center"><strong>Desde:</strong> {{ $startDate }} <strong>Hasta:</strong> {{ $endDate }}</p>
                    <p class="text-center text-success h4">Total Recaudado: ${{ number_format($totalAmount, 0) }}</p>

                    @if($reportData->isEmpty())
                        <p class="text-center text-danger">No se encontraron registros en el rango de fechas seleccionado.</p>
                    @else
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Placa</th>
                                    <th>Tipo de Vehículo</th>
                                    <th>Entrada</th>
                                    <th>Salida</th>
                                    <th>Estado</th>
                                    <th>Tarifa</th>
                                    <th>Monto Cobrado</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reportData as $record)
                                    <tr>
                                        <td>{{ $record->plate }}</td>
                                        <td>{{ $record->vehicle_type === 'car' ? 'Carro' : 'Moto' }}</td>
                                        <td>{{ $record->entry_time }}</td>
                                        <td>{{ $record->exit_time ?? 'Sin salida' }}</td>
                                        <td>{{ $record->exit_time ? 'Ha salido' : 'En parqueadero' }}</td>
                                        <td>${{ number_format($record->vehicle_type === 'car' ? 3500 : 1500, 0) }}</td>
                                        <td>${{ number_format($record->amount ?? 0, 0) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        @endif
    </div>
</body>
</html>