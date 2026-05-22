// Hizmetleri veritabanından yükle
document.addEventListener('DOMContentLoaded', function() {
    loadServicesFromDB();
});

// Global scope'a ekle ki i18n.js erişebilsin
window.loadServicesFromDB = loadServicesFromDB;

async function loadServicesFromDB() {
    try {
        const response = await fetch('api/public-services.php');
        
        if (!response.ok) {
            console.error('API yanıtı başarısız:', response.status);
            return;
        }
        
        const result = await response.json();
        
        if (!result.success) {
            console.error('API hatası:', result.message);
            // Hata durumunda da devam et, boş bırak
            return;
        }
        
        if (result.data && result.data.length > 0) {
            // Dil kontrolü
            const currentLang = localStorage.getItem('language') || 'tr';
            
            // services.html sayfası için detaylı hizmetler
            const servicesDetailSection = document.querySelector('.services-detail .container');
            if (servicesDetailSection) {
                servicesDetailSection.innerHTML = '';
                
                result.data.forEach((service, index) => {
                    const isReverse = index % 2 !== 0 ? 'reverse' : '';
                    const serviceDiv = document.createElement('div');
                    serviceDiv.className = 'service-detail-item';
                    serviceDiv.id = `service-${service.id}`;
                    
                    const name = currentLang === 'en' ? service.name_en : service.name;
                    const description = currentLang === 'en' ? service.description_en : service.description;
                    const features = currentLang === 'en' ? service.features_en : service.features;
                    
                    let featuresHTML = '';
                    if (features && features.length > 0) {
                        featuresHTML = '<ul class="service-features">';
                        features.forEach(feature => {
                            featuresHTML += `<li><i class="fas fa-check"></i> ${feature}</li>`;
                        });
                        featuresHTML += '</ul>';
                    }
                    
                    serviceDiv.innerHTML = `
                        <div class="service-detail-content ${isReverse}">
                            <div class="service-detail-icon">
                                <i class="${service.icon}"></i>
                            </div>
                            <div class="service-detail-text">
                                <h2>${name}</h2>
                                <p>${description}</p>
                                ${featuresHTML}
                            </div>
                        </div>
                    `;
                    
                    servicesDetailSection.appendChild(serviceDiv);
                });
            }
            
            // index.html sayfası için hizmet kartları
            const servicesGrid = document.querySelector('.services-section .services-grid');
            if (servicesGrid) {
                servicesGrid.innerHTML = '';
                
                if (result.data && result.data.length > 0) {
                    result.data.forEach(service => {
                        const name = currentLang === 'en' ? service.name_en : service.name;
                        const description = currentLang === 'en' ? service.description_en : service.description;
                        const detailsText = currentLang === 'en' ? 'Details' : 'Detaylar';
                        
                        const serviceCard = document.createElement('div');
                        serviceCard.className = 'service-card';
                        serviceCard.innerHTML = `
                            <i class="${service.icon}"></i>
                            <h3>${name}</h3>
                            <p>${description.length > 100 ? description.substring(0, 100) + '...' : description}</p>
                            <a href="services.html#service-${service.id}" class="service-link">
                                ${detailsText} <i class="fas fa-arrow-right"></i>
                            </a>
                        `;
                        servicesGrid.appendChild(serviceCard);
                    });
                } else {
                    servicesGrid.innerHTML = '<div style="text-align:center;padding:2rem;color:#999;">Henüz hizmet eklenmemiş.</div>';
                }
            }
        } else {
            // Veritabanı boşsa veya hata varsa - varsayılan hizmetleri göster
            const currentLang = localStorage.getItem('language') || 'tr';
            showDefaultServices(currentLang);
        }
    } catch (error) {
        console.error('Hizmetler yüklenirken hata:', error);
        // Hata durumunda varsayılan hizmetleri göster
        const currentLang = localStorage.getItem('language') || 'tr';
        showDefaultServices(currentLang);
    }
}

