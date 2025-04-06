<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Salida</title>
    <!-- Agregar Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white text-center">
                        <h2>Registrar Salida</h2>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('parking.exit') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="plate" class="form-label">Placa del vehículo:</label>
                                <input type="text" name="plate" id="plate" class="form-control form-control-lg" placeholder="Ej: ABC123" required>
                            </div>
                            <div class="d-grid gap-3">
                                <button type="submit" class="btn btn-success btn-lg">Registrar Salida</button>
                                <a href="{{ url()->previous() }}" class="btn btn-secondary btn-lg">Volver Atrás</a>
                                <a href="/" class="btn btn-primary btn-lg">Regresar al Inicio</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>