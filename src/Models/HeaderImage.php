<?php
/**
 * HeaderImage Model
 * Header görselleri için model sınıfı
 */

require_once __DIR__ . '/BaseModel.php';

class HeaderImage extends BaseModel {
    protected $table = 'header_images';
    
    /**
     * Tüm aktif görselleri getir
     * 
     * @return array
     */
    public function getAllActive() {
        return $this->all(['is_active' => 1], 'display_order ASC, created_at DESC');
    }
    
    /**
     * Sayfaya göre görselleri getir
     * 
     * @param string $pageKey Sayfa key'i
     * @return array
     */
    public function getByPage($pageKey) {
        return $this->all(['page_key' => $pageKey, 'is_active' => 1], 'display_order ASC');
    }
    
    /**
     * Sayfa için header görseli getir
     * Ayarlara göre seçili veya rastgele görsel döner
     * 
     * @param string $pageKey Sayfa key'i
     * @return array|null
     */
    public function getPageHeaderImage($pageKey) {
        // Sayfa ayarlarını getir
        $sql = "SELECT * FROM page_header_settings WHERE page_key = ? LIMIT 1";
        $settings = $this->queryOne($sql, [$pageKey]);
        
        if (!$settings) {
            // Ayar yoksa varsayılan ayarları kullan
            $settings = [
                'use_random' => 0,
                'selected_image_id' => null
            ];
        }
        
        // Rastgele görsel seçilecek mi?
        if ($settings['use_random'] == 1) {
            return $this->getRandomImage($pageKey);
        }
        
        // Seçili görsel var mı?
        if ($settings['selected_image_id']) {
            $image = $this->find($settings['selected_image_id']);
            if ($image && $image['is_active'] == 1) {
                return $image;
            }
        }
        
        // Hiçbiri yoksa sayfanın ilk görselini döndür
        $images = $this->getByPage($pageKey);
        return !empty($images) ? $images[0] : null;
    }
    
    /**
     * Rastgele bir header görseli getir
     * 
     * @param string $pageKey Sayfa key'i
     * @return array|null
     */
    private function getRandomImage($pageKey) {
        $sql = "SELECT * FROM {$this->table} 
                WHERE page_key = ? AND is_active = 1 
                ORDER BY RAND() 
                LIMIT 1";
        
        return $this->queryOne($sql, [$pageKey]);
    }
    
    /**
     * Görsel yükle
     * 
     * @param array $data Görsel verileri
     * @return int|bool
     */
    public function uploadImage($data) {
        // Display order ayarla
        if (!isset($data['display_order'])) {
            $maxOrder = $this->queryOne("SELECT MAX(display_order) as max_order FROM {$this->table} WHERE page_key = ?", [$data['page_key']]);
            $data['display_order'] = ($maxOrder['max_order'] ?? 0) + 1;
        }
        
        return $this->create($data);
    }
    
    /**
     * Görseli aktif/pasif yap
     * 
     * @param int $id Görsel ID
     * @return bool
     */
    public function toggleActive($id) {
        $image = $this->find($id);
        if ($image) {
            $newStatus = $image['is_active'] == 1 ? 0 : 1;
            return $this->update($id, ['is_active' => $newStatus]);
        }
        return false;
    }
    
    /**
     * Sayfa için header ayarlarını getir
     * 
     * @param string $pageKey Sayfa key'i
     * @return array|null
     */
    public function getPageSettings($pageKey) {
        $sql = "SELECT * FROM page_header_settings WHERE page_key = ? LIMIT 1";
        return $this->queryOne($sql, [$pageKey]);
    }
    
    /**
     * Sayfa için header ayarlarını güncelle veya oluştur
     * 
     * @param string $pageKey Sayfa key'i
     * @param array $settings Ayarlar
     * @return bool
     */
    public function updatePageSettings($pageKey, $settings) {
        $existing = $this->getPageSettings($pageKey);
        
        if ($existing) {
            // Güncelle
            $sql = "UPDATE page_header_settings 
                    SET selected_image_id = ?, use_random = ?, overlay_opacity = ?, overlay_color = ?, updated_at = NOW()
                    WHERE page_key = ?";
            
            $params = [
                $settings['selected_image_id'] ?? null,
                $settings['use_random'] ?? 0,
                $settings['overlay_opacity'] ?? 0.5,
                $settings['overlay_color'] ?? '#000000',
                $pageKey
            ];
        } else {
            // Oluştur
            $sql = "INSERT INTO page_header_settings 
                    (page_key, selected_image_id, use_random, overlay_opacity, overlay_color) 
                    VALUES (?, ?, ?, ?, ?)";
            
            $params = [
                $pageKey,
                $settings['selected_image_id'] ?? null,
                $settings['use_random'] ?? 0,
                $settings['overlay_opacity'] ?? 0.5,
                $settings['overlay_color'] ?? '#000000'
            ];
        }
        
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($params);
    }
    
    /**
     * Görsel sıralamasını güncelle
     * 
     * @param array $order ID ve sıra çiftleri
     * @return bool
     */
    public function updateOrder($order) {
        try {
            $this->db->beginTransaction();
            
            foreach ($order as $item) {
                $this->update($item['id'], ['display_order' => $item['order']]);
            }
            
            $this->db->commit();
            return true;
        } catch (Exception $e) {
            $this->db->rollBack();
            return false;
        }
    }
}
