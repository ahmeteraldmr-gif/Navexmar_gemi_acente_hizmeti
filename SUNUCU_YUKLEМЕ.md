# 🚀 Navexmar Sunucuya Yükleme Rehberi

## 📦 Yüklenecek Dosyalar

Sunucuya şu klasör ve dosyaları yükleyin:

```
navexmar/
├── config/              ✓ Yükle
├── database/            ✓ Yükle (opsiyonel, sadece migrations)
├── public/              ✓ Yükle (tüm assets ve uploads)
├── src/                 ✓ Yükle (tüm MVC kodları)
├── .htaccess            ✓ Yükle (root yönlendirme)
├── database_complete.sql ✓ İmport et (aşağıda açıklandı)
└── README_MVC.md        ✓ Referans için
```

**❌ YÜKLEME:**
- README dosyaları (opsiyonel)
- MIGRATION_SUMMARY.md (opsiyonel)
- Eski yedek dosyalar varsa

## 🗄️ 1. Veritabanını Kurma

### Yöntem 1: phpMyAdmin (Önerilen - Kolay)

1. cPanel'e giriş yapın
2. **phpMyAdmin**'i açın
3. Sol taraftan veritabanınızı seçin (veya yeni oluşturun)
4. Üst menüden **"İçe Aktar" (Import)** sekmesine tıklayın
5. **"Dosya seçin"** butonuna tıklayın
6. `database_complete.sql` dosyasını seçin
7. **"Git" (Go)** butonuna tıklayın
8. İşlem tamamlanana kadar bekleyin
9. ✅ "Import başarıyla tamamlandı" mesajını görmelisiniz

### Yöntem 2: Terminal/SSH

```bash
# SSH ile sunucuya bağlanın
ssh kullanici@sunucu.com

# Veritabanını import edin
mysql -u veritabani_kullanicisi -p veritabani_adi < database_complete.sql
# Şifrenizi girin
```

### Yöntem 3: cPanel File Manager

1. File Manager'da `database_complete.sql` dosyasını yükleyin
2. phpMyAdmin'de "SQL" sekmesine gidin
3. Dosyayı seçip import edin

## ⚙️ 2. Veritabanı Bilgilerini Güncelleme

`config/database.php` dosyasını düzenleyin:

```php
// PRODUCTION (SUNUCU) AYARLARI bölümünü güncelleyin:
define('DB_HOST', 'localhost');        // Genelde localhost
define('DB_PORT', '3306');             // Varsayılan port
define('DB_USER', 'sizin_db_kullanici'); // cPanel'den alın
define('DB_PASS', 'sizin_db_sifre');    // cPanel'den alın
define('DB_NAME', 'sizin_db_adi');      // cPanel'den alın
```

**Not:** cPanel > MySQL Databases bölümünden veritabanı bilgilerinizi alabilirsiniz.

## 📁 3. Dosya İzinlerini Ayarlama

### File Manager Üzerinden:
1. `public/uploads/` klasörüne sağ tıklayın
2. **"Change Permissions"** (İzinleri Değiştir) seçin
3. **755** veya **775** yapın
4. **"Recurse into subdirectories"** işaretleyin
5. Apply

### SSH Üzerinden:
```bash
cd /home/kullanici/public_html/navexmar
chmod -R 755 public/uploads/
chmod -R 755 public/assets/
```

## 🌐 4. Web Sunucu Ayarları

### A. Domain/Subdomain Ayarları

#### Seçenek 1: Ana Domain (Önerilen)
cPanel > Domains > "Document Root" ayarını yapın:
```
/home/kullanici/public_html/navexmar/public
```

#### Seçenek 2: Subdomain
Subdomain oluşturun (örn: navexmar.siteadi.com):
```
Document Root: /home/kullanici/public_html/navexmar/public
```

#### Seçenek 3: Alt Klasör
Eğer alt klasörde çalışacaksa (örn: siteadi.com/navexmar):
- `navexmar` klasörünü `public_html` içine yükleyin
- Root `.htaccess` otomatik olarak `/public` klasörüne yönlendirir

### B. Apache Ayarları (Otomatik)
`.htaccess` dosyaları zaten yapılandırılmış:
- ✓ mod_rewrite aktif (çoğu sunucuda varsayılan)
- ✓ Temiz URL'ler
- ✓ Security headers

## 🔐 5. İlk Giriş

1. Tarayıcınızda sitenizi açın: `http://yourdomain.com`
2. Admin panele giriş için: `http://yourdomain.com/admin/login`

**Varsayılan Admin Bilgileri:**
```
Kullanıcı Adı: admin
Şifre: admin31
```

