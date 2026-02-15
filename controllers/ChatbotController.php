<?php

namespace Controllers;

use MVC\Router;

class ChatbotController {
    public static function index(Router $router) {
        session_start();
        
        // Renderizar la vista del chatbot sin necesidad de layout
        include __DIR__ . '/../views/chatbot.php';
    }
}
