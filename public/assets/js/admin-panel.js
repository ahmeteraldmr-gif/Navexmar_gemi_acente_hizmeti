// ==========================================
// ADMIN PANEL JAVASCRIPT
// CRUD işlemleri için yönetim arayüzü
// ==========================================

let currentEditingServiceId = null;
let currentTab = 'services';

// Initialize admin panel
document.addEventListener('DOMContentLoaded', () => {
    loadServices();
    loadMessages();
    setupEventListeners();
});

// Setup event listeners
function setupEventListeners() {
    // Tab switching
    document.querySelectorAll('.tab-button').forEach(btn => {
        btn.addEventListener('click', () => {
            const tab = btn.getAttribute('data-tab');
            switchTab(tab);
        });
    });

    // Add service button
    const addServiceBtn = document.getElementById('addServiceBtn');
    if (addServiceBtn) {
        addServiceBtn.addEventListener('click', () => {
            openServiceModal();
        });
    }

    // Service form
    const serviceForm = document.getElementById('serviceForm');
    if (serviceForm) {
        serviceForm.addEventListener('submit', (e) => {
            e.preventDefault();
            saveService();
        });
    }

    // Modal close buttons
    const closeModal = document.getElementById('closeModal');
    const cancelBtn = document.getElementById('cancelBtn');
    const serviceModal = document.getElementById('serviceModal');

    if (closeModal) {
        closeModal.addEventListener('click', () => {
            closeServiceModal();
        });
    }

    if (cancelBtn) {
        cancelBtn.addEventListener('click', () => {
            closeServiceModal();
        });
    }

    if (serviceModal) {
        serviceModal.addEventListener('click', (e) => {
            if (e.target === serviceModal) {
                closeServiceModal();
            }
        });
    }

    // Add feature buttons
    const addFeatureBtn = document.getElementById('addFeatureBtn');
    const addFeatureEnBtn = document.getElementById('addFeatureEnBtn');

    if (addFeatureBtn) {
        addFeatureBtn.addEventListener('click', () => {
            addFeatureInput('featuresContainer');
        });
    }

    if (addFeatureEnBtn) {
        addFeatureEnBtn.addEventListener('click', () => {
            addFeatureInput('featuresEnContainer');
        });
    }
}

// Switch tabs
function switchTab(tab) {
    currentTab = tab;
    
    // Update buttons
    document.querySelectorAll('.tab-button').forEach(btn => {
        btn.classList.remove('active');
        if (btn.getAttribute('data-tab') === tab) {
            btn.classList.add('active');
        }
    });

    // Update content
    document.querySelectorAll('.tab-content').forEach(content => {
        content.classList.remove('active');
        if (content.id === `${tab}-tab`) {
            content.classList.add('active');
        }
    });
}

// Load services
function loadServices() {
    const services = window.admin.getServices();
    const servicesList = document.getElementById('servicesList');
    
    if (!servicesList) return;

    if (services.length === 0) {
        servicesList.innerHTML = '<p>Henüz hizmet eklenmemiş.</p>';
        return;
    }

    servicesList.innerHTML = services.map(service => {
        const lang = window.i18n.currentLang || 'tr';
        const name = lang === 'tr' ? service.name : service.nameEn;
        const icon = service.icon || 'fas fa-cog';
        
        return `
            <div class="service-item" data-id="${service.id}">
                <div class="service-item-content">
                    <div class="service-item-icon">
                        <i class="${icon}"></i>
                    </div>
                    <div class="service-item-info">
                        <h3>${name}</h3>
                        <p>${lang === 'tr' ? service.description : service.descriptionEn}</p>
                    </div>
                </div>
                <div class="service-item-actions">
                    <button class="btn-icon btn-edit" onclick="editService('${service.id}')">
                        <i class="fas fa-edit"></i> ${window.i18n.t('common.edit')}
                    </button>
                    <button class="btn-icon btn-delete" onclick="deleteService('${service.id}')">
                        <i class="fas fa-trash"></i> ${window.i18n.t('common.delete')}
                    </button>
                </div>
            </div>
        `;
    }).join('');
}

// Load messages
function loadMessages() {
    const messages = window.admin.getMessages();
    const messagesList = document.getElementById('messagesList');
    
    if (!messagesList) return;

    if (messages.length === 0) {
        messagesList.innerHTML = '<p>Henüz mesaj yok.</p>';
        return;
    }

    messagesList.innerHTML = messages.map(message => {
        const date = new Date(message.createdAt).toLocaleString('tr-TR');
        const unreadClass = message.read ? '' : 'unread';
        
        return `
            <div class="message-item ${unreadClass}" data-id="${message.id}">
                <div class="message-header">
                    <div class="message-info">
                        <h3>${message.name}</h3>
                        <div class="message-meta">
                            <i class="fas fa-envelope"></i> ${message.email}
                            ${message.phone ? `<br><i class="fas fa-phone"></i> ${message.phone}` : ''}
                            ${message.company ? `<br><i class="fas fa-building"></i> ${message.company}` : ''}
                        </div>
                    </div>
                    <div class="message-actions">
                        <button class="btn-icon btn-delete" onclick="deleteMessage('${message.id}')">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
                <div class="message-content">${message.message}</div>
                <div class="message-details">
                    <div class="message-detail-item">
                        <span class="message-detail-label">Tarih:</span>
                        <span>${date}</span>
                    </div>
                    ${message.service ? `
                        <div class="message-detail-item">
                            <span class="message-detail-label">Hizmet:</span>
                            <span>${message.service}</span>
                        </div>
                    ` : ''}
                </div>
            </div>
        `;
    }).join('');
}

