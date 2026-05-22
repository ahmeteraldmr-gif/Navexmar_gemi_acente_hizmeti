<?php
/**
 * Auth Controller
 * Kullanıcı kimlik doğrulama (giriş/çıkış) için controller
 */

require_once SRC_PATH . '/Controllers/BaseController.php';

class AuthController extends BaseController {
    
    /**
     * Login Sayfası
     */
    public function login() {
        // Zaten giriş yapmışsa admin panele yönlendir
        if (isLoggedIn()) {
            $this->redirect(url('/admin'));
            return;
        }
        
        // Flash mesajı varsa al
        $flash = $this->getFlash();
        
        // Login view'ini göster
        $this->view('admin/login', [
            'flash' => $flash
        ]);
    }
    
    /**
     * Login İşlemi (POST)
     */
    public function authenticate() {
        // Zaten giriş yapmışsa admin panele yönlendir
        if (isLoggedIn()) {
            $this->redirect(url('/admin'));
            return;
        }
        
        // Form verilerini al
        $username = $this->post('username');
        $password = $this->post('password');
        
        // Validasyon
        if (empty($username) || empty($password)) {
            $this->setFlash('error', 'Kullanıcı adı ve şifre gereklidir.');
            $this->redirect(url('/admin/login'));
            return;
        }
        
        // Kullanıcıyı veritabanından getir
        try {
            $stmt = $this->db->prepare("SELECT * FROM admin WHERE username = ? AND is_active = 1 LIMIT 1");
            $stmt->execute([$username]);
            $admin = $stmt->fetch();
            
            if (!$admin) {
                $this->setFlash('error', 'Kullanıcı adı veya şifre hatalı.');
                $this->redirect(url('/admin/login'));
                return;
            }
            
            // Şifre kontrolü
            $passwordValid = false;
            
            // Önce hash'lenmiş şifre kontrolü
            if (password_verify($password, $admin['password'])) {
                $passwordValid = true;
                
                // Şifre hash'ini güncelle (gerekirse)
                if (password_needs_rehash($admin['password'], PASSWORD_BCRYPT)) {
                    $newHash = password_hash($password, PASSWORD_BCRYPT);
                    $updateStmt = $this->db->prepare("UPDATE admin SET password = ? WHERE id = ?");
                    $updateStmt->execute([$newHash, $admin['id']]);
                }
            }
            // Düz metin kontrolü (ilk giriş için backward compatibility)
            elseif ($username === 'admin' && $password === 'admin31' && $admin['password'] === 'admin31') {
                $passwordValid = true;
                
                // Şifreyi hash'le ve güncelle
                $newHash = password_hash($password, PASSWORD_BCRYPT);
                $updateStmt = $this->db->prepare("UPDATE admin SET password = ? WHERE id = ?");
                $updateStmt->execute([$newHash, $admin['id']]);
            }
            
            if (!$passwordValid) {
                $this->setFlash('error', 'Kullanıcı adı veya şifre hatalı.');
                $this->redirect(url('/admin/login'));
                return;
            }
            
            // Session'a kaydet
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_id'] = $admin['id'];
            $_SESSION['admin_username'] = $admin['username'];
            $_SESSION['admin_full_name'] = $admin['full_name'] ?? 'Admin';
            
            // Son giriş zamanını güncelle
            $updateLoginStmt = $this->db->prepare("UPDATE admin SET last_login = NOW() WHERE id = ?");
            $updateLoginStmt->execute([$admin['id']]);
            
            // Admin panele yönlendir
            $this->redirect(url('/admin'));
            
        } catch (PDOException $e) {
            $this->setFlash('error', 'Bir hata oluştu. Lütfen tekrar deneyin.');
            $this->redirect(url('/admin/login'));
        }
    }
    
    /**
     * Çıkış İşlemi
     */
    public function logout() {
        logout();
        $this->setFlash('success', 'Başarıyla çıkış yaptınız.');
        $this->redirect(url('/admin/login'));
    }
}