// Varsayılan hizmetleri göster (veritabanı yoksa)
function showDefaultServices(lang) {
    const defaultServices = [
        {
            id: 'onboard',
            name: 'Gemi Üzeri Hizmetler',
            name_en: 'Onboard Services',
            description: 'Gemilerinizin seferde veya limanda olduğu her durumda, uzman teknisyenlerimiz ile gemi üzerinde tüm bakım ve onarım işlemlerini gerçekleştiriyoruz.',
            description_en: 'In every situation where your ships are at sea or in port, we perform all maintenance and repair operations on board with our expert technicians.',
            icon: 'fas fa-anchor',
            features: ['Acil onarım hizmetleri', 'Makine bakım ve servisi', 'Elektrik ve elektronik onarımları', 'Güverte ekipmanları bakımı', 'HVAC sistem servisi', 'Yangın söndürme sistemleri'],
            features_en: ['Emergency repair services', 'Machine maintenance and service', 'Electrical and electronic repairs', 'Deck equipment maintenance', 'HVAC system service', 'Fire extinguishing systems']
        },
        {
            id: 'supply',
            name: 'Tedarik Hizmetleri',
            name_en: 'Supply Services',
            description: 'Geniş tedarikçi ağımız ile gemileriniz için ihtiyaç duyulan tüm yedek parça, malzeme ve ekipmanları en kısa sürede temin ediyoruz.',
            description_en: 'With our extensive supplier network, we provide all spare parts, materials and equipment needed for your ships in the shortest time.',
            icon: 'fas fa-boxes',
            features: ['Yedek parça temini', 'Teknik malzeme tedariki', 'Lojistik organizasyonu', 'Gümrük işlemleri', 'Hızlı kargo servisi', 'Stok yönetimi'],
            features_en: ['Spare parts supply', 'Technical material supply', 'Logistics organization', 'Customs procedures', 'Fast cargo service', 'Stock management']
        },
        {
            id: 'predictive',
            name: 'Öngörücü Bakım',
            name_en: 'Predictive Maintenance',
            description: 'Modern teknoloji ve veri analitiği kullanarak gemilerinizin ekipmanlarının durumunu sürekli izliyor ve bakım ihtiyaçlarını önceden planlıyoruz.',
            description_en: 'Using modern technology and data analytics, we continuously monitor the condition of your ships\' equipment and plan maintenance needs in advance.',
            icon: 'fas fa-chart-line',
            features: ['Durum izleme sistemleri', 'Titreşim analizi', 'Yağ analizi', 'Termal görüntüleme', 'Veri analitiği ve raporlama', 'Bakım planlama optimizasyonu'],
            features_en: ['Condition monitoring systems', 'Vibration analysis', 'Oil analysis', 'Thermal imaging', 'Data analytics and reporting', 'Maintenance planning optimization']
        }
    ];
    
    // services.html sayfası için detaylı hizmetler
    const servicesDetailSection = document.querySelector('.services-detail .container');
    if (servicesDetailSection) {
        servicesDetailSection.innerHTML = '';
        
        defaultServices.forEach((service, index) => {
            const isReverse = index % 2 !== 0 ? 'reverse' : '';
            const serviceDiv = document.createElement('div');
            serviceDiv.className = 'service-detail-item';
            serviceDiv.id = service.id;
            
            const name = lang === 'en' ? service.name_en : service.name;
            const description = lang === 'en' ? service.description_en : service.description;
            const features = lang === 'en' ? service.features_en : service.features;
            
            let featuresHTML = '';
            if (features && features.length > 0) {
                featuresHTML = '<ul class="service-features">';
                features.forEach(feature => {
                    featuresHTML += `<li><i class="fas fa-check"></i> ${feature}</li>`;
                });
                featuresHTML += '</ul>';
            }
            
            serviceDiv.innerHTML = `
                <div class="service-detail-content ${isReverse}">
                    <div class="service-detail-icon">
                        <i class="${service.icon}"></i>
                    </div>
                    <div class="service-detail-text">
                        <h2>${name}</h2>
                        <p>${description}</p>
                        ${featuresHTML}
                    </div>
                </div>
            `;
            
            servicesDetailSection.appendChild(serviceDiv);
        });
    }
    
    // index.html sayfası için hizmet kartları
    const servicesGrid = document.querySelector('.services-section .services-grid');
    if (servicesGrid) {
        servicesGrid.innerHTML = '';
        
        defaultServices.forEach(service => {
            const name = lang === 'en' ? service.name_en : service.name;
            const description = lang === 'en' ? service.description_en : service.description;
            const detailsText = lang === 'en' ? 'Details' : 'Detaylar';
            
            const serviceCard = document.createElement('div');
            serviceCard.className = 'service-card';
            serviceCard.innerHTML = `
                <i class="${service.icon}"></i>
                <h3>${name}</h3>
                <p>${description.length > 100 ? description.substring(0, 100) + '...' : description}</p>
                <a href="services.html#${service.id}" class="service-link">
                    ${detailsText} <i class="fas fa-arrow-right"></i>
                </a>
            `;
            servicesGrid.appendChild(serviceCard);
        });
    }
}

// Dil değiştiğinde hizmetleri yeniden yükle
if (window.setLanguage) {
    const originalSetLanguage = window.setLanguage;
    window.setLanguage = function(lang) {
        originalSetLanguage(lang);
        loadServicesFromDB();
    };
}
