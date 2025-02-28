<?php
// Esta clase se encarga de obtener citas de la API de Breaking Bad
class QuoteService {
    // Almacena la URL de la API
    private string $apiUrl;
    
    // Constructor: inicializa el servicio con la URL predeterminada o una personalizada
    public function __construct(string $apiUrl = "https://api.breakingbadquotes.xyz/v1/quotes") {
        $this->apiUrl = $apiUrl;
    }
    
    // Función principal: obtiene una cita aleatoria
    public function getRandomQuote(): array {
        try {
            // Intentamos obtener una cita de la API
            $quote = $this->fetchFromApi();
            
            // Si no hay problemas, devolvemos la cita
            if (isset($quote['quote']) && isset($quote['author'])) {
                return $quote;
            }
            
            // Si llegamos aquí, algo falló con la API
            return $this->getDefaultQuote();
        } catch (Exception $e) {
            // En caso de cualquier error, usamos una cita predeterminada
            return $this->getDefaultQuote();
        }
    }
    
    // Función auxiliar: se comunica con la API
    private function fetchFromApi(): array {
        // Inicializar cURL con la URL de la API
        $ch = curl_init($this->apiUrl);
        
        // Configurar cURL para recibir el resultado
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5); // Límite de 5 segundos para la conexión
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Para entornos de desarrollo
        
        // Ejecutar la petición
        $result = curl_exec($ch);
        
        // Cerrar la conexión cURL
        curl_close($ch);
        
        // Procesar la respuesta JSON
        $data = json_decode($result, true);
        
        // Si hay datos válidos, devolver la primera cita
        if (is_array($data) && !empty($data) && isset($data[0])) {
            return $data[0];
        }
        
        // Si no hay datos válidos, devolver un array vacío
        return [];
    }
    
    // Función auxiliar: proporciona una cita predeterminada para casos de error
    private function getDefaultQuote(): array {
        // Array de citas de respaldo en caso de que la API falle
        $fallbackQuotes = [
            ['quote' => 'I am not in danger, I am the danger.', 'author' => 'Walter White'],
            ['quote' => 'Say my name.', 'author' => 'Walter White'],
            ['quote' => 'I did it for me. I liked it. I was good at it.', 'author' => 'Walter White'],
            ['quote' => 'Yeah, science!', 'author' => 'Jesse Pinkman'],
            ['quote' => 'Better call Saul!', 'author' => 'Saul Goodman']
        ];
        
        // Seleccionar una cita aleatoria del array de respaldo
        return $fallbackQuotes[array_rand($fallbackQuotes)];
    }
}
?>