# 🚀 Hızlı Çözüm - CSS/JS Yüklenmiyor

## Sorun
- `https://navexmar.com` → 404 Sayfa Bulunamadı
- `https://navexmar.com/public/` → Sayfa açılıyor ama CSS/JS yüklenmiyor

## ✅ Çözüm (3 Seçenek)

---

### Seçenek 1: cPanel'de Document Root Ayarla (EN İYİ ÇÖZÜM)

**Adımlar:**
1. cPanel'e giriş yapın
2. **"Domains"** veya **"Addon Domains"** bölümüne gidin
3. `navexmar.com` domain'ini bulun
4. **"Manage"** veya **"Edit"** butonuna tıklayın
5. **"Document Root"** alanını bulun
6. Değeri şu şekilde değiştirin:
   ```
   /home/kullanici_adi/public_html/navexmar/public
   ```
7. **Save** / **Kaydet** butonuna tıklayın
8. Tarayıcıyı yenileyin

**Sonuç:** 
- ✅ `https://navexmar.com` → Ana sayfa açılır
- ✅ CSS/JS düzgün yüklenir
- ✅ `/public/` URL'de görünmez

---

### Seçenek 2: Güncellenmiş Dosyaları Yükle (GEÇİCİ ÇÖZÜM)

Az önce `config/app.php` ve `.htaccess` dosyalarını güncelledim. Bunları sunucuya yükleyin:

**1. Güncellenmiş Dosyalar:**
- ✅ `config/app.php` - URL'leri otomatik algılar
- ✅ `.htaccess` (root) - Otomatik yönlendirme

**2. Yükleme:**
FileZilla veya cPanel File Manager ile:
```
- config/app.php dosyasını yenisiyle değiştir
- .htaccess dosyasını yenisiyle değiştir (root klasörde)
```

**3. Test:**
- `https://navexmar.com` → Artık açılmalı
- CSS/JS yüklenmeli

**Not:** Bu geçici çözümdür. Document Root ayarlamak daha iyidir.

---

### Seçenek 3: .htaccess Aktif Değilse

Eğer hala çalışmıyorsa, `.htaccess` dosyaları aktif olmayabilir.

**cPanel'de kontrol:**
1. **"MultiPHP INI Editor"** veya **"Select PHP Version"**
2. **Options** sekmesi
3. `AllowOverride All` olduğundan emin olun

**Veya manuel yönlendirme (.htaccess çalışmıyorsa):**
- cPanel > **"Redirects"** bölümünden:
  - From: `https://navexmar.com`
  - To: `https://navexmar.com/public/`
  - Type: Permanent (301)

---

## 🔍 Şu Anda Hangi Durumdayız?

**Test edin:**

### Test 1: Ana Domain
```
https://navexmar.com
```
**Beklenen:** Ana sayfa açılmalı
**Eğer açılmıyorsa:** Seçenek 1 veya 2'yi uygulayın

### Test 2: CSS/JS Yükleme
```
https://navexmar.com/assets/css/style.css
```
**Beklenen:** CSS dosyası görünmeli
**Eğer görünmüyorsa:** Document Root ayarı gerekli (Seçenek 1)

### Test 3: Admin Paneli
```
https://navexmar.com/admin/login
```
**Beklenen:** Login sayfası açılmalı

---

## 📝 Hızlı Kontrol Scripti

Sunucuda bu dosyayı oluşturun: `test.php` (public/ klasörü içinde)

```php
<?php
echo "Public klasörüne erişim: OK<br>";
echo "HTTPS: " . ($_SERVER['HTTPS'] ?? 'off') . "<br>";
echo "Host: " . ($_SERVER['HTTP_HOST'] ?? 'N/A') . "<br>";
echo "Request URI: " . ($_SERVER['REQUEST_URI'] ?? 'N/A') . "<br>";
echo "Script Name: " . ($_SERVER['SCRIPT_NAME'] ?? 'N/A') . "<br><br>";

// CSS dosyası var mı?
$cssPath = __DIR__ . '/assets/css/style.css';
echo "CSS Dosyası: " . (file_exists($cssPath) ? 'MEVCUT ✓' : 'YOK ✗') . "<br>";

// Config dosyası okunabiliyor mu?
$configPath = dirname(__DIR__) . '/config/app.php';
echo "Config Dosyası: " . (file_exists($configPath) ? 'MEVCUT ✓' : 'YOK ✗') . "<br>";

phpinfo();
```

**Test et:**
```
https://navexmar.com/public/test.php
```

Bu size tam olarak neyin eksik olduğunu gösterecek.

---

## 💡 En Hızlı Çözüm (5 Dakika)

1. cPanel'e gir
2. Domains → navexmar.com → Manage
3. Document Root'u değiştir: `/home/kullanici/public_html/navexmar/public`
4. Kaydet
5. Tarayıcıyı yenile
6. ✅ Tamamdır!

---

## 📞 Yardım

Hala sorun varsa:
1. Hangi seçeneği denediniz?
2. Hata mesajı nedir?
3. `test.php` çıktısı nedir?

Bu bilgilerle daha spesifik yardım edebilirim!
