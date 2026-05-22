<?php
/**
 * Setting Model
 * Site ayarları için model sınıfı
 */

require_once __DIR__ . '/BaseModel.php';

class Setting extends BaseModel {
    protected $table = 'settings';
    private static $cache = [];
    
    /**
     * Ayar değerini getir
     * 
     * @param string $key Ayar anahtarı
     * @param mixed $default Varsayılan değer
     * @return mixed
     */
    public function get($key, $default = null) {
        // Cache'de var mı kontrol et
        if (isset(self::$cache[$key])) {
            return self::$cache[$key];
        }
        
        $setting = $this->findBy(['setting_key' => $key]);
        
        if ($setting) {
            $value = $setting['setting_value'];
            self::$cache[$key] = $value;
            return $value;
        }
        
        return $default;
    }
    
    /**
     * Ayar değerini güncelle veya oluştur
     * 
     * @param string $key Ayar anahtarı
     * @param mixed $value Değer
     * @param string $group Grup
     * @param string $description Açıklama
     * @return bool
     */
    public function set($key, $value, $group = 'general', $description = '') {
        $existing = $this->findBy(['setting_key' => $key]);
        
        // Cache'i güncelle
        self::$cache[$key] = $value;
        
        if ($existing) {
            // Güncelle
            return $this->update($existing['id'], [
                'setting_value' => $value,
                'setting_group' => $group,
                'description' => $description
            ]);
        } else {
            // Oluştur
            return $this->create([
                'setting_key' => $key,
                'setting_value' => $value,
                'setting_group' => $group,
                'description' => $description
            ]);
        }
    }
    
    /**
     * Gruba göre ayarları getir
     * 
     * @param string $group Grup adı
     * @return array Anahtar-değer çiftleri
     */
    public function getByGroup($group) {
        $settings = $this->all(['setting_group' => $group], 'setting_key ASC');
        
        $result = [];
        foreach ($settings as $setting) {
            $result[$setting['setting_key']] = $setting['setting_value'];
            // Cache'e ekle
            self::$cache[$setting['setting_key']] = $setting['setting_value'];
        }
        
        return $result;
    }
    
    /**
     * Tüm ayarları getir (anahtar-değer çiftleri olarak)
     * 
     * @return array
     */
    public function getAllSettings() {
        $settings = $this->all([], 'setting_group ASC, setting_key ASC');
        
        $result = [];
        foreach ($settings as $setting) {
            $result[$setting['setting_key']] = $setting['setting_value'];
            // Cache'e ekle
            self::$cache[$setting['setting_key']] = $setting['setting_value'];
        }
        
        return $result;
    }
    
    /**
     * Tüm ayarları gruplandırılmış olarak getir
     * 
     * @return array
     */
    public function getAllGrouped() {
        $settings = $this->all([], 'setting_group ASC, setting_key ASC');
        
        $result = [];
        foreach ($settings as $setting) {
            $group = $setting['setting_group'] ?? 'general';
            if (!isset($result[$group])) {
                $result[$group] = [];
            }
            $result[$group][] = $setting;
            // Cache'e ekle
            self::$cache[$setting['setting_key']] = $setting['setting_value'];
        }
        
        return $result;
    }
    
    /**
     * Çoklu ayar güncelle
     * 
     * @param array $settings Anahtar-değer çiftleri
     * @return bool
     */
    public function updateMultiple($settings) {
        try {
            $this->db->beginTransaction();
            
            foreach ($settings as $key => $value) {
                $existing = $this->findBy(['setting_key' => $key]);
                
                if ($existing) {
                    $this->update($existing['id'], ['setting_value' => $value]);
                } else {
                    $this->create([
                        'setting_key' => $key,
                        'setting_value' => $value,
                        'setting_group' => 'general'
                    ]);
                }
                
                // Cache'i güncelle
                self::$cache[$key] = $value;
            }
            
            $this->db->commit();
            return true;
        } catch (Exception $e) {
            $this->db->rollBack();
            return false;
        }
    }
    
    /**
     * İletişim bilgilerini getir
     * 
     * @return array
     */
    public function getContactInfo() {
        return $this->getByGroup('contact');
    }
    
    /**
     * Sosyal medya linklerini getir
     * 
     * @return array
     */
    public function getSocialLinks() {
        return $this->getByGroup('social');
    }
    
    /**
     * SEO ayarlarını getir
     * 
     * @return array
     */
    public function getSeoSettings() {
        return $this->getByGroup('seo');
    }
    
    /**
     * Cache'i temizle
     */
    public static function clearCache() {
        self::$cache = [];
    }
}
