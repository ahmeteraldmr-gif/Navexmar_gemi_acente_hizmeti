<?php
/**
 * Message Model
 * Mesajlar tablosu için model sınıfı
 */

require_once __DIR__ . '/BaseModel.php';

class Message extends BaseModel {
    protected $table = 'messages';
    
    /**
     * Tüm mesajları getir (en yeni önce)
     * 
     * @return array
     */
    public function getAllMessages() {
        return $this->all([], 'created_at DESC');
    }
    
    /**
     * Okunmamış mesajları getir
     * 
     * @return array
     */
    public function getUnreadMessages() {
        return $this->all(['is_read' => 0], 'created_at DESC');
    }
    
    /**
     * Okunmuş mesajları getir
     * 
     * @return array
     */
    public function getReadMessages() {
        return $this->all(['is_read' => 1], 'created_at DESC');
    }
    
    /**
     * Okunmamış mesaj sayısı
     * 
     * @return int
     */
    public function getUnreadCount() {
        return $this->count(['is_read' => 0]);
    }
    
    /**
     * Mesajı okundu olarak işaretle
     * 
     * @param int $id Mesaj ID
     * @return bool
     */
    public function markAsRead($id) {
        return $this->update($id, ['is_read' => 1]);
    }
    
    /**
     * Mesajı okunmadı olarak işaretle
     * 
     * @param int $id Mesaj ID
     * @return bool
     */
    public function markAsUnread($id) {
        return $this->update($id, ['is_read' => 0]);
    }
    
    /**
     * Mesaj oluştur
     * 
     * @param array $data Mesaj verileri
     * @return int|bool
     */
    public function createMessage($data) {
        // XSS koruması
        $cleanData = [
            'name' => strip_tags($data['name'] ?? ''),
            'email' => filter_var($data['email'] ?? '', FILTER_SANITIZE_EMAIL),
            'phone' => strip_tags($data['phone'] ?? ''),
            'company' => strip_tags($data['company'] ?? ''),
            'service' => strip_tags($data['service'] ?? ''),
            'message' => strip_tags($data['message'] ?? ''),
            'is_read' => 0
        ];
        
        return $this->create($cleanData);
    }
    
    /**
     * Mesaj ara
     * 
     * @param string $keyword Arama kelimesi
     * @return array
     */
    public function search($keyword) {
        $sql = "SELECT * FROM {$this->table} 
                WHERE name LIKE ? 
                   OR email LIKE ? 
                   OR company LIKE ? 
                   OR message LIKE ?
                ORDER BY created_at DESC";
        
        $searchTerm = '%' . $keyword . '%';
        return $this->query($sql, [$searchTerm, $searchTerm, $searchTerm, $searchTerm]);
    }
    
    /**
     * Belirli tarih aralığındaki mesajları getir
     * 
     * @param string $startDate Başlangıç tarihi
     * @param string $endDate Bitiş tarihi
     * @return array
     */
    public function getByDateRange($startDate, $endDate) {
        $sql = "SELECT * FROM {$this->table} 
                WHERE DATE(created_at) BETWEEN ? AND ?
                ORDER BY created_at DESC";
        
        return $this->query($sql, [$startDate, $endDate]);
    }
    
    /**
     * Son N mesajı getir
     * 
     * @param int $limit Limit
     * @return array
     */
    public function getRecent($limit = 5) {
        return $this->all([], 'created_at DESC', $limit);
    }
}