⚠️ **ÖNEMLİ:** İlk girişten sonra mutlaka şifrenizi değiştirin!

## 🎨 6. Header Görsellerini Ayarlama

1. Admin panele giriş yapın
2. Sol menüden **"Header Görselleri"** seçin
3. `public/uploads/headers/` klasöründe mevcut görseller görünmelidir
4. Her sayfa için:
   - Görsel seçin
   - veya Yeni görsel yükleyin
   - Sayfaya atayın
   - Rastgele seçim aktif/pasif yapın

## ✅ 7. Kontrol Listesi

Test edin:
- [ ] Ana sayfa açılıyor mu? (`/`)
- [ ] Hizmetler sayfası çalışıyor mu? (`/hizmetlerimiz`)
- [ ] İletişim formu gönderiliyor mu? (`/iletisim`)
- [ ] Admin panele giriş yapılabiliyor mu? (`/admin/login`)
- [ ] Admin dashboard açılıyor mu? (`/admin`)
- [ ] Görseller görüntüleniyor mu?
- [ ] CSS/JS dosyaları yükleniyor mu?

## 🐛 Sorun Giderme

### 1. "500 Internal Server Error"
**Çözüm:**
- `.htaccess` dosyalarının yüklendiğinden emin olun
- File Manager'da "Show Hidden Files" aktif olmalı
- İzinleri kontrol edin (755 olmalı)
- PHP sürümü 7.4+ olmalı (cPanel > Select PHP Version)

### 2. "Database Connection Error"
**Çözüm:**
- `config/database.php` dosyasındaki bilgileri kontrol edin
- cPanel > MySQL Databases'den kullanıcı izinlerini kontrol edin
- Veritabanı kullanıcısının veritabanına erişim izni var mı?

### 3. CSS/JS Dosyaları Yüklenmiyor
**Çözüm:**
- `public/assets/` klasörünün yüklendiğinden emin olun
- İzinleri kontrol edin (755)
- Tarayıcı önbelleğini temizleyin (Ctrl+F5)

### 4. Görseller Görünmüyor
**Çözüm:**
- `public/uploads/headers/` klasörünü kontrol edin
- Görseller admin panelden yüklendi/atandı mı?
- İzinleri kontrol edin (755)

### 5. Admin Panele Giremiyorum
**Çözüm:**
- `database_complete.sql` doğru import edildi mi?
- `admin` tablosu oluşturuldu mu?
- Kullanıcı: `admin`, Şifre: `admin31`

### 6. "404 Not Found" Hataları
**Çözüm:**
- `.htaccess` dosyaları yüklendi mi?
- Apache `mod_rewrite` modülü aktif mi?
- DocumentRoot doğru ayarlandı mı? (`public/` klasörüne)

## 📊 Performans İyileştirmeleri (Opsiyonel)

### 1. Gzip Sıkıştırma
`.htaccess` dosyasına ekleyin:
```apache
<IfModule mod_deflate.c>
    AddOutputFilterByType DEFLATE text/html text/plain text/xml text/css text/javascript application/javascript
</IfModule>
```

### 2. Tarayıcı Önbelleği
`.htaccess` dosyasına ekleyin:
```apache
<IfModule mod_expires.c>
    ExpiresActive On
    ExpiresByType image/jpg "access plus 1 year"
    ExpiresByType image/jpeg "access plus 1 year"
    ExpiresByType image/gif "access plus 1 year"
    ExpiresByType image/png "access plus 1 year"
    ExpiresByType text/css "access plus 1 month"
    ExpiresByType application/javascript "access plus 1 month"
</IfModule>
```

### 3. PHP Optimizasyonu
cPanel > Select PHP Version > Options:
- `memory_limit`: 256M
- `upload_max_filesize`: 10M
- `post_max_size`: 10M
- `max_execution_time`: 300

## 📞 Yardım

Sorun yaşarsanız:
1. Hata mesajını not alın
2. `README_MVC.md` dosyasını okuyun
3. cPanel > Error Logs'u kontrol edin
4. PHP error_log dosyasını kontrol edin

## ✨ Başarılı Kurulum!

Artık siteniz yayında! 

**Yapılacaklar:**
1. ✅ Admin şifresini değiştirin
2. ✅ Site ayarlarını güncelleyin (`/admin/settings`)
3. ✅ Header görsellerini atayın (`/admin/headers`)
4. ✅ Hizmetleri kontrol edin (`/admin/services`)
5. ✅ Sosyal medya linklerini ekleyin (`/admin/settings`)

---
**Not:** Bu rehber cPanel kullanan sunucular için hazırlanmıştır. Farklı bir kontrol paneli kullanıyorsanız, adımlar benzer olacaktır.
