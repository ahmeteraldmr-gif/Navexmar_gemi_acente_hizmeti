-- ==========================================
-- NAVEXMAR DATABASE - EXTENDED STRUCTURE
-- MVC Mimarisi için Yeni Tablolar
-- ==========================================

USE navexmar;

-- ==========================================
-- PAGES TABLOSU
-- Sayfa içerikleri (başlık, açıklama, meta)
-- ==========================================
CREATE TABLE IF NOT EXISTS pages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    page_key VARCHAR(50) NOT NULL UNIQUE COMMENT 'home, services, contact, approach, policies',
    title_tr VARCHAR(255) NOT NULL,
    title_en VARCHAR(255) NOT NULL,
    subtitle_tr TEXT,
    subtitle_en TEXT,
    meta_description_tr TEXT,
    meta_description_en TEXT,
    meta_keywords_tr TEXT,
    meta_keywords_en TEXT,
    is_active TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_page_key (page_key),
    INDEX idx_is_active (is_active)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Varsayılan sayfa içerikleri
INSERT INTO pages (page_key, title_tr, title_en, subtitle_tr, subtitle_en, meta_description_tr, meta_description_en) VALUES
('home', 'Ana Sayfa', 'Home', 'OPTİMİZASYONA ADANMIŞ', 'DEDICATED TO OPTIMIZATION', 
 'Navexmar - Gemi Bakım ve Uluslararası Ticaret Hizmetleri', 
 'Navexmar - Ship Maintenance and International Trade Services'),
 
('services', 'Hizmetlerimiz', 'Our Services', 'Denizcilik sektöründe kapsamlı çözümler', 'Comprehensive solutions in maritime industry',
 'Navexmar Hizmetleri - Gemi Bakım ve Lojistik Çözümleri',
 'Navexmar Services - Ship Maintenance and Logistics Solutions'),
 
('contact', 'İletişim', 'Contact', 'Bizimle iletişime geçin', 'Get in touch with us',
 'Navexmar İletişim - Bizimle İletişime Geçin',
 'Navexmar Contact - Get in Touch'),
 
('approach', 'Yaklaşımımız', 'Our Approach', 'İş felsefemiz ve değerlerimiz', 'Our business philosophy and values',
 'Navexmar Yaklaşımımız - İş Felsefemiz ve Değerlerimiz',
 'Navexmar Our Approach - Our Business Philosophy and Values'),
 
('policies', 'Politikalarımız', 'Our Policies', 'Kurumsal değerler ve ilkelerimiz', 'Our corporate values and principles',
 'Navexmar Politikalar - Kurumsal Politikalarımız',
 'Navexmar Policies - Our Corporate Policies')
ON DUPLICATE KEY UPDATE page_key=page_key;

