# Navexmar - Gemi Bakım ve Lojistik Hizmetleri Web Sitesi

Navexmar firması için hazırlanmış modern, responsive ve profesyonel bir web sitesidir. Sadece HTML, CSS ve JavaScript kullanılarak geliştirilmiştir.

## 📁 Proje Yapısı

```
navexmar/
│
├── index.html              # Ana sayfa
├── services.html           # Hizmetler sayfası
├── contact.html            # İletişim sayfası
├── approach.html           # Yaklaşımımız sayfası
├── references.html         # Referanslar sayfası
├── documents.html          # Belgeler sayfası
├── policies.html           # Politikalar sayfası
│
├── css/
│   ├── style.css          # Ana stil dosyası
│   └── pages.css          # Sayfalara özel stiller
│
├── js/
│   ├── main.js            # Ana JavaScript dosyası
│   └── contact.js         # İletişim formu için JavaScript
│
└── README.md              # Proje dokümantasyonu
```

## 🚀 Özellikler

### Genel Özellikler
- ✅ %100 Responsive tasarım (Mobil, Tablet, Desktop)
- ✅ Modern ve profesyonel görünüm
- ✅ Hızlı ve hafif (Framework kullanılmadan)
- ✅ Cross-browser uyumlu
- ✅ SEO optimize edilmiş
- ✅ Font Awesome icon kütüphanesi entegrasyonu

### Sayfalar

#### 1. Ana Sayfa (index.html)
- Hero bölümü ile etkileyici giriş
- İstatistik göstergeleri (animasyonlu sayaç)
- NAVEXMAR marka değerleri
- Hizmetler özeti
- Newsletter kayıt formu

#### 2. Hizmetler (services.html)
- 8 farklı hizmet kategorisi:
  - Havuzlama Hizmeti
  - Atölye Hizmetleri
  - Gemi Üzeri Hizmetler
  - Tedarik Hizmetleri
  - Mühendislik Hizmetleri
  - BWTS Kurulumu
  - Scrubber Kurulumu
  - Öngörücü Bakım
- Her hizmet için detaylı açıklama ve özellikler listesi

#### 3. İletişim (contact.html)
- Detaylı iletişim formu
- Form validasyonu (gerçek zamanlı)
- İletişim bilgileri
- Çalışma saatleri
- Sosyal medya bağlantıları
- Harita placeholder'ı

#### 4. Yaklaşımımız (approach.html)
- Şirket felsefesi ve değerleri
- 9 farklı yaklaşım kartı
- Misyon ve vizyon bölümü

#### 5. Referanslar (references.html)
- Müşteri listesi
- Müşteri görüşleri (testimonials)
- Başarı hikayeleri

#### 6. Belgeler (documents.html)
- Sertifikalar
- ISO belgeleri
- Klas onayları
- Kurumsal dokümantasyon

#### 7. Politikalar (policies.html)
- Kalite politikası
- İş sağlığı ve güvenliği
- Çevre politikası
- Etik ve uyum politikası
- KVKK ve bilgi güvenliği

### JavaScript Özellikleri

#### main.js
- **Responsive Navigation**: Mobil hamburger menü
- **Dropdown Menüler**: Hizmetler dropdown menüsü
- **Smooth Scroll**: Yumuşak sayfa kaydırma
- **Counter Animasyonu**: İstatistiklerde sayı artışı animasyonu
- **Scroll to Top Button**: Yukarı çık butonu
- **Navbar Scroll Effect**: Kaydırma ile navbar gölge efekti
- **Newsletter Form**: Newsletter kayıt işlemi
- **Fade In Animations**: Scroll ile görünür olan animasyonlar

#### contact.js
- **Form Validasyonu**: Gerçek zamanlı form doğrulama
- **E-posta ve Telefon Kontrolü**: Formatların kontrolü
- **Bildirim Sistemi**: Başarı/hata bildirimleri
- **Karakter Sayacı**: Mesaj alanı için karakter limiti

### CSS Özellikleri

#### style.css
- Modern CSS3 özellikleri
- Flexbox ve Grid Layout
- Animasyonlar ve geçişler
- Responsive media queries
- Custom CSS variables (renkler için)

