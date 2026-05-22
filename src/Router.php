<?php
/**
 * Router Sınıfı
 * URL yönlendirme ve routing işlemlerini yönetir
 */

class Router {
    private $routes = [];
    private $params = [];
    
    /**
     * Constructor - Routes dosyasını yükle
     */
    public function __construct() {
        $this->routes = require CONFIG_PATH . '/routes.php';
    }
    
    /**
     * Route'ları yükle
     */
    public function loadRoutes() {
        $uri = $this->getUri();
        $method = $_SERVER['REQUEST_METHOD'];
        
        // Exact match kontrolü
        if (isset($this->routes[$uri])) {
            $route = $this->routes[$uri];
            return $this->handleRoute($route, $method);
        }
        
        // Parametreli route kontrolü
        foreach ($this->routes as $pattern => $route) {
            if ($this->matchRoute($pattern, $uri)) {
                return $this->handleRoute($route, $method);
            }
        }
        
        // 404 - Route bulunamadı
        $this->handle404();
    }
    
    /**
     * URI'yi al ve temizle
     * 
     * @return string Temizlenmiş URI
     */
    private function getUri() {
        $uri = $_SERVER['REQUEST_URI'] ?? '/';
        
        // Query string'i kaldır
        $uri = strtok($uri, '?');
        
        // Base path'i kaldır (eğer public klasörü altındaysak)
        $scriptName = dirname($_SERVER['SCRIPT_NAME']);
        if ($scriptName !== '/') {
            $uri = str_replace($scriptName, '', $uri);
        }
        
        // Trailing slash kaldır (ana sayfa hariç)
        if ($uri !== '/') {
            $uri = rtrim($uri, '/');
        }
        
        return $uri;
    }
    
    /**
     * Route pattern'i ile URI'yi eşleştir
     * 
     * @param string $pattern Route pattern
     * @param string $uri Gelen URI
     * @return bool Eşleşiyorsa true
     */
    private function matchRoute($pattern, $uri) {
        // {param} formatındaki parametreleri regex'e çevir
        $pattern = preg_replace('/\{([a-zA-Z0-9_]+)\}/', '([a-zA-Z0-9_-]+)', $pattern);
        $pattern = '#^' . $pattern . '$#';
        
        if (preg_match($pattern, $uri, $matches)) {
            // İlk eleman tam eşleşme, geri kalanlar parametreler
            array_shift($matches);
            $this->params = $matches;
            return true;
        }
        
        return false;
    }
    
    /**
     * Route'u işle ve ilgili controller'ı çağır
     * 
     * @param array $route Route bilgileri
     * @param string $method HTTP metodu
     */
    private function handleRoute($route, $method) {
        // Method kontrolü
        if (isset($route['method']) && $route['method'] !== $method) {
            http_response_code(405);
            die('Method Not Allowed');
        }
        
        // Auth kontrolü
        if (isset($route['auth']) && $route['auth'] === true) {
            requireAuth();
        }
        
        // Controller ve action bilgilerini al
        $controllerName = $route['controller'];
        $actionName = $route['action'];
        
        // Controller dosyasını yükle
        $controllerFile = SRC_PATH . '/Controllers/' . $controllerName . '.php';
        if (!file_exists($controllerFile)) {
            die("Controller not found: $controllerName");
        }
        
        require_once $controllerFile;
        
        // Controller sınıfını oluştur
        if (!class_exists($controllerName)) {
            die("Controller class not found: $controllerName");
        }
        
        $controller = new $controllerName();
        
        // Action metodunu çağır
        if (!method_exists($controller, $actionName)) {
            die("Action not found: $actionName in $controllerName");
        }
        
        // Parametreleri action'a gönder
        call_user_func_array([$controller, $actionName], $this->params);
    }
    
    /**
     * 404 Hatası
     */
    private function handle404() {
        http_response_code(404);
        
        // 404 view'ini yükle (varsa)
        $error404View = VIEWS_PATH . '/errors/404.php';
        if (file_exists($error404View)) {
            require $error404View;
        } else {
            echo '<h1>404 - Sayfa Bulunamadı</h1>';
            echo '<p>Aradığınız sayfa bulunamadı.</p>';
            echo '<a href="' . url('/') . '">Ana Sayfaya Dön</a>';
        }
        exit;
    }
}
