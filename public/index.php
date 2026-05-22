<?php
/**
 * Front Controller
 * Tüm istekler bu dosyadan geçer
 */

// Hata raporlama (geliştirme ortamında)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Autoload ve config dosyalarını yükle
require_once __DIR__ . '/../config/app.php';
require_once __DIR__ . '/../src/Router.php';

try {
    // Router'ı başlat
    $router = new Router();
    $router->loadRoutes();
    
} catch (Exception $e) {
    // Hata yakalama
    if (APP_ENV === 'local') {
        // Development'ta detaylı hata göster
        echo '<pre style="background:#fee;padding:2rem;border-left:4px solid #c33;font-family:monospace;">';
        echo '<strong>Error:</strong> ' . htmlspecialchars($e->getMessage()) . "\n\n";
        echo '<strong>File:</strong> ' . htmlspecialchars($e->getFile()) . "\n";
        echo '<strong>Line:</strong> ' . $e->getLine() . "\n\n";
        echo '<strong>Trace:</strong>' . "\n" . htmlspecialchars($e->getTraceAsString());
        echo '</pre>';
    } else {
        // Production'da genel hata sayfası
        http_response_code(500);
        echo '<h1>Bir hata oluştu</h1>';
        echo '<p>Lütfen daha sonra tekrar deneyiniz.</p>';
    }
}