#### pages.css
- Sayfalara özel stiller
- Servis detay kartları
- İletişim formu stilleri
- Referans ve belge kartları
- Politika sayfası stilleri

## 🎨 Renk Paleti

```css
--primary-color: #1a4d7d    /* Lacivert */
--secondary-color: #ff6b35   /* Turuncu */
--dark-color: #2c3e50        /* Koyu gri */
--light-color: #ecf0f1       /* Açık gri */
--white: #ffffff             /* Beyaz */
--text-color: #333           /* Metin rengi */
```

## 📱 Responsive Breakpoints

- **Desktop**: 1200px ve üzeri
- **Tablet**: 768px - 1199px
- **Mobile**: 767px ve altı

## 🔧 Kurulum ve Kullanım

1. **Dosyaları İndirin**
   ```
   Tüm dosyaları bir klasöre kopyalayın
   ```

2. **Tarayıcıda Açın**
   ```
   index.html dosyasını herhangi bir modern tarayıcıda açın
   ```

3. **Web Sunucusunda Yayınlama**
   ```
   Tüm dosyaları web sunucunuzun root dizinine yükleyin
   ```

## 🌐 Tarayıcı Desteği

- ✅ Chrome (son 2 versiyon)
- ✅ Firefox (son 2 versiyon)
- ✅ Safari (son 2 versiyon)
- ✅ Edge (son 2 versiyon)
- ✅ Opera (son 2 versiyon)

## 📝 Özelleştirme

### Renkleri Değiştirme
`css/style.css` dosyasındaki `:root` bölümünden renkleri özelleştirebilirsiniz:

```css
:root {
    --primary-color: #1a4d7d;
    --secondary-color: #ff6b35;
    /* Diğer renkler... */
}
```

### İçerik Güncelleme
Her HTML dosyasındaki içeriği doğrudan düzenleyebilirsiniz. Tüm metinler Türkçe olarak hazırlanmıştır.

### İletişim Bilgileri
`contact.html` ve footer bölümlerindeki iletişim bilgilerini güncelleyin:
- E-posta adresleri
- Telefon numaraları
- Adres bilgileri
- Sosyal medya linkleri

## 🎯 Gelecek Geliştirmeler (Opsiyonel)

- [ ] Google Maps entegrasyonu
- [ ] Gerçek backend entegrasyonu (form gönderimi)
- [ ] Çoklu dil desteği
- [ ] Blog bölümü
- [ ] Galeri sayfası
- [ ] Online teklif alma sistemi

## 📞 Destek

Herhangi bir sorunuz veya öneriniz için:
- E-posta: info@navexmar.com
- Web: www.navexmar.com (güncellenecek)

## 📄 Lisans

Bu proje Navexmar firması için özel olarak geliştirilmiştir.
Tüm hakları saklıdır © 2025 Navexmar

---

**Not**: Bu site Floki Marine web sitesinden ilham alınarak, Navexmar firması için özelleştirilmiş olarak hazırlanmıştır.

## 🛠️ Teknik Detaylar

- **HTML5**: Semantik HTML yapısı
- **CSS3**: Modern stil özellikleri
- **JavaScript (ES6+)**: Vanilla JavaScript (framework yok)
- **Font Awesome 6.0**: Icon kütüphanesi
- **Google Fonts**: Segoe UI font ailesi (sistem fontu)

## 📋 Kullanım Kılavuzu

### Yeni Sayfa Eklemek
1. Mevcut bir HTML dosyasını kopyalayın
2. İçeriği düzenleyin
3. Navigation menüsüne yeni sayfayı ekleyin
4. Footer'daki linkleri güncelleyin

### Yeni Hizmet Eklemek
`services.html` dosyasında `.service-detail-item` class'ına sahip bir bölüm kopyalayın ve içeriği düzenleyin.

### Form İşleme
`js/contact.js` dosyasındaki form submission kısmına backend API endpoint'inizi ekleyin.

---

**Geliştirici Notu**: Site tamamen responsive olarak tasarlanmıştır ve modern tarayıcılarda sorunsuz çalışmaktadır. Herhangi bir framework kullanılmadığı için hızlı ve hafiftir.

