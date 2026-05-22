// Admin Panel API Integration
document.addEventListener('DOMContentLoaded', function() {
    // Tab switching
    const tabButtons = document.querySelectorAll('.tab-button');
    const tabContents = document.querySelectorAll('.tab-content');

    tabButtons.forEach(button => {
        button.addEventListener('click', () => {
            const tabName = button.getAttribute('data-tab');
            
            tabButtons.forEach(btn => btn.classList.remove('active'));
            tabContents.forEach(content => content.classList.remove('active'));
            
            button.classList.add('active');
            document.getElementById(`${tabName}-tab`).classList.add('active');
        });
    });

    // Load services
    loadServices();
    
    // Load messages
    loadMessages();

    // Service modal functionality
    const modal = document.getElementById('serviceModal');
    const addServiceBtn = document.getElementById('addServiceBtn');
    const closeModal = document.getElementById('closeModal');
    const cancelBtn = document.getElementById('cancelBtn');
    const serviceForm = document.getElementById('serviceForm');

    addServiceBtn.addEventListener('click', () => {
        openServiceModal();
    });

    closeModal.addEventListener('click', () => {
        modal.style.display = 'none';
    });

    cancelBtn.addEventListener('click', () => {
        modal.style.display = 'none';
    });

    window.addEventListener('click', (e) => {
        if (e.target === modal) {
            modal.style.display = 'none';
        }
    });

    // Service form submit
    serviceForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        await saveService();
    });

    // Add feature buttons
    document.getElementById('addFeatureBtn').addEventListener('click', () => {
        addFeatureInput('featuresContainer');
    });

    document.getElementById('addFeatureEnBtn').addEventListener('click', () => {
        addFeatureInput('featuresEnContainer');
    });
});

// Load services from API
async function loadServices() {
    try {
        const response = await fetch('api/services.php');
        const result = await response.json();
        
        if (result.success) {
            displayServices(result.data);
        }
    } catch (error) {
        console.error('Error loading services:', error);
    }
}

// Display services
function displayServices(services) {
    const servicesList = document.getElementById('servicesList');
    
    if (services.length === 0) {
        servicesList.innerHTML = `
            <div class="empty-state">
                <i class="fas fa-box-open"></i>
                <p>Henüz hizmet eklenmemiş. "Yeni Hizmet Ekle" butonuna tıklayarak başlayın.</p>
            </div>
        `;
        return;
    }
    
    servicesList.innerHTML = '';

    services.forEach(service => {
        const serviceCard = document.createElement('div');
        serviceCard.className = 'service-card';
        serviceCard.innerHTML = `
            <div class="service-header">
                <div class="service-icon">
                    <i class="${service.icon}"></i>
                </div>
                <div class="service-info">
                    <h3>${service.name}</h3>
                    <p class="service-name-en">${service.name_en}</p>
                </div>
                <div class="service-actions">
                    <button class="btn btn-sm btn-secondary" onclick="editService(${service.id})">
                        <i class="fas fa-edit"></i> Düzenle
                    </button>
                    <button class="btn btn-sm btn-danger" onclick="deleteService(${service.id})">
                        <i class="fas fa-trash"></i> Sil
                    </button>
                </div>
            </div>
            <div class="service-body">
                <p><strong>Açıklama (TR):</strong> ${service.description}</p>
                <p><strong>Açıklama (EN):</strong> ${service.description_en}</p>
                ${service.features && service.features.length > 0 ? `
                    <p><strong>Özellikler (TR):</strong></p>
                    <ul>
                        ${service.features.map(f => `<li><i class="fas fa-check-circle" style="color: var(--primary-color); margin-right: 0.5rem;"></i>${f}</li>`).join('')}
                    </ul>
                ` : ''}
                ${service.features_en && service.features_en.length > 0 ? `
                    <p><strong>Özellikler (EN):</strong></p>
                    <ul>
                        ${service.features_en.map(f => `<li><i class="fas fa-check-circle" style="color: var(--primary-color); margin-right: 0.5rem;"></i>${f}</li>`).join('')}
                    </ul>
                ` : ''}
            </div>
        `;
        servicesList.appendChild(serviceCard);
    });
}

// Open service modal
function openServiceModal(service = null) {
    const modal = document.getElementById('serviceModal');
    const modalTitle = document.getElementById('modalTitle');
    const serviceId = document.getElementById('serviceId');
    
    if (service) {
        modalTitle.textContent = 'Hizmeti Düzenle';
        serviceId.value = service.id;
        document.getElementById('serviceName').value = service.name;
        document.getElementById('serviceNameEn').value = service.name_en;
        document.getElementById('serviceDescription').value = service.description;
        document.getElementById('serviceDescriptionEn').value = service.description_en;
        document.getElementById('serviceIcon').value = service.icon;
        
        // Load features
        const featuresContainer = document.getElementById('featuresContainer');
        const featuresEnContainer = document.getElementById('featuresEnContainer');
        featuresContainer.innerHTML = '';
        featuresEnContainer.innerHTML = '';
        
        if (service.features && service.features.length > 0) {
            service.features.forEach(feature => {
                addFeatureInput('featuresContainer', feature);
            });
        }
        
        if (service.features_en && service.features_en.length > 0) {
            service.features_en.forEach(feature => {
                addFeatureInput('featuresEnContainer', feature);
            });
        }
    } else {
        modalTitle.textContent = 'Yeni Hizmet Ekle';
        serviceId.value = '';
        document.getElementById('serviceForm').reset();
        document.getElementById('featuresContainer').innerHTML = '';
        document.getElementById('featuresEnContainer').innerHTML = '';
    }
    
    modal.style.display = 'block';
}

