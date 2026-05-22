<?php
/**
 * Base Controller Sınıfı
 * Tüm controller'ların türeyeceği temel sınıf
 */

class BaseController {
    protected $db;
    protected $lang;
    
    /**
     * Constructor
     */
    public function __construct() {
        $this->db = getDB();
        $this->lang = getCurrentLang();
    }
    
    /**
     * View dosyasını yükle ve render et
     * 
     * @param string $view View dosyasının yolu (layouts/header, pages/home gibi)
     * @param array $data View'e gönderilecek veriler
     * @param bool $return View içeriğini döndür mü (true), yoksa echo et (false)
     * @return string|void
     */
    protected function view($view, $data = [], $return = false) {
        // Veriyi değişkenlere dönüştür
        extract($data);
        
        // View dosyasının yolunu oluştur
        $viewFile = VIEWS_PATH . '/' . $view . '.php';
        
        if (!file_exists($viewFile)) {
            die("View not found: $view");
        }
        
        if ($return) {
            ob_start();
            require $viewFile;
            return ob_get_clean();
        } else {
            require $viewFile;
        }
    }
    
    /**
     * Layout ile birlikte view render et
     * 
     * @param string $view View dosyasının yolu
     * @param array $data View'e gönderilecek veriler
     * @param string $layout Layout dosyasının adı
     */
    protected function render($view, $data = [], $layout = 'main') {
        // View içeriğini buffer'a al
        $content = $this->view($view, $data, true);
        
        // Layout içine view içeriğini gömüp render et
        $data['content'] = $content;
        $this->view('layouts/' . $layout, $data);
    }
    
    /**
     * JSON yanıt döndür
     * 
     * @param mixed $data Yanıt verisi
     * @param int $statusCode HTTP durum kodu
     */
    protected function json($data, $statusCode = 200) {
        jsonResponse($data, $statusCode);
    }
    
    /**
     * Başarılı JSON yanıt
     * 
     * @param mixed $data Veri
     * @param string $message Mesaj
     */
    protected function jsonSuccess($data = null, $message = 'İşlem başarılı') {
        $response = [
            'success' => true,
            'message' => $message
        ];
        
        if ($data !== null) {
            $response['data'] = $data;
        }
        
        $this->json($response);
    }
    
    /**
     * Hatalı JSON yanıt
     * 
     * @param string $message Hata mesajı
     * @param int $statusCode HTTP durum kodu
     */
    protected function jsonError($message = 'Bir hata oluştu', $statusCode = 400) {
        $this->json([
            'success' => false,
            'message' => $message
        ], $statusCode);
    }
    
    /**
     * Yönlendirme
     * 
     * @param string $url URL
     */
    protected function redirect($url) {
        redirect($url);
    }
    
    /**
     * POST verisi al
     * 
     * @param string $key Anahtar
     * @param mixed $default Varsayılan değer
     * @return mixed
     */
    protected function post($key = null, $default = null) {
        if ($key === null) {
            return $_POST;
        }
        return $_POST[$key] ?? $default;
    }
    
    /**
     * GET verisi al
     * 
     * @param string $key Anahtar
     * @param mixed $default Varsayılan değer
     * @return mixed
     */
    protected function get($key = null, $default = null) {
        if ($key === null) {
            return $_GET;
        }
        return $_GET[$key] ?? $default;
    }
    
    /**
     * JSON POST verisi al
     * 
     * @return array|null
     */
    protected function getJsonInput() {
        $json = file_get_contents('php://input');
        return json_decode($json, true);
    }
    
    /**
     * Form validasyonu
     * 
     * @param array $data Validasyon yapılacak veri
     * @param array $rules Validasyon kuralları
     * @return array|bool Hata varsa hata dizisi, yoksa true
     */
    protected function validate($data, $rules) {
        $errors = [];
        
        foreach ($rules as $field => $ruleSet) {
            $ruleList = explode('|', $ruleSet);
            
            foreach ($ruleList as $rule) {
                // Required kontrolü
                if ($rule === 'required' && empty($data[$field])) {
                    $errors[$field] = ucfirst($field) . ' alanı zorunludur.';
                    break;
                }
                
                // Email kontrolü
                if ($rule === 'email' && !empty($data[$field]) && !filter_var($data[$field], FILTER_VALIDATE_EMAIL)) {
                    $errors[$field] = 'Geçerli bir e-posta adresi giriniz.';
                    break;
                }
                
                // Min length kontrolü
                if (strpos($rule, 'min:') === 0) {
                    $min = (int)substr($rule, 4);
                    if (!empty($data[$field]) && strlen($data[$field]) < $min) {
                        $errors[$field] = ucfirst($field) . " en az $min karakter olmalıdır.";
                        break;
                    }
                }
                
                // Max length kontrolü
                if (strpos($rule, 'max:') === 0) {
                    $max = (int)substr($rule, 4);
                    if (!empty($data[$field]) && strlen($data[$field]) > $max) {
                        $errors[$field] = ucfirst($field) . " en fazla $max karakter olmalıdır.";
                        break;
                    }
                }
            }
        }
        
        return empty($errors) ? true : $errors;
    }
    
    /**
     * Flash mesaj ekle
     * 
     * @param string $type Mesaj tipi (success, error, warning, info)
     * @param string $message Mesaj
     */
    protected function setFlash($type, $message) {
        $_SESSION['flash'] = [
            'type' => $type,
            'message' => $message
        ];
    }
    
    /**
     * Flash mesajı al ve sil
     * 
     * @return array|null
     */
    protected function getFlash() {
        if (isset($_SESSION['flash'])) {
            $flash = $_SESSION['flash'];
            unset($_SESSION['flash']);
            return $flash;
        }
        return null;
    }
}
