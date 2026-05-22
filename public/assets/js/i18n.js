// ==========================================
// INTERNATIONALIZATION (i18n) SYSTEM
// Çoklu dil desteği - TR/EN
// ==========================================

const translations = {
    tr: {
        // Navigation
        'nav.home': 'Ana Sayfa',
        'nav.approach': 'Yaklaşımımız',
        'nav.services': 'Hizmetler',
        'nav.policies': 'Politikalarımız',
        'nav.contact': 'İletişim',
        'nav.admin': 'Yönetim',
        
        // Services
        'services.onboard': 'Gemi Üzeri Hizmetler',
        'services.supply': 'Tedarik Hizmetleri',
        'services.predictive': 'Öngörücü Bakım',
        
        // Common
        'common.readMore': 'Daha Fazla Bilgi',
        'common.contact': 'İletişim',
        'common.send': 'Gönder',
        'common.save': 'Kaydet',
        'common.cancel': 'İptal',
        'common.delete': 'Sil',
        'common.edit': 'Düzenle',
        'common.add': 'Ekle',
        'common.close': 'Kapat',
        
        // Contact Form
        'contact.title': 'İletişim',
        'contact.subtitle': 'Bizimle iletişime geçin',
        'contact.sendMessage': 'Mesaj Gönderin',
        'contact.formDesc': 'Sorularınız ve talepleriniz için formu doldurun, en kısa sürede size dönüş yapalım.',
        'contact.name': 'Adınız Soyadınız',
        'contact.email': 'E-posta Adresiniz',
        'contact.phone': 'Telefon Numaranız',
        'contact.company': 'Firma Adı',
        'contact.service': 'Hizmet Seçimi',
        'contact.selectService': 'Seçiniz...',
        'contact.message': 'Mesajınız',
        'contact.required': '*',
        
        // Admin Panel
        'admin.title': 'Yönetim Paneli',
        'admin.services': 'Hizmet Yönetimi',
        'admin.messages': 'Mesaj Yönetimi',
        'admin.addService': 'Yeni Hizmet Ekle',
        'admin.editService': 'Hizmet Düzenle',
        'admin.serviceName': 'Hizmet Adı',
        'admin.serviceNameEn': 'Hizmet Adı (İngilizce)',
        'admin.serviceDesc': 'Açıklama',
        'admin.serviceDescEn': 'Açıklama (İngilizce)',
        'admin.serviceIcon': 'İkon Kodu',
        'admin.serviceFeatures': 'Özellikler',
        'admin.addFeature': 'Özellik Ekle',
        'admin.viewMessages': 'Mesajları Görüntüle',
        'admin.messageFrom': 'Gönderen',
        'admin.messageDate': 'Tarih',
        'admin.messageContent': 'Mesaj',
        
        // Home Page
        'home.hero.subtitle': 'EN İYİYİ KEŞFEDİN',
        'home.hero.title': 'OPTİMİZASYONA ADANMIŞ',
        'home.hero.description': 'Navexmar, sektördeki diğer firmalardan farklı bir yaklaşımla gemi bakım ve uluslararası ticaret hizmetleri sunan bir şirkettir. Kuruluşumuzdan bu yana, insan odaklı, tüm ortaklarımızı kapsayan ve her yönüyle entegre bir şirket olmaya çalışıyoruz.',
        'home.services.title': 'HİZMETLERİMİZ',
        'home.services.details': 'Detaylar',
        'home.services.loading': 'Hizmetler yükleniyor...',
        'home.cta.title': 'Şimdi Bizimle İletişime Geçin!',
        // Approach Page
        'approach.title': 'Yaklaşımımız',
        'approach.subtitle': 'İş felsefemiz ve değerlerimiz',
        'approach.cta.title': 'Bizimle Çalışmak İster Misiniz?',
        'approach.cta.button': 'İletişime Geçin',
        // Services Page
        'services.title': 'Hizmetlerimiz',
        'services.subtitle': 'Denizcilik sektöründe kapsamlı çözümler',
        'services.cta.title': 'Hizmetlerimiz Hakkında Detaylı Bilgi Almak İster Misiniz?',
        'services.cta.button': 'Bize Ulaşın',
        // Policies Page
        'policies.title': 'Politikalarımız',
        'policies.subtitle': 'Kurumsal değerler ve ilkelerimiz',
        'home.stats.drydock': 'Kuru Havuzlama',
        'home.stats.floating': 'Yüzer Onarım',
        'home.stats.bwts': 'BWTS Kurulumu',
        'home.floki.n': 'Navigasyon',
        'home.floki.a': 'Azimli',
        'home.floki.v': 'Verimli',
        'home.floki.e': 'Enerjik',
        'home.floki.x': 'Mükemmel',
        'home.about.description': 'Navexmar, sektördeki diğer firmalardan farklı bir yaklaşımla gemi bakım hizmetleri sunan bir şirkettir. Kuruluşumuzdan bu yana, insan odaklı, tüm ortaklarımızı kapsayan ve her yönüyle entegre bir şirket olmaya çalışıyoruz.',
        // Footer
        'footer.menu': 'Menü',
        'footer.contact': 'İletişim',
        'footer.location': 'Hatay, Türkiye',
        'footer.workingHours': 'Çalışma Saatleri',
        'footer.workingHoursDesc': 'Zaman Kısıtı Olmaksızın 7/24 Operasyon Takibi Ve Her Aşamada Erişilebilir Opersayon Ekibi',
        'footer.newsletter': 'Bülten',
        'footer.newsletterDesc': 'Haberlerden haberdar olun',
        'footer.emailPlaceholder': 'E-posta adresiniz',
        'footer.copyright': 'Tüm Hakları Saklıdır.'
    },
    en: {
        // Navigation
        'nav.home': 'Home',
        'nav.approach': 'Our Approach',
        'nav.services': 'Services',
        'nav.policies': 'Policies',
        'nav.contact': 'Contact',
        'nav.admin': 'Admin',
        
        // Services
        'services.onboard': 'Onboard Services',
        'services.supply': 'Supply Services',
        'services.predictive': 'Predictive Maintenance',
        
        // Common
        'common.readMore': 'Read More',
        'common.contact': 'Contact',
        'common.send': 'Send',
        'common.save': 'Save',
        'common.cancel': 'Cancel',
        'common.delete': 'Delete',
        'common.edit': 'Edit',
        'common.add': 'Add',
        'common.close': 'Close',
        
        // Contact Form
        'contact.title': 'Contact',
        'contact.subtitle': 'Get in touch with us',
        'contact.sendMessage': 'Send Message',
        'contact.formDesc': 'Fill out the form for your questions and requests, we will get back to you as soon as possible.',
        'contact.name': 'Your Name',
        'contact.email': 'Your Email',
        'contact.phone': 'Your Phone',
        'contact.company': 'Company Name',
        'contact.service': 'Service Selection',
        'contact.selectService': 'Select...',
        'contact.message': 'Your Message',
        'contact.required': '*',
        
        // Admin Panel
        'admin.title': 'Admin Panel',
        'admin.services': 'Service Management',
        'admin.messages': 'Message Management',
        'admin.addService': 'Add New Service',
        'admin.editService': 'Edit Service',
        'admin.serviceName': 'Service Name',
        'admin.serviceNameEn': 'Service Name (English)',
        'admin.serviceDesc': 'Description',
        'admin.serviceDescEn': 'Description (English)',
        'admin.serviceIcon': 'Icon Code',
        'admin.serviceFeatures': 'Features',
        'admin.addFeature': 'Add Feature',
        'admin.viewMessages': 'View Messages',
        'admin.messageFrom': 'From',
        'admin.messageDate': 'Date',
        'admin.messageContent': 'Message',
        
        // Home Page
        'home.hero.subtitle': 'DISCOVER THE BEST',
        'home.hero.title': 'DEDICATED TO OPTIMIZATION',
        'home.hero.description': 'Navexmar is a company that offers ship maintenance and international trade services with a different approach from other companies in the industry. Since our establishment, we have been trying to be a human-centered, inclusive and fully integrated company.',
        'home.services.title': 'OUR SERVICES',
        'home.services.details': 'Details',
        'home.services.loading': 'Loading services...',
        'home.cta.title': 'Get In Touch With Us Now!',
        // Approach Page
        'approach.title': 'Our Approach',
        'approach.subtitle': 'Our business philosophy and values',
        'approach.cta.title': 'Would You Like To Work With Us?',
        'approach.cta.button': 'Get In Touch',
        // Services Page
        'services.title': 'Our Services',
        'services.subtitle': 'Comprehensive solutions in the maritime sector',
        'services.cta.title': 'Would You Like To Get More Information About Our Services?',
        'services.cta.button': 'Contact Us',
        // Policies Page
        'policies.title': 'Our Policies',
        'policies.subtitle': 'Corporate values and principles',
        'home.stats.drydock': 'Dry Docking',
        'home.stats.floating': 'Floating Repair',
        'home.stats.bwts': 'BWTS Installation',
        'home.floki.n': 'Navigation',
        'home.floki.a': 'Ambitious',
        'home.floki.v': 'Efficient',
        'home.floki.e': 'Energetic',
        'home.floki.x': 'Excellent',
        'home.about.description': 'Navexmar is a company that offers ship maintenance services with a different approach from other companies in the industry. Since our establishment, we have been trying to be a human-centered, inclusive and fully integrated company.',
        // Footer
        'footer.menu': 'Menu',
        'footer.contact': 'Contact',
        'footer.location': 'Hatay, Turkey',
        'footer.workingHours': 'Working Hours',
        'footer.workingHoursDesc': '24/7 Operation Tracking Without Time Restrictions And Accessible Operation Team At Every Stage',
        'footer.newsletter': 'Newsletter',
        'footer.newsletterDesc': 'Stay informed about news',
        'footer.emailPlaceholder': 'Your email address',
        'footer.copyright': 'All Rights Reserved.'
    }
};

