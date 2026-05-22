<?php
/**
 * Page Model
 * Sayfalar ve sayfa içerikleri için model sınıfı
 */

require_once __DIR__ . '/BaseModel.php';

class Page extends BaseModel {
    protected $table = 'pages';
    protected $primaryKey = 'id';
    
    /**
     * Page key'e göre sayfa getir
     * 
     * @param string $pageKey Sayfa key'i (home, services, contact vs.)
     * @return array|null
     */
    public function getByKey($pageKey) {
        return $this->findBy(['page_key' => $pageKey, 'is_active' => 1]);
    }
    
    /**
     * Tüm aktif sayfaları getir
     * 
     * @return array
     */
    public function getActivePages() {
        return $this->all(['is_active' => 1], 'page_key ASC');
    }
    
    /**
     * Sayfa içeriğini güncelle
     * 
     * @param string $pageKey Sayfa key'i
     * @param array $data Güncellenecek veriler
     * @return bool
     */
    public function updateByKey($pageKey, $data) {
        $page = $this->getByKey($pageKey);
        if ($page) {
            return $this->update($page['id'], $data);
        }
        return false;
    }
    
    /**
     * Sayfa bölümlerini getir
     * 
     * @param string $pageKey Sayfa key'i
     * @return array
     */
    public function getSections($pageKey) {
        $sql = "SELECT * FROM page_sections 
                WHERE page_key = ? AND is_active = 1 
                ORDER BY section_order ASC";
        
        return $this->query($sql, [$pageKey]);
    }
    
    /**
     * Belirli bir section'ı getir
     * 
     * @param string $pageKey Sayfa key'i
     * @param string $sectionKey Section key'i
     * @return array|null
     */
    public function getSection($pageKey, $sectionKey) {
        $sql = "SELECT * FROM page_sections 
                WHERE page_key = ? AND section_key = ? AND is_active = 1 
                LIMIT 1";
        
        return $this->queryOne($sql, [$pageKey, $sectionKey]);
    }
    
    /**
     * Section içeriğini güncelle
     * 
     * @param string $pageKey Sayfa key'i
     * @param string $sectionKey Section key'i
     * @param array $data Güncellenecek veriler
     * @return bool
     */
    public function updateSection($pageKey, $sectionKey, $data) {
        $sql = "UPDATE page_sections 
                SET title_tr = ?, title_en = ?, content_tr = ?, content_en = ?, updated_at = NOW()
                WHERE page_key = ? AND section_key = ?";
        
        $params = [
            $data['title_tr'] ?? '',
            $data['title_en'] ?? '',
            $data['content_tr'] ?? '',
            $data['content_en'] ?? '',
            $pageKey,
            $sectionKey
        ];
        
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($params);
    }
    
    /**
     * Yeni section ekle
     * 
     * @param array $data Section verileri
     * @return int|bool
     */
    public function createSection($data) {
        $sql = "INSERT INTO page_sections 
                (page_key, section_key, title_tr, title_en, content_tr, content_en, section_order, is_active) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        
        $params = [
            $data['page_key'],
            $data['section_key'],
            $data['title_tr'] ?? '',
            $data['title_en'] ?? '',
            $data['content_tr'] ?? '',
            $data['content_en'] ?? '',
            $data['section_order'] ?? 0,
            $data['is_active'] ?? 1
        ];
        
        $stmt = $this->db->prepare($sql);
        if ($stmt->execute($params)) {
            return $this->db->lastInsertId();
        }
        
        return false;
    }
    
    /**
     * Section sil
     * 
     * @param string $pageKey Sayfa key'i
     * @param string $sectionKey Section key'i
     * @return bool
     */
    public function deleteSection($pageKey, $sectionKey) {
        $sql = "DELETE FROM page_sections WHERE page_key = ? AND section_key = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$pageKey, $sectionKey]);
    }
}
