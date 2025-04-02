<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehículos que han salido</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white text-center">
                        <h2>Vehículos que han salido</h2>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Placa</th>
                                    <th>Tipo</th>
                                    <th>Entrada</th>
                                    <th>Salida</th>
                                    <th>Total Pagado</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($exitedVehicles as $vehicle)
                                    <tr>
                                        <td>{{ $vehicle->plate }}</td>
                                        <td>{{ $vehicle->vehicle_type === 'car' ? 'Carro' : 'Moto' }}</td>
                                        <td>{{ $vehicle->entry_time }}</td>
                                        <td>{{ $vehicle->exit_time }}</td>
                                        <td>${{ number_format($vehicle->amount, 0) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>