// Current language - initialized using document's lang attribute set by server, falling back to localStorage
let currentLang = document.documentElement.lang || localStorage.getItem('language') || 'tr';
if (currentLang && localStorage.getItem('language') !== currentLang) {
    localStorage.setItem('language', currentLang);
}

// Get translation function
function t(key) {
    return translations[currentLang][key] || key;
}

// Set language function
function setLanguage(lang) {
    currentLang = lang;
    if (window.i18n) {
        window.i18n.currentLang = lang;
    }
    localStorage.setItem('language', lang);
    document.documentElement.lang = lang;
    translatePage();
    // Trigger language change event
    window.dispatchEvent(new CustomEvent('languageChanged', { detail: { lang } }));
}

// Translate all elements with data-i18n attribute
function translatePage() {
    document.querySelectorAll('[data-i18n]').forEach(element => {
        const key = element.getAttribute('data-i18n');
        if (translations[currentLang] && translations[currentLang][key]) {
            const translation = translations[currentLang][key];
            
            if (element.tagName === 'INPUT') {
                if (element.type === 'submit' || element.type === 'button') {
                    element.value = translation;
                } else if (element.type === 'email' || element.type === 'text' || element.hasAttribute('data-i18n-placeholder')) {
                    element.placeholder = translation;
                } else {
                    element.value = translation;
                }
            } else if (element.tagName === 'TEXTAREA') {
                if (element.getAttribute('data-i18n-placeholder')) {
                    element.placeholder = translation;
                } else {
                    element.textContent = translation;
                }
            } else if (element.tagName === 'BUTTON') {
                // Button için içeriği koru ama metni değiştir
                const icon = element.querySelector('i');
                if (icon) {
                    element.innerHTML = icon.outerHTML + ' ' + translation;
                } else {
                    element.textContent = translation;
                }
            } else {
                // Diğer elementler için (A, H1, H2, P, vb.)
                // Mevcut HTML'i sakla ve icon'ları koru
                const originalHTML = element.innerHTML;
                
                // Icon'ları bul (<i> tagları)
                const tempDiv = document.createElement('div');
                tempDiv.innerHTML = originalHTML;
                const icons = tempDiv.querySelectorAll('i');
                
                if (icons.length > 0) {
                    // Icon'lar varsa - icon'ları koru
                    const iconHTMLs = Array.from(icons).map(icon => icon.outerHTML);
                    const originalHTMLLower = originalHTML.toLowerCase();
                    
                    // İlk icon başta mı?
                    const firstIconHTML = iconHTMLs[0];
                    if (originalHTMLLower.trim().startsWith('<i')) {
                        // Icon başta
                        element.innerHTML = iconHTMLs.join(' ') + ' ' + translation;
                    } else {
                        // Icon sonda
                        element.innerHTML = translation + ' ' + iconHTMLs.join(' ');
                    }
                } else {
                    // Icon yoksa sadece metni değiştir
                    element.textContent = translation;
                }
            }
        }
    });
    
    // Update language selector text (lang-text class'ına sahip span)
    document.querySelectorAll('.lang-text').forEach(langSpan => {
        langSpan.textContent = currentLang.toUpperCase();
    });
    
    // Dil değişince hizmetleri yeniden yükle
    if (window.loadServicesFromDB && typeof window.loadServicesFromDB === 'function') {
        window.loadServicesFromDB();
    }
}

// Initialize translation on page load
document.addEventListener('DOMContentLoaded', () => {
    // Sayfa yüklendiğinde çeviriyi yap
    translatePage();
    
    // Language selector event listeners - daha önce eklenmiş olanları kaldır ve yeniden ekle
    document.querySelectorAll('.lang-option').forEach(option => {
        // Önceki event listener'ı kaldır (eğer varsa)
        const newOption = option.cloneNode(true);
        option.parentNode.replaceChild(newOption, option);
        
        // Yeni event listener ekle
        newOption.addEventListener('click', (e) => {
            const lang = newOption.getAttribute('data-lang');
            // Save language in localStorage before navigating to server route
            localStorage.setItem('language', lang);
            
            // Dil menüsünü kapat
            const languageMenu = newOption.closest('.language-menu');
            if (languageMenu) {
                languageMenu.style.opacity = '0';
                languageMenu.style.visibility = 'hidden';
            }
        });
    });
});

// Export for use in other scripts
window.i18n = { t, setLanguage, currentLang };
