<?php
// Este archivo actúa como el punto de entrada principal de la aplicación
// Coordina la comunicación entre el servicio de citas y la vista

// Incluir (importar) las clases que vamos a utilizar
require_once 'QuoteService.php';
require_once 'QuoteView.php';

// Paso 1: Crear una instancia del servicio de citas
$quoteService = new QuoteService();

// Paso 2: Obtener una cita aleatoria usando el servicio
$quote = $quoteService->getRandomQuote();

// Paso 3: Crear una instancia de la vista
$view = new QuoteView();

// Paso 4: Formatear la cita para su visualización segura
$formattedQuote = $view->formatQuote($quote);

// Paso 5: Renderizar la página completa con la cita formateada
$view->renderPage($formattedQuote);
?>
