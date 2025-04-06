<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cierre de Caja</title>
    <!-- Agregar Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white text-center">
                        <h2>Cierre de Caja</h2>
                    </div>
                    <div class="card-body text-center">
                        <p class="lead">Total recaudado hoy:</p>
                        <h1 class="text-success">${{ number_format($totalAmount, 0) }}</h1>
                        <a href="/" class="btn btn-primary btn-lg mt-4">Regresar al Inicio</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>