// Add feature input
function addFeatureInput(containerId, value = '') {
    const container = document.getElementById(containerId);
    const featureDiv = document.createElement('div');
    featureDiv.className = 'feature-input-group';
    featureDiv.innerHTML = `
        <input type="text" class="feature-input" value="${value}" placeholder="Özellik">
        <button type="button" class="btn btn-sm btn-danger" onclick="this.parentElement.remove()">
            <i class="fas fa-times"></i>
        </button>
    `;
    container.appendChild(featureDiv);
}

// Save service
async function saveService() {
    const serviceId = document.getElementById('serviceId').value;
    const name = document.getElementById('serviceName').value;
    const nameEn = document.getElementById('serviceNameEn').value;
    const description = document.getElementById('serviceDescription').value;
    const descriptionEn = document.getElementById('serviceDescriptionEn').value;
    const icon = document.getElementById('serviceIcon').value;
    
    // Get features
    const features = Array.from(document.querySelectorAll('#featuresContainer .feature-input'))
        .map(input => input.value)
        .filter(value => value.trim() !== '');
    
    const featuresEn = Array.from(document.querySelectorAll('#featuresEnContainer .feature-input'))
        .map(input => input.value)
        .filter(value => value.trim() !== '');
    
    const serviceData = {
        name,
        name_en: nameEn,
        description,
        description_en: descriptionEn,
        icon,
        features,
        features_en: featuresEn
    };
    
    try {
        let response;
        if (serviceId) {
            // Update
            serviceData.id = serviceId;
            response = await fetch('api/services.php', {
                method: 'PUT',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(serviceData)
            });
        } else {
            // Create
            response = await fetch('api/services.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(serviceData)
            });
        }
        
        const result = await response.json();
        
        if (result.success) {
            document.getElementById('serviceModal').style.display = 'none';
            loadServices();
            alert(result.message);
        } else {
            alert('Hata: ' + result.message);
        }
    } catch (error) {
        console.error('Error saving service:', error);
        alert('Bir hata oluştu!');
    }
}

// Edit service
async function editService(id) {
    try {
        const response = await fetch('api/services.php');
        const result = await response.json();
        
        if (result.success) {
            const service = result.data.find(s => s.id === id);
            if (service) {
                openServiceModal(service);
            }
        }
    } catch (error) {
        console.error('Error loading service:', error);
    }
}

// Delete service
async function deleteService(id) {
    if (!confirm('Bu hizmeti silmek istediğinizden emin misiniz?')) {
        return;
    }
    
    try {
        const response = await fetch(`api/services.php?id=${id}`, {
            method: 'DELETE'
        });
        
        const result = await response.json();
        
        if (result.success) {
            loadServices();
            alert(result.message);
        } else {
            alert('Hata: ' + result.message);
        }
    } catch (error) {
        console.error('Error deleting service:', error);
        alert('Bir hata oluştu!');
    }
}

// Load messages from API
async function loadMessages() {
    try {
        const response = await fetch('api/messages.php');
        const result = await response.json();
        
        if (result.success) {
            displayMessages(result.data);
        }
    } catch (error) {
        console.error('Error loading messages:', error);
    }
}

// Display messages
function displayMessages(messages) {
    const messagesList = document.getElementById('messagesList');
    
    if (messages.length === 0) {
        messagesList.innerHTML = `
            <div class="empty-state">
                <i class="fas fa-inbox"></i>
                <p>Henüz mesaj bulunmamaktadır.</p>
            </div>
        `;
        return;
    }
    
    messagesList.innerHTML = '';

    messages.forEach(message => {
        const messageCard = document.createElement('div');
        messageCard.className = 'message-card' + (message.is_read ? ' read' : '');
        messageCard.innerHTML = `
            <div class="message-header">
                <div class="message-info">
                    <h3><i class="fas fa-user-circle"></i> ${message.name}</h3>
                    <p><i class="fas fa-envelope"></i> ${message.email} ${message.phone ? '<i class="fas fa-phone" style="margin-left: 1rem;"></i> ' + message.phone : ''}</p>
                    ${message.company ? `<p><strong><i class="fas fa-building"></i> Şirket:</strong> ${message.company}</p>` : ''}
                    ${message.service ? `<p><strong><i class="fas fa-concierge-bell"></i> Hizmet:</strong> ${message.service}</p>` : ''}
                    <p class="message-date"><i class="fas fa-clock"></i> ${new Date(message.created_at).toLocaleString('tr-TR')}</p>
                </div>
                <div class="message-actions">
                    <button class="btn btn-sm btn-danger" onclick="deleteMessage(${message.id})">
                        <i class="fas fa-trash-alt"></i> Sil
                    </button>
                </div>
            </div>
            <div class="message-body">
                <p><strong><i class="fas fa-comment-dots"></i> Mesaj:</strong></p>
                <p>${message.message}</p>
            </div>
        `;
        messagesList.appendChild(messageCard);
    });
}

// Delete message
async function deleteMessage(id) {
    if (!confirm('Bu mesajı silmek istediğinizden emin misiniz?')) {
        return;
    }
    
    try {
        const response = await fetch(`api/messages.php?id=${id}`, {
            method: 'DELETE'
        });
        
        const result = await response.json();
        
        if (result.success) {
            loadMessages();
            alert(result.message);
        } else {
            alert('Hata: ' + result.message);
        }
    } catch (error) {
        console.error('Error deleting message:', error);
        alert('Bir hata oluştu!');
    }
}
