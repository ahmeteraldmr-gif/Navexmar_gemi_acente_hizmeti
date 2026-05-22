-- ==========================================
-- NAVEXMAR COMPLETE DATABASE
-- Sunucuya Yüklemek İçin Tek SQL Dosyası
-- ==========================================

-- Veritabanını oluştur (eğer yoksa)
-- CREATE DATABASE IF NOT EXISTS navexmar CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- USE navexmar;

-- Yabancı anahtar kontrollerini geçici olarak kapat
SET FOREIGN_KEY_CHECKS = 0;

-- ==========================================
-- 1. ADMIN TABLOSU
-- ==========================================
DROP TABLE IF EXISTS admin;
CREATE TABLE admin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    full_name VARCHAR(255),
    email VARCHAR(255),
    last_login TIMESTAMP NULL,
    is_active TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_username (username),
    INDEX idx_is_active (is_active)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Varsayılan admin kullanıcısı (kullanıcı: admin, şifre: admin31)
INSERT INTO admin (username, password, full_name, email, is_active) VALUES 
('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Admin User', 'admin@navexmar.com', 1);

-- ==========================================
-- 2. SERVICES TABLOSU
-- ==========================================
DROP TABLE IF EXISTS services;
CREATE TABLE services (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    name_en VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    description_en TEXT NOT NULL,
    icon VARCHAR(100) NOT NULL DEFAULT 'fas fa-cog',
    features TEXT,
    features_en TEXT,
    display_order INT DEFAULT 0,
    image_path VARCHAR(255),
    slug VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_display_order (display_order),
    INDEX idx_slug (slug)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Varsayılan hizmetler
INSERT INTO services (name, name_en, description, description_en, icon, features, features_en, display_order, slug) VALUES
('Gemi Acenteliği Hizmetleri', 'Ship Agency Services', 
'Türk Limanlarında, İstanbul ve Çanakkale boğazlarında uzman kadromuzla hızlı, güvenilir ve 7/24 kesintisiz gemi acenteliği hizmetleri sunuyoruz.',
'We provide fast, reliable, and 24/7 uninterrupted ship agency services at Turkish Ports, Istanbul and Dardanelles straits with our expert team.',
'fas fa-ship',
'["Türk Limanlarında Yükleme ve Tahliye için Gemi Acenteliği Hizmetleri", "İstanbul ve Çanakkale Boğazlarında Gemi Acenteliği Hizmetleri", "Gemi Sahipleri, Kiralayanlar ve Gemi İşletmecileri adına Koruyucu Acentelik", "Bunker, Madeni Yağ, Su ve Tedarik ve Depo Temini", "Atık kabul hizmetleri", "Transit Yedek Parça ve Malzemelerin Transit ve Teslimi", "Personel Değiştirme İşlemleri"]',
'["Ship Agency Services for Loading and Discharging at Turkish Ports", "Ship Agency Services in Istanbul and Dardanelles Straits", "Protective Agency on behalf of Ship Owners, Charterers and Ship Operators", "Bunker, Lubricants, Water, Supply and Store Provision", "Waste reception services", "Transit and Delivery of Transit Spare Parts and Materials", "Crew Change Procedures"]',
1, 'gemi-acenteligi-hizmetleri');


-- ==========================================
-- 3. MESSAGES TABLOSU
-- ==========================================
DROP TABLE IF EXISTS messages;
CREATE TABLE messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    phone VARCHAR(50),
    company VARCHAR(255),
    service VARCHAR(255),
    message TEXT NOT NULL,
    is_read TINYINT(1) DEFAULT 0,
    admin_note TEXT,
    replied_at TIMESTAMP NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_is_read (is_read),
    INDEX idx_created_at (created_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ==========================================
-- 4. PAGES TABLOSU
-- ==========================================
DROP TABLE IF EXISTS pages;
CREATE TABLE pages (
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

-- Varsayılan sayfalar
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
 'Navexmar Policies - Our Corporate Policies');

-- ==========================================
-- 5. PAGE_SECTIONS TABLOSU
-- ==========================================
DROP TABLE IF EXISTS page_sections;
CREATE TABLE page_sections (
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
('home', 'hero_description', '', '', 'Navexmar, sektördeki diğer firmalardan farklı bir yaklaşımla gemi bakım ve uluslararası ticaret hizmetleri sunan bir şirkettir. Kuruluşumuzdan bu yana, insan odaklı, tüm ortaklarımızı kapsayan ve her yönüyle entegre bir şirket olmaya çalışıyoruz.', 'Navexmar is a company that provides ship maintenance and international trade services with a different approach from other companies in the industry. Since our establishment, we have been trying to be a human-oriented company that includes all our partners and is integrated in every aspect.', 3),
('home', 'about_description', '', '', 'Navexmar, sektördeki diğer firmalardan farklı bir yaklaşımla gemi bakım hizmetleri sunan bir şirkettir. Kuruluşumuzdan bu yana, insan odaklı, tüm ortaklarımızı kapsayan ve her yönüyle entegre bir şirket olmaya çalışıyoruz.', 'Navexmar is a company that provides ship maintenance services with a different approach from other companies in the industry. Since our establishment, we have been trying to be a human-oriented company that includes all our partners and is integrated in every aspect.', 4),
('home', 'cta_title', 'Şimdi Bizimle İletişime Geçin!', 'Contact Us Now!', '', '', 5),
('approach', 'intro', 'Farklı Bir Bakış Açısı', 'A Different Perspective', 'Navexmar, sektördeki diğer firmalardan farklı bir yaklaşımla gemi bakım ve uluslararası ticaret hizmetleri sunan bir şirkettir. Kuruluşumuzdan bu yana, insan odaklı, tüm ortaklarımızı kapsayan ve her yönüyle entegre bir şirket olmaya çalışıyoruz. Müşterilerimize en iyi hizmeti sunmak için sürekli gelişim ve yenilikçilik ilkelerimizle hareket ediyoruz.', 'Navexmar is a company that provides ship maintenance and international trade services with a different approach from other companies in the industry. Since our establishment, we have been trying to be a human-oriented company that includes all our partners and is integrated in every aspect. We operate with the principles of continuous improvement and innovation to provide the best service to our customers.', 1),
('approach', 'card_1', 'İnsan Odaklı', 'People-Oriented', 'Çalışanlarımız ve iş ortaklarımızla kurduğumuz güçlü ilişkiler, başarımızın temel taşıdır. Her bireyin değerini bilir ve onların gelişimine katkıda bulunuruz.', 'The strong relationships we establish with our employees and business partners are the cornerstone of our success. We recognize the value of each individual and contribute to their development.', 2),
('approach', 'card_2', 'Kapsayıcı Ortaklık', 'Inclusive Partnership', 'Tüm paydaşlarımızı sürece dahil eder, şeffaf ve dürüst bir iletişim ile uzun vadeli ortaklıklar kurarız. Birlikte başarıya ulaşma inancıyla hareket ederiz.', 'We involve all our stakeholders in the process, establish long-term partnerships with transparent and honest communication. We act with the belief of achieving success together.', 3),
('approach', 'card_3', 'Entegre Çözümler', 'Integrated Solutions', 'Her yönüyle entegre sistemlerimiz sayesinde müşterilerimize kapsamlı ve kesintisiz hizmet sunuyoruz. Tek noktadan tüm ihtiyaçlarınıza çözüm üretiyoruz.', 'Thanks to our fully integrated systems, we provide comprehensive and uninterrupted service to our customers. We provide solutions to all your needs from a single point.', 4),
('approach', 'card_4', 'Yenilikçilik', 'Innovation', 'Teknolök gelişmeleri yakından takip eder, sektördeki yenilikleri hızla adapte ederiz. Sürekli gelişim ve iyileştirme odaklı çalışırız.', 'We closely follow technological developments and quickly adapt innovations in the industry. We work with a focus on continuous improvement.', 5),
('approach', 'card_5', 'Kalite ve Güvenilirlik', 'Quality and Reliability', 'Verdiğimiz hizmetlerde en yüksek kalite standartlarını benimser, güvenilir ve zamanında teslimat garantisi veririz. Müşteri memnuniyeti önceliğimizdir.', 'We adopt the highest quality standards in our services, guarantee reliable and on-time delivery. Customer satisfaction is our priority.', 6),
('approach', 'card_6', 'Küresel Ağ', 'Global Network', 'Dünya çapında geniş tedarikçi ve iş ortağı ağımız sayesinde, her coğrafyada hızlı ve etkili hizmet sunabiliyoruz. Yerel bilgi, global çözümler.', 'Thanks to our extensive network of suppliers and partners worldwide, we can provide fast and effective service in every geography. Local knowledge, global solutions.', 7),
('approach', 'mission', 'Misyonumuz', 'Our Mission', 'Denizcilik sektöründe en güvenilir iş ortağı olmak, müşterilerimize en yüksek kalitede hizmet sunarak operasyonel verimliliğe ve sürdürülebilir başarıya katkıda bulunmak.', 'To be the most reliable business partner in the maritime industry, contributing to operational efficiency and sustainable success by providing the highest quality service to our customers.', 8),
('approach', 'vision', 'Vizyonumuz', 'Our Vision', 'Bölgesel lider konumumuzu koruyarak, küresel ölçekte tanınan ve tercih edilen bir denizcilik hizmetleri şirketi olmak, sektöre yenilikçi çözümler sunmaya devam etmek.', 'To maintain our regional leadership position, to become a globally recognized and preferred maritime services company, and to continue providing innovative solutions to the industry.', 9),
('approach', 'cta', 'Bizimle Çalışmak İster Misiniz?', 'Would You Like to Work With Us?', '', '', 10),
('policies', 'intro', 'Kurumsal Politikalarımız', 'Our Corporate Policies', 'Navexmar olarak, tüm faaliyetlerimizde uluslararası standartlara uygun, etik ve sorumlu bir yaklaşım benimsiyoruz. Politikalarımız, sürdürülebilir başarı için yol haritamızdır.', 'As Navexmar, we adopt an ethical and responsible approach in all our activities in accordance with international standards. Our policies are our roadmap for sustainable success.', 1),
('policies', 'card_1', 'Kalite Politikası', 'Quality Policy', 'Müşteri memnuniyetini ön planda tutarak, uluslararası kalite standartlarına uygun, güvenilir ve sürdürülebilir hizmetler sunmayı taahhüt ediyoruz.', 'We are committed to providing reliable and sustainable services in accordance with international quality standards, keeping customer satisfaction at the forefront.', 2),
('policies', 'card_2', 'İş Sağlığı ve Güvenliği', 'Occupational Health and Safety', 'Çalışanlarımızın ve iş ortaklarımızın sağlığı ve güvenliği bizim için en önemli önceliktir. Sıfır kaza hedefiyle çalışıyoruz.', 'The health and safety of our employees and business partners is our top priority. We work with a zero accident target.', 3),
('policies', 'card_3', 'Çevre Politikası', 'Environmental Policy', 'Çevreye duyarlı çalışma prensiplerimizle, gelecek nesillere yaşanabilir bir çevre bırakmayı hedefliyoruz.', 'With our environmentally sensitive working principles, we aim to leave a livable environment for future generations.', 4),
('policies', 'card_4', 'Etik ve Uyum', 'Ethics and Compliance', 'Tüm iş süreçlerimizde dürüstlük, şeffaflık ve adil rekabet ilkelerine bağlı kalıyoruz.', 'We adhere to the principles of honesty, transparency and fair competition in all our business processes.', 5),
('policies', 'card_5', 'Kişisel Verilerin Korunması', 'Data Protection', 'KVKK kapsamında, kişisel verilerin korunmasına azami özen gösteriyoruz.', 'We take utmost care in the protection of personal data within the scope of GDPR.', 6),
('policies', 'card_6', 'Bilgi Güvenliği', 'Information Security', 'Kurumsal ve müşteri bilgilerinin gizliliği, bütünlüğü ve erişilebilirliğini korumak için modern güvenlik sistemleri uyguluyoruz.', 'We implement modern security systems to protect the confidentiality, integrity and accessibility of corporate and customer information.', 7),
('policies', 'commit_1', 'Sıfır Kaza', 'Zero Accidents', 'Tüm operasyonlarımızda güvenlik önceliğimiz', 'Safety is our priority in all operations', 8),
('policies', 'commit_2', '%100 Müşteri Memnuniyeti', '100% Customer Satisfaction', 'Her projede mükemmellik arayışı', 'Pursuit of excellence in every project', 9),
('policies', 'commit_3', 'Çevreye Saygı', 'Respect for Environment', 'Sürdürülebilir denizcilik için çalışıyoruz', 'Working for sustainable maritime', 10),
('policies', 'commit_4', 'Etik Değerler', 'Ethical Values', 'Dürüstlük ve şeffaflık her zaman', 'Honesty and transparency always', 11),
('policies', 'cta', 'Politikalarımız Hakkında Daha Fazla Bilgi Almak İster Misiniz?', 'Would You Like More Information About Our Policies?', '', '', 12);


-- ==========================================
-- 6. HEADER_IMAGES TABLOSU
-- ==========================================
DROP TABLE IF EXISTS header_images;
CREATE TABLE header_images (
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

-- Varsayılan header görselleri
INSERT INTO header_images (id, page_key, image_name, image_path, image_size, is_active, display_order) VALUES
(1, 'home', '1.jpeg', 'headers/1.jpeg', 254923, 1, 1),
(2, 'services', '2.jpeg', 'headers/2.jpeg', 124139, 1, 1),
(3, 'approach', '3.jpeg', 'headers/3.jpeg', 131836, 1, 1),
(4, 'contact', '4.jpeg', 'headers/4.jpeg', 183363, 1, 1),
(5, 'policies', '5.jpeg', 'headers/5.jpeg', 173330, 1, 1);

-- ==========================================
-- 7. PAGE_HEADER_SETTINGS TABLOSU
-- ==========================================
DROP TABLE IF EXISTS page_header_settings;
CREATE TABLE page_header_settings (
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
INSERT INTO page_header_settings (page_key, selected_image_id, use_random, overlay_opacity) VALUES
('home', 1, 0, 0.50),
('services', 2, 0, 0.50),
('contact', 4, 0, 0.50),
('approach', 3, 0, 0.50),
('policies', 5, 0, 0.50);

-- ==========================================
-- 8. SETTINGS TABLOSU
-- ==========================================
DROP TABLE IF EXISTS settings;
CREATE TABLE settings (
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
('google_analytics', '', 'seo', 'Google Analytics ID');

-- Yabancı anahtar kontrollerini tekrar aç
SET FOREIGN_KEY_CHECKS = 1;

-- ==========================================
-- TAMAMLANDI!
-- ==========================================
-- Bu SQL dosyasını MySQL'e import edin:
-- mysql -u kullanici_adi -p veritabani_adi < database_complete.sql
-- 
-- Admin Giriş Bilgileri:
-- Kullanıcı: admin
-- Şifre: admin31
-- ==========================================
