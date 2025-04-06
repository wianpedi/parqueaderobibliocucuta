<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket de Salida</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-body text-center">
                        <h2>Ticket de Salida</h2>
                        <p><strong>Placa:</strong> {{ $parking->plate }}</p>
                        <p><strong>Tipo de Vehículo:</strong> {{ $parking->vehicle_type === 'car' ? 'Carro' : 'Moto' }}</p>
                        <p><strong>Fecha y Hora de Entrada:</strong> {{ $parking->entry_time }}</p>
                        <p><strong>Fecha y Hora de Salida:</strong> {{ $parking->exit_time }}</p>
                        <p><strong>Tiempo Transcurrido:</strong> {{ $duration }} minutos</p>
                        <p><strong>Tarifa por Hora:</strong> ${{ number_format($rate, 0) }}</p>
                        <p><strong>Total a Pagar:</strong> ${{ number_format($parking->amount, 0) }}</p>
                        <a href="/" class="btn btn-primary">Regresar al Inicio</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>