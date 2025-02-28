<?php
// Esta clase se encarga de presentar la interfaz de usuario
class QuoteView {
    // Función para formatear y escapar el contenido de la cita para mostrarla de forma segura
    public function formatQuote(array $quote): array {
        return [
            'quote' => htmlspecialchars($quote['quote']),
            'author' => htmlspecialchars($quote['author'])
        ];
    }
    
    // Función principal: genera todo el HTML de la página
    public function renderPage(array $quote): void {
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
                                        <p>"<?= $quote['quote'] ?>"</p>
                                    </blockquote>
                                    <figcaption class="blockquote-footer text-white text-end">
                                        <?= $quote['author'] ?>
                                    </figcaption>
                                </figure>
                            </div>
                        </div>
                        
                        <!-- Enlace para obtener nueva cita - Ahora apunta correctamente a la página actual -->
                        <a href="<?= $_SERVER['PHP_SELF'] ?>" class="btn btn-success">Nueva cita</a>
                    </div>
                </div>
            </div>
        </body>
        </html>
        <?php
    }
}
?>