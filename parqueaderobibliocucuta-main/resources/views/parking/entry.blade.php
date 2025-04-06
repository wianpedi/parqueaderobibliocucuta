<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Entrada</title>
    <!-- Agregar Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white text-center">
                        <h2>Registrar Entrada</h2>
                    </div>
                    <div class="card-body">
                        <!-- Mostrar mensajes de error -->
                        @if(session('error'))
                            <div class="alert alert-danger text-center">
                                {{ session('error') }}
                            </div>
                        @endif

                        <!-- Formulario de entrada -->
                        <form action="{{ route('parking.entry') }}" method="POST" class="text-center">
                            @csrf
                            <div class="mb-3">
                                <label for="plate" class="form-label">Placa del vehículo:</label>
                                <input type="text" name="plate" id="plate" class="form-control form-control-lg" placeholder="Ej: ABC123" required>
                            </div>
                            <div class="mb-3">
                                <label for="vehicle_type" class="form-label">Tipo de vehículo:</label>
                                <select name="vehicle_type" id="vehicle_type" class="form-select form-select-lg">
                                    <option value="car">Carro</option>
                                    <option value="motorcycle">Moto</option>
                                </select>
                            </div>
                            <div class="d-grid gap-3">
                                <button type="submit" class="btn btn-success btn-lg">Registrar Entrada</button>
                                <a href="{{ route('parking.exit-form') }}" class="btn btn-warning btn-lg">Registrar Salida</a>
                                <a href="{{ route('reports') }}" class="btn btn-secondary">Reportes</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>