-- ==========================================
-- PAGE_SECTIONS TABLOSU
-- Sayfa bölümleri (hakkımızda, floki, stats vs.)
-- ==========================================
CREATE TABLE IF NOT EXISTS page_sections (
    id INT AUTO_INCREMENT PRIMARY KEY,
    page_key VARCHAR(50) NOT NULL,
    section_key VARCHAR(50) NOT NULL,
    title_tr VARCHAR(255),
    title_en VARCHAR(255),
    content_tr TEXT,
    content_en TEXT,
    section_order INT DEFAULT 0,
    is_active TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    UNIQUE KEY unique_page_section (page_key, section_key),
    INDEX idx_page_key (page_key),
    INDEX idx_section_order (section_order)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Varsayılan bölümler
INSERT INTO page_sections (page_key, section_key, title_tr, title_en, content_tr, content_en, section_order) VALUES
('home', 'hero_title', 'EN İYİYİ KEŞFEDİN', 'DISCOVER THE BEST', '', '', 1),
('home', 'hero_subtitle', 'OPTİMİZASYONA ADANMIŞ', 'DEDICATED TO OPTIMIZATION', '', '', 2),
('home', 'hero_description', '', '', 
 'Navexmar, sektördeki diğer firmalardan farklı bir yaklaşımla gemi bakım ve uluslararası ticaret hizmetleri sunan bir şirkettir. Kuruluşumuzdan bu yana, insan odaklı, tüm ortaklarımızı kapsayan ve her yönüyle entegre bir şirket olmaya çalışıyoruz.',
 'Navexmar is a company that provides ship maintenance and international trade services with a different approach from other companies in the industry. Since our establishment, we have been trying to be a human-oriented company that includes all our partners and is integrated in every aspect.', 3),
('home', 'about_description', '', '',
 'Navexmar, sektördeki diğer firmalardan farklı bir yaklaşımla gemi bakım hizmetleri sunan bir şirkettir. Kuruluşumuzdan bu yana, insan odaklı, tüm ortaklarımızı kapsayan ve her yönüyle entegre bir şirket olmaya çalışıyoruz.',
 'Navexmar is a company that provides ship maintenance services with a different approach from other companies in the industry. Since our establishment, we have been trying to be a human-oriented company that includes all our partners and is integrated in every aspect.', 4),
('home', 'cta_title', 'Şimdi Bizimle İletişime Geçin!', 'Contact Us Now!', '', '', 5)
ON DUPLICATE KEY UPDATE page_key=page_key;

-- ==========================================
-- HEADER_IMAGES TABLOSU
-- Header görselleri yönetimi
-- ==========================================
CREATE TABLE IF NOT EXISTS header_images (
    id INT AUTO_INCREMENT PRIMARY KEY,
    page_key VARCHAR(50) NOT NULL COMMENT 'home, services, contact, approach, policies, all',
    image_name VARCHAR(255) NOT NULL,
    image_path VARCHAR(255) NOT NULL,
    image_size INT COMMENT 'Dosya boyutu byte cinsinden',
    is_active TINYINT(1) DEFAULT 1,
    display_order INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_page_key (page_key),
    INDEX idx_is_active (is_active),
    INDEX idx_display_order (display_order)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ==========================================
-- PAGE_HEADER_SETTINGS TABLOSU
-- Sayfa başına header ayarları
-- ==========================================
CREATE TABLE IF NOT EXISTS page_header_settings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    page_key VARCHAR(50) NOT NULL UNIQUE,
    selected_image_id INT,
    use_random TINYINT(1) DEFAULT 0 COMMENT '1: Rastgele görsel, 0: Seçili görsel',
    overlay_opacity DECIMAL(3,2) DEFAULT 0.50 COMMENT '0.00 - 1.00 arası',
    overlay_color VARCHAR(20) DEFAULT '#000000',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (selected_image_id) REFERENCES header_images(id) ON DELETE SET NULL,
    INDEX idx_page_key (page_key)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Varsayılan header ayarları
INSERT INTO page_header_settings (page_key, use_random, overlay_opacity) VALUES
('home', 0, 0.50),
('services', 0, 0.50),
('contact', 0, 0.50),
('approach', 0, 0.50),
('policies', 0, 0.50)
ON DUPLICATE KEY UPDATE page_key=page_key;

-- ==========================================
-- SETTINGS TABLOSU
-- Site ayarları (logo, iletişim, sosyal medya)
-- ==========================================
CREATE TABLE IF NOT EXISTS settings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    setting_key VARCHAR(100) NOT NULL UNIQUE,
    setting_value TEXT,
    setting_group VARCHAR(50) COMMENT 'general, contact, social, seo',
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_setting_key (setting_key),
    INDEX idx_setting_group (setting_group)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Varsayılan ayarlar
INSERT INTO settings (setting_key, setting_value, setting_group, description) VALUES
-- Genel Ayarlar
('site_name', 'NAVEXMAR', 'general', 'Site adı'),
('site_logo', '', 'general', 'Logo dosya yolu'),
('site_favicon', '', 'general', 'Favicon dosya yolu'),
('site_language', 'tr', 'general', 'Varsayılan dil'),
('maintenance_mode', '0', 'general', 'Bakım modu (0: Kapalı, 1: Açık)'),

-- İletişim Bilgileri
('contact_email_1', 'agency@navexmar.com', 'contact', 'Birincil e-posta'),
('contact_email_2', 'olcay@navexmar.com', 'contact', 'İkincil e-posta 1'),
('contact_email_3', 'burak@navexmar.com', 'contact', 'İkincil e-posta 2'),
('contact_phone_1', '+90 530 379 31 33', 'contact', 'Telefon 1 (Olcay)'),
('contact_phone_2', '+90 544 401 21 86', 'contact', 'Telefon 2 (Burak)'),
('contact_address', 'Numune Evler Mah/Sahil 1 Nolu Sok/no2/Dörtyol/Hatay', 'contact', 'Adres'),
('contact_city', 'Hatay', 'contact', 'Şehir'),
('contact_country', 'Türkiye', 'contact', 'Ülke'),
('working_hours', 'Zaman Kısıtı Olmaksızın 7/24 Operayyon Takibi', 'contact', 'Çalışma saatleri'),

-- Sosyal Medya
('social_facebook', '', 'social', 'Facebook URL'),
('social_twitter', '', 'social', 'Twitter URL'),
('social_linkedin', '', 'social', 'LinkedIn URL'),
('social_instagram', '', 'social', 'Instagram URL'),

-- SEO Ayarları
('seo_meta_title_tr', 'Navexmar - Gemi Bakım ve Lojistik Hizmetleri', 'seo', 'Site başlığı (TR)'),
('seo_meta_title_en', 'Navexmar - Ship Maintenance and Logistics Services', 'seo', 'Site başlığı (EN)'),
('seo_meta_description_tr', 'Navexmar, gemi bakım ve uluslararası ticaret hizmetleri sunan denizcilik şirketidir.', 'seo', 'Site açıklaması (TR)'),
('seo_meta_description_en', 'Navexmar is a maritime company providing ship maintenance and international trade services.', 'seo', 'Site açıklaması (EN)'),
('seo_meta_keywords', 'gemi bakımı, ship maintenance, denizcilik, maritime, lojistik, logistics', 'seo', 'Anahtar kelimeler'),
('google_analytics', '', 'seo', 'Google Analytics ID')
ON DUPLICATE KEY UPDATE setting_key=setting_key;

-- ==========================================
-- SERVICES TABLOSUNA YENİ KOLONLAR EKLE
-- ==========================================
ALTER TABLE services 
ADD COLUMN IF NOT EXISTS display_order INT DEFAULT 0 AFTER features_en,
ADD COLUMN IF NOT EXISTS image_path VARCHAR(255) AFTER display_order,
ADD COLUMN IF NOT EXISTS slug VARCHAR(255) AFTER image_path,
ADD INDEX IF NOT EXISTS idx_display_order (display_order),
ADD INDEX IF NOT EXISTS idx_slug (slug);

-- Slug değerlerini otomatik oluştur
UPDATE services SET slug = 'gemi-uzeri-hizmetler' WHERE id = 1 AND slug IS NULL;
UPDATE services SET slug = 'tedarik-hizmetleri' WHERE id = 2 AND slug IS NULL;
UPDATE services SET slug = 'ongorucu-bakim' WHERE id = 3 AND slug IS NULL;

-- Display order ayarla
UPDATE services SET display_order = id WHERE display_order = 0;

-- ==========================================
-- MESSAGES TABLOSUNA YENİ KOLONLAR EKLE
-- ==========================================
ALTER TABLE messages 
ADD COLUMN IF NOT EXISTS admin_note TEXT AFTER is_read,
ADD COLUMN IF NOT EXISTS replied_at TIMESTAMP NULL AFTER admin_note,
ADD INDEX IF NOT EXISTS idx_is_read (is_read);

-- ==========================================
-- ADMIN TABLOSUNA YENİ KOLONLAR EKLE
-- ==========================================
ALTER TABLE admin
ADD COLUMN IF NOT EXISTS full_name VARCHAR(255) AFTER username,
ADD COLUMN IF NOT EXISTS email VARCHAR(255) AFTER full_name,
ADD COLUMN IF NOT EXISTS last_login TIMESTAMP NULL AFTER password,
ADD COLUMN IF NOT EXISTS is_active TINYINT(1) DEFAULT 1 AFTER last_login;

-- Varsayılan admin bilgilerini güncelle
UPDATE admin SET 
    full_name = 'Admin User',
    email = 'admin@navexmar.com',
    is_active = 1
WHERE username = 'admin';
