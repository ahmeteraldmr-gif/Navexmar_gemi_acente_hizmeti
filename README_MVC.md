# Navexmar MVC Projesi - Kullanım Kılavuzu

## 🚀 Kurulum

### 1. Veritabanını Oluştur

```bash
# 1. MySQL'e giriş yap
mysql -u root -p

# 2. Mevcut database.sql dosyasını çalıştır
source /path/to/navexmar/database.sql

# 3. Yeni tabloları ekle
source /path/to/navexmar/database/migrations.sql
```

### 2. Konfigürasyon

`config/database.php` dosyasında veritabanı bilgilerinizi kontrol edin:
- Local ortam otomatik algılanır (localhost)
- Production ortam için bilgileri güncelleyin

### 3. Dosya İzinleri

```bash
chmod -R 755 public/uploads/
chmod -R 755 public/assets/
```

### 4. Web Sunucu Ayarları

#### Apache
- `.htaccess` dosyaları zaten yapılandırılmış
- `mod_rewrite` aktif olmalı

#### Nginx
```nginx
root /path/to/navexmar/public;
index index.php;

location / {
    try_files $uri $uri/ /index.php?$query_string;
}

location ~ \.php$ {
    fastcgi_pass unix:/var/run/php/php-fpm.sock;
    fastcgi_index index.php;
    include fastcgi_params;
}
```

## 📁 Yeni Proje Yapısı

```
navexmar/
├── config/              # Yapılandırma dosyaları
│   ├── app.php         # Uygulama ayarları
│   ├── database.php    # Veritabanı bağlantısı
│   └── routes.php      # URL yönlendirmeleri
├── database/           # Veritabanı migrations
│   └── migrations.sql  # Yeni tablolar
├── public/             # Web root (DocumentRoot burası olmalı)
│   ├── index.php      # Front controller
│   ├── .htaccess      # Apache yönlendirmeleri
│   ├── assets/        # Statik dosyalar
│   │   ├── css/
│   │   ├── js/
│   │   └── images/
│   └── uploads/       # Yüklenen dosyalar
│       └── headers/   # Header görselleri
├── src/               # Uygulama kaynak kodları
│   ├── Controllers/   # Controller sınıfları
│   ├── Models/        # Model sınıfları
│   ├── Views/         # View dosyaları
│   │   ├── layouts/   # Layout şablonları
│   │   ├── pages/     # Sayfa view'leri
│   │   ├── admin/     # Admin panel view'leri
│   │   └── components/ # Tekrar kullanılabilir bileşenler
│   └── Router.php     # Routing sınıfı
└── .htaccess          # Root yönlendirme

ESKİ DOSYALAR (Artık Kullanılmıyor):
- *.html dosyaları
- api/ klasörü
- Eski admin.php, login.php dosyaları
```

## 🌐 URL Yapısı

### Kullanıcı Sayfaları
- `/` - Ana sayfa
- `/yaklasimimiz` - Yaklaşımımız
- `/hizmetlerimiz` - Hizmetler listesi
- `/hizmet/{slug}` - Hizmet detayı
- `/politikalarimiz` - Politikalar
- `/iletisim` - İletişim formu

### Admin Paneli
- `/admin` - Admin dashboard
- `/admin/login` - Admin girişi
- `/admin/services` - Hizmet yönetimi
- `/admin/messages` - Mesaj yönetimi
- `/admin/pages` - Sayfa yönetimi
- `/admin/headers` - Header görselleri
- `/admin/settings` - Site ayarları

## 🔐 Admin Paneli Giriş

**Varsayılan Kullanıcı:**
- Kullanıcı Adı: `admin`
- Şifre: `admin31`

> ⚠️ İlk girişten sonra şifreyi değiştirmeniz önerilir!

## 💡 Önemli Özellikler

### 1. MVC Mimarisi
- **Models**: Veritabanı işlemleri
- **Views**: Kullanıcı arayüzü
- **Controllers**: İş mantığı

### 2. Routing Sistemi
- Temiz URL'ler
- Parametreli route'lar
- Method kontrolü (GET/POST)
- Auth middleware

### 3. Admin Paneli
- Modern ve kullanıcı dostu arayüz
- Dashboard ile istatistikler
- Hizmet CRUD işlemleri
- Mesaj yönetimi
- Sayfa içerik düzenleme
- Header görselleri yükleme/atama
- Site ayarları yönetimi

### 4. Dinamik İçerik
- Tüm içerikler veritabanından
- Çoklu dil desteği (TR/EN)
- Header görselleri sayfa bazlı atanabilir
- Rastgele görsel seçeneği

### 5. Güvenlik
- CSRF koruması
- XSS koruması
- SQL Injection koruması (Prepared statements)
- Password hashing (bcrypt)
- Dosya yükleme validasyonu

## 🛠️ Geliştirme

### Yeni Sayfa Eklemek

1. Route ekle (`config/routes.php`):
```php
'/yeni-sayfa' => ['controller' => 'HomeController', 'action' => 'yeniSayfa']
```

2. Controller metodu ekle (`src/Controllers/HomeController.php`):
```php
public function yeniSayfa() {
    $this->render('pages/yeni-sayfa', [
        'title' => 'Yeni Sayfa'
    ]);
}
```

3. View oluştur (`src/Views/pages/yeni-sayfa.php`)

### Yeni Model Eklemek

```php
// src/Models/YeniModel.php
require_once __DIR__ . '/BaseModel.php';

class YeniModel extends BaseModel {
    protected $table = 'tablo_adi';
    
    // Custom metodlar...
}
```

## 📝 Veritabanı Yönetimi

### Yeni Tablo Eklemek
`database/migrations.sql` dosyasına SQL komutlarını ekleyin.

### Mevcut Tablolar
- `admin` - Admin kullanıcıları
- `services` - Hizmetler
- `messages` - İletişim mesajları
- `pages` - Sayfa içerikleri
- `page_sections` - Sayfa bölümleri
- `header_images` - Header görselleri
- `page_header_settings` - Header ayarları
- `settings` - Site ayarları

## 🐛 Sorun Giderme

### 404 Hatası
- `.htaccess` dosyalarının yüklendiğinden emin olun
- Apache `mod_rewrite` modulünün aktif olduğunu kontrol edin
- Web sunucu `AllowOverride All` ayarına sahip olmalı

### Veritabanı Bağlantı Hatası
- `config/database.php` dosyasındaki bilgileri kontrol edin
- MySQL servisinin çalıştığından emin olun
- Kullanıcı izinlerini kontrol edin

### Dosya Yükleme Hatası
- `public/uploads/` klasörünün yazılabilir olduğundan emin olun
- PHP `upload_max_filesize` ayarını kontrol edin

## 📞 Destek

Herhangi bir sorun veya soru için:
- E-posta: agency@navexmar.com
- GitHub Issues: (proje deposu linki)

---

**Not:** Bu proje, eski HTML/PHP karışık yapıdan modern MVC mimarisine dönüştürülmüştür. Tüm eski dosyalar yeni yapıya entegre edilmiştir.
