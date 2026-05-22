// ==========================================
// SERVICES MANAGEMENT
// Dinamik hizmet yükleme
// ==========================================

// Load services from localStorage and populate pages
function loadServicesToPage() {
    if (typeof window.admin === 'undefined') {
        console.error('admin.js is not loaded');
        return;
    }

    const services = window.admin.getServices();
    const currentLang = window.i18n ? window.i18n.currentLang : 'tr';
    
    // Load services to services page
    loadServicesToServicesPage(services, currentLang);
    
    // Load services to home page
    loadServicesToHomePage(services, currentLang);
    
    // Load services to contact form
    loadServicesToContactForm(services, currentLang);
}

// Load services to services.html page
function loadServicesToServicesPage(services, lang) {
    const servicesDetail = document.querySelector('.services-detail');
    if (!servicesDetail) return;

    servicesDetail.innerHTML = services.map(service => {
        const name = lang === 'tr' ? service.name : service.nameEn;
        const description = lang === 'tr' ? service.description : service.descriptionEn;
        const features = lang === 'tr' ? service.features : (service.featuresEn || service.features);
        const icon = service.icon || 'fas fa-cog';
        const reverse = services.indexOf(service) % 2 !== 0 ? 'reverse' : '';
        
        return `
            <div class="service-detail-item" id="${service.id}">
                <div class="service-detail-content ${reverse}">
                    <div class="service-detail-icon">
                        <i class="${icon}"></i>
                    </div>
                    <div class="service-detail-text">
                        <h2>${name}</h2>
                        <p>${description}</p>
                        <ul class="service-features">
                            ${features.map(feature => `<li><i class="fas fa-check"></i> ${feature}</li>`).join('')}
                        </ul>
                    </div>
                </div>
            </div>
        `;
    }).join('');
}

// Load services to index.html page
function loadServicesToHomePage(services, lang) {
    const servicesGrid = document.querySelector('.services-grid');
    if (!servicesGrid) return;

    servicesGrid.innerHTML = services.map(service => {
        const name = lang === 'tr' ? service.name : service.nameEn;
        const description = lang === 'tr' ? service.description : service.descriptionEn;
        const icon = service.icon || 'fas fa-cog';
        
        return `
            <div class="service-card">
                <i class="${icon}"></i>
                <h3>${name}</h3>
                <p>${description.substring(0, 100)}${description.length > 100 ? '...' : ''}</p>
                <a href="services.html#${service.id}" class="service-link">
                    ${lang === 'tr' ? 'Detaylar' : 'Details'} <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        `;
    }).join('');
}

// Load services to contact form dropdown
function loadServicesToContactForm(services, lang) {
    const serviceSelect = document.getElementById('service');
    if (!serviceSelect) return;

    // Clear existing options except first one
    const firstOption = serviceSelect.querySelector('option');
    serviceSelect.innerHTML = '';
    if (firstOption) {
        serviceSelect.appendChild(firstOption);
    }

    // Add services as options
    services.forEach(service => {
        const option = document.createElement('option');
        option.value = service.id;
        const name = lang === 'tr' ? service.name : service.nameEn;
        option.textContent = name;
        serviceSelect.appendChild(option);
    });
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', () => {
    // Wait for admin.js to be loaded
    if (typeof window.admin !== 'undefined') {
        loadServicesToPage();
    } else {
        // Try again after a short delay
        setTimeout(() => {
            if (typeof window.admin !== 'undefined') {
                loadServicesToPage();
            }
        }, 100);
    }
});

// Refresh services when language changes
if (window.i18n) {
    const originalSetLanguage = window.i18n.setLanguage;
    window.i18n.setLanguage = function(lang) {
        originalSetLanguage.call(this, lang);
        loadServicesToPage();
    };
}