// Open service modal
function openServiceModal(serviceId = null) {
    const modal = document.getElementById('serviceModal');
    const modalTitle = document.getElementById('modalTitle');
    const form = document.getElementById('serviceForm');
    
    if (serviceId) {
        currentEditingServiceId = serviceId;
        const service = window.admin.getServices().find(s => s.id === serviceId);
        if (service) {
            document.getElementById('serviceId').value = service.id;
            document.getElementById('serviceName').value = service.name || '';
            document.getElementById('serviceNameEn').value = service.nameEn || '';
            document.getElementById('serviceDescription').value = service.description || '';
            document.getElementById('serviceDescriptionEn').value = service.descriptionEn || '';
            document.getElementById('serviceIcon').value = service.icon || '';
            
            // Load features
            loadFeatures(service.features || [], 'featuresContainer');
            loadFeatures(service.featuresEn || [], 'featuresEnContainer');
            
            modalTitle.textContent = window.i18n.t('admin.editService');
        }
    } else {
        currentEditingServiceId = null;
        form.reset();
        document.getElementById('featuresContainer').innerHTML = '';
        document.getElementById('featuresEnContainer').innerHTML = '';
        modalTitle.textContent = window.i18n.t('admin.addService');
    }
    
    modal.classList.add('active');
}

// Close service modal
function closeServiceModal() {
    const modal = document.getElementById('serviceModal');
    modal.classList.remove('active');
    currentEditingServiceId = null;
}

// Save service
function saveService() {
    const serviceId = document.getElementById('serviceId').value;
    const name = document.getElementById('serviceName').value.trim();
    const nameEn = document.getElementById('serviceNameEn').value.trim();
    const description = document.getElementById('serviceDescription').value.trim();
    const descriptionEn = document.getElementById('serviceDescriptionEn').value.trim();
    const icon = document.getElementById('serviceIcon').value.trim();

    if (!name || !nameEn || !description || !descriptionEn || !icon) {
        alert('Lütfen tüm zorunlu alanları doldurun.');
        return;
    }

    const features = getFeatures('featuresContainer');
    const featuresEn = getFeatures('featuresEnContainer');

    const serviceData = {
        name,
        nameEn,
        description,
        descriptionEn,
        icon,
        features,
        featuresEn
    };

    if (serviceId) {
        window.admin.updateService(serviceId, serviceData);
    } else {
        window.admin.addService(serviceData);
    }

    loadServices();
    closeServiceModal();
    refreshServicesPage(); // Refresh services page if open
}

// Delete service
function deleteService(id) {
    if (confirm('Bu hizmeti silmek istediğinize emin misiniz?')) {
        window.admin.deleteService(id);
        loadServices();
        refreshServicesPage(); // Refresh services page if open
    }
}

// Edit service
function editService(id) {
    openServiceModal(id);
}

// Delete message
function deleteMessage(id) {
    if (confirm('Bu mesajı silmek istediğinize emin misiniz?')) {
        window.admin.deleteMessage(id);
        loadMessages();
    }
}

// Add feature input
function addFeatureInput(containerId) {
    const container = document.getElementById(containerId);
    const div = document.createElement('div');
    div.className = 'feature-input-wrapper';
    div.innerHTML = `
        <input type="text" class="feature-input" placeholder="${window.i18n.t('admin.addFeature')}">
        <button type="button" class="btn-remove-feature" onclick="this.parentElement.remove()">
            <i class="fas fa-times"></i>
        </button>
    `;
    container.appendChild(div);
}

// Get features from container
function getFeatures(containerId) {
    const container = document.getElementById(containerId);
    const inputs = container.querySelectorAll('.feature-input');
    return Array.from(inputs).map(input => input.value.trim()).filter(val => val);
}

// Load features into container
function loadFeatures(features, containerId) {
    const container = document.getElementById(containerId);
    container.innerHTML = '';
    if (features && features.length > 0) {
        features.forEach(feature => {
            const div = document.createElement('div');
            div.className = 'feature-input-wrapper';
            div.innerHTML = `
                <input type="text" class="feature-input" value="${feature}" placeholder="${window.i18n.t('admin.addFeature')}">
                <button type="button" class="btn-remove-feature" onclick="this.parentElement.remove()">
                    <i class="fas fa-times"></i>
                </button>
            `;
            container.appendChild(div);
        });
    }
}

// Refresh services page if it's open
function refreshServicesPage() {
    if (window.location.pathname.includes('services.html')) {
        // Services page can reload itself or update dynamically
        setTimeout(() => {
            window.location.reload();
        }, 500);
    }
}

// Export for global access
window.deleteService = deleteService;
window.editService = editService;
window.deleteMessage = deleteMessage;
