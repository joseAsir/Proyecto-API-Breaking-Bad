<?php 
// URL de la API de Breaking Bad para obtener una cita aleatoria
const API_URL = "https://api.breakingbadquotes.xyz/v1/quotes";

// Inicializar una nueva sesión de cURL
$ch = curl_init(API_URL);

// Indicar que queremos recibir el resultado de la petición
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Ejecutar la petición y guardar el resultado
$result = curl_exec($ch);

// Transformar el resultado en un array
$data = json_decode($result, true);

// Cerrar la conexión
curl_close($ch);

// Obtener la primera cita (la API devuelve un array de citas)
$quote = $data[0] ?? ['quote' => 'No se pudo cargar una cita', 'author' => 'Error'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Citas de Breaking Bad</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8 text-center">
                <h1 class="mb-4">Citas de Breaking Bad</h1>
                
                <!-- Tarjeta de la cita -->
                <div class="card bg-secondary text-white mb-4">
                    <div class="card-body">
                        <figure class="mb-0">
                            <blockquote class="blockquote">
                                <p>"<?= htmlspecialchars($quote['quote']) ?>"</p>
                            </blockquote>
                            <figcaption class="blockquote-footer text-white text-end">
                                <?= htmlspecialchars($quote['author']) ?>
                            </figcaption>
                        </figure>
                    </div>
                </div>
                
                <!-- Enlace para obtener nueva cita -->
                <a href="" class="btn btn-success">Nueva cita</a>
            </div>
        </div>
    </div>
</body>
</html>