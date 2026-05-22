// ==========================================
// CONTACT FORM HANDLER
// Kullanım: İletişim formunu yönetir ve doğrulama yapar
// ==========================================

const contactForm = document.getElementById('contactForm');

if (contactForm) {
    contactForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Form verilerini al
        const formData = {
            name: document.getElementById('name').value,
            email: document.getElementById('email').value,
            phone: document.getElementById('phone').value,
            company: document.getElementById('company').value,
            service: document.getElementById('service').value,
            message: document.getElementById('message').value
        };

        // Form doğrulama
        if (!formData.name || !formData.email || !formData.message) {
            showNotification('Lütfen zorunlu alanları doldurun.', 'error');
            return;
        }

        // E-posta formatı kontrolü
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(formData.email)) {
            showNotification('Lütfen geçerli bir e-posta adresi girin.', 'error');
            return;
        }

        // Burada gerçek bir API çağrısı yapılabilir
        // Örnek: fetch('/api/contact', { method: 'POST', body: JSON.stringify(formData) })
        
        // Simüle edilmiş başarılı gönderim
        console.log('Form Data:', formData);
        
        // Başarı mesajı göster
        showNotification('Mesajınız başarıyla gönderildi! En kısa sürede size dönüş yapacağız.', 'success');
        
        // Formu temizle
        contactForm.reset();
    });
}

// ==========================================
// NOTIFICATION SYSTEM
// Kullanım: Kullanıcıya bildirim gösterir
// ==========================================
function showNotification(message, type = 'success') {
    // Var olan bildirimleri kaldır
    const existingNotification = document.querySelector('.notification');
    if (existingNotification) {
        existingNotification.remove();
    }

    // Yeni bildirim oluştur
    const notification = document.createElement('div');
    notification.className = `notification notification-${type}`;
    notification.innerHTML = `
        <div class="notification-content">
            <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'}"></i>
            <span>${message}</span>
        </div>
        <button class="notification-close"><i class="fas fa-times"></i></button>
    `;

    // Stil ekle
    notification.style.cssText = `
        position: fixed;
        top: 100px;
        right: 20px;
        background: ${type === 'success' ? '#4caf50' : '#f44336'};
        color: white;
        padding: 1.5rem 2rem;
        border-radius: 10px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.3);
        z-index: 9999;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        min-width: 300px;
        max-width: 500px;
        animation: slideInRight 0.5s ease;
    `;

    // Animasyon ekle
    const style = document.createElement('style');
    style.textContent = `
        @keyframes slideInRight {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }
        @keyframes slideOutRight {
            from {
                transform: translateX(0);
                opacity: 1;
            }
            to {
                transform: translateX(100%);
                opacity: 0;
            }
        }
        .notification-content {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        .notification-content i {
            font-size: 1.5rem;
        }
        .notification-close {
            background: none;
            border: none;
            color: white;
            font-size: 1.2rem;
            cursor: pointer;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: opacity 0.3s;
        }
        .notification-close:hover {
            opacity: 0.7;
        }
    `;
    document.head.appendChild(style);

    document.body.appendChild(notification);

    // Kapat butonu işlevi
    const closeBtn = notification.querySelector('.notification-close');
    closeBtn.addEventListener('click', () => {
        notification.style.animation = 'slideOutRight 0.5s ease';
        setTimeout(() => notification.remove(), 500);
    });

    // Otomatik kapat (5 saniye)
    setTimeout(() => {
        if (notification.parentElement) {
            notification.style.animation = 'slideOutRight 0.5s ease';
            setTimeout(() => notification.remove(), 500);
        }
    }, 5000);
}

// ==========================================
// FORM INPUT VALIDATION
// Kullanım: Gerçek zamanlı form doğrulama
// ==========================================
const formInputs = document.querySelectorAll('.contact-form input, .contact-form textarea, .contact-form select');

formInputs.forEach(input => {
    input.addEventListener('blur', function() {
        validateInput(this);
    });

    input.addEventListener('input', function() {
        if (this.classList.contains('invalid')) {
            validateInput(this);
        }
    });
});

function validateInput(input) {
    const value = input.value.trim();
    
    // Zorunlu alan kontrolü
    if (input.required && !value) {
        setInvalid(input, 'Bu alan zorunludur');
        return false;
    }

    // E-posta kontrolü
    if (input.type === 'email' && value) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(value)) {
            setInvalid(input, 'Geçerli bir e-posta adresi girin');
            return false;
        }
    }

    // Telefon kontrolü (basit)
    if (input.type === 'tel' && value) {
        const phoneRegex = /^[\d\s\-\+\(\)]+$/;
        if (!phoneRegex.test(value)) {
            setInvalid(input, 'Geçerli bir telefon numarası girin');
            return false;
        }
    }

    setValid(input);
    return true;
}

function setInvalid(input, message) {
    input.classList.add('invalid');
    input.classList.remove('valid');
    input.style.borderColor = '#f44336';
    
    // Hata mesajı varsa güncelle, yoksa ekle
    let errorMsg = input.parentElement.querySelector('.error-message');
    if (!errorMsg) {
        errorMsg = document.createElement('span');
        errorMsg.className = 'error-message';
        errorMsg.style.cssText = 'color: #f44336; font-size: 0.85rem; margin-top: 0.3rem; display: block;';
        input.parentElement.appendChild(errorMsg);
    }
    errorMsg.textContent = message;
}

function setValid(input) {
    input.classList.remove('invalid');
    input.classList.add('valid');
    input.style.borderColor = '#4caf50';
    
    // Hata mesajını kaldır
    const errorMsg = input.parentElement.querySelector('.error-message');
    if (errorMsg) {
        errorMsg.remove();
    }
}

// ==========================================
// CHARACTER COUNTER FOR TEXTAREA
// Kullanım: Mesaj alanı için karakter sayacı
// ==========================================
const messageTextarea = document.getElementById('message');
if (messageTextarea) {
    const maxLength = 1000;
    
    // Karakter sayacı ekle
    const counter = document.createElement('div');
    counter.className = 'character-counter';
    counter.style.cssText = 'text-align: right; color: #666; font-size: 0.9rem; margin-top: 0.5rem;';
    counter.textContent = `0 / ${maxLength}`;
    messageTextarea.parentElement.appendChild(counter);

    messageTextarea.addEventListener('input', function() {
        const length = this.value.length;
        counter.textContent = `${length} / ${maxLength}`;
        
        if (length > maxLength) {
            counter.style.color = '#f44336';
            this.value = this.value.substring(0, maxLength);
        } else if (length > maxLength * 0.9) {
            counter.style.color = '#ff9800';
        } else {
            counter.style.color = '#666';
        }
    });
}

