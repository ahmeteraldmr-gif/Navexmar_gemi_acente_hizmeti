<?php require VIEWS_PATH . '/components/page-header.php'; ?>

<!-- Flash Message -->
<?php if (isset($flash)): ?>
    <div class="flash-message flash-<?php echo e($flash['type']); ?>" style="padding: 1rem; margin: 1rem auto; max-width: 800px; text-align: center; border-radius: 5px; background: <?php echo $flash['type'] === 'success' ? '#d4edda' : '#f8d7da'; ?>; color: <?php echo $flash['type'] === 'success' ? '#155724' : '#721c24'; ?>;">
        <?php echo e($flash['message']); ?>
    </div>
<?php endif; ?>

<!-- Contact Section -->
<section class="contact-section">
    <div class="container">
        <div class="contact-grid">
            <!-- Contact Form -->
            <div class="contact-form-wrapper">
                <h2><?php echo $lang === 'tr' ? 'Mesaj Gönderin' : 'Send Message'; ?></h2>
                <p><?php echo $lang === 'tr' ? 'Sorularınız ve talepleriniz için formu doldurun, en kısa sürede size dönüş yapalım.' : 'Fill out the form for your questions and requests, we will get back to you as soon as possible.'; ?></p>
                
                <form class="contact-form" method="POST" action="<?php echo url('/iletisim/gonder'); ?>">
                    <input type="hidden" name="csrf_token" value="<?php echo generateCSRFToken(); ?>">
                    
                    <div class="form-group">
                        <label for="name"><?php echo $lang === 'tr' ? 'Adınız Soyadınız *' : 'Your Full Name *'; ?></label>
                        <input type="text" id="name" name="name" required value="<?php echo e($_SESSION['form_data']['name'] ?? ''); ?>">
                    </div>

                    <div class="form-group">
                        <label for="email"><?php echo $lang === 'tr' ? 'E-posta Adresiniz *' : 'Your Email *'; ?></label>
                        <input type="email" id="email" name="email" required value="<?php echo e($_SESSION['form_data']['email'] ?? ''); ?>">
                    </div>

                    <div class="form-group">
                        <label for="phone"><?php echo $lang === 'tr' ? 'Telefon Numaranız' : 'Your Phone'; ?></label>
                        <input type="tel" id="phone" name="phone" value="<?php echo e($_SESSION['form_data']['phone'] ?? ''); ?>">
                    </div>

                    <div class="form-group">
                        <label for="company"><?php echo $lang === 'tr' ? 'Firma Adı' : 'Company Name'; ?></label>
                        <input type="text" id="company" name="company" value="<?php echo e($_SESSION['form_data']['company'] ?? ''); ?>">
                    </div>

                    <div class="form-group">
                        <label for="service"><?php echo $lang === 'tr' ? 'Hizmet Seçimi' : 'Service Selection'; ?></label>
                        <select id="service" name="service">
                            <option value=""><?php echo $lang === 'tr' ? 'Seçiniz...' : 'Select...'; ?></option>
                            <option value="docking"><?php echo $lang === 'tr' ? 'Havuzlama Hizmeti' : 'Docking Service'; ?></option>
                            <option value="workshop"><?php echo $lang === 'tr' ? 'Atölye Hizmetleri' : 'Workshop Services'; ?></option>
                            <option value="onboard"><?php echo $lang === 'tr' ? 'Gemi Üzeri Hizmetler' : 'Onboard Services'; ?></option>
                            <option value="supply"><?php echo $lang === 'tr' ? 'Tedarik Hizmetleri' : 'Supply Services'; ?></option>
                            <option value="engineering"><?php echo $lang === 'tr' ? 'Mühendislik Hizmetleri' : 'Engineering Services'; ?></option>
                            <option value="bwts">BWTS <?php echo $lang === 'tr' ? 'Kurulumu' : 'Installation'; ?></option>
                            <option value="scrubber">Scrubber <?php echo $lang === 'tr' ? 'Kurulumu' : 'Installation'; ?></option>
                            <option value="predictive"><?php echo $lang === 'tr' ? 'Öngörücü Bakım' : 'Predictive Maintenance'; ?></option>
                            <option value="other"><?php echo $lang === 'tr' ? 'Diğer' : 'Other'; ?></option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="message"><?php echo $lang === 'tr' ? 'Mesajınız *' : 'Your Message *'; ?></label>
                        <textarea id="message" name="message" rows="5" required><?php echo e($_SESSION['form_data']['message'] ?? ''); ?></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-paper-plane"></i> <?php echo $lang === 'tr' ? 'Gönder' : 'Send'; ?>
                    </button>
                </form>
            </div>

            <!-- Contact Info -->
            <div class="contact-info-wrapper">
                <h2><?php echo $lang === 'tr' ? 'İletişim Bilgileri' : 'Contact Information'; ?></h2>
                
                <div class="contact-info-item">
                    <div class="contact-info-icon">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <div class="contact-info-text">
                        <h3><?php echo $lang === 'tr' ? 'Adres' : 'Address'; ?></h3>
                        <p><?php echo e($contactInfo['contact_address'] ?? 'Hatay, Türkiye'); ?></p>
                    </div>
                </div>

                <div class="contact-info-item">
                    <div class="contact-info-icon">
                        <i class="fas fa-phone"></i>
                    </div>
                    <div class="contact-info-text">
                        <h3><?php echo $lang === 'tr' ? 'Telefon' : 'Phone'; ?></h3>
                        <p>
                            <?php echo e($contactInfo['contact_phone_1'] ?? '+90 530 379 31 33'); ?>
                            <?php if (isset($contactInfo['contact_phone_2'])): ?>
                                <br><?php echo e($contactInfo['contact_phone_2']); ?>
                            <?php endif; ?>
                        </p>
                    </div>
                </div>

                <div class="contact-info-item">
                    <div class="contact-info-icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div class="contact-info-text">
                        <h3><?php echo $lang === 'tr' ? 'E-posta' : 'Email'; ?></h3>
                        <p>
                            <?php echo e($contactInfo['contact_email_1'] ?? 'agency@navexmar.com'); ?>
                            <?php if (isset($contactInfo['contact_email_2'])): ?>
                                <br><?php echo e($contactInfo['contact_email_2']); ?>
                            <?php endif; ?>
                            <?php if (isset($contactInfo['contact_email_3'])): ?>
                                <br><?php echo e($contactInfo['contact_email_3']); ?>
                            <?php endif; ?>
                        </p>
                    </div>
                </div>

                <div class="contact-info-item">
                    <div class="contact-info-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="contact-info-text">
                        <h3><?php echo $lang === 'tr' ? 'Çalışma Saatleri' : 'Working Hours'; ?></h3>
                        <p><?php echo e($contactInfo['working_hours'] ?? '7/24 Available'); ?></p>
                    </div>
                </div>

                <div class="social-links">
                    <h3><?php echo $lang === 'tr' ? 'Sosyal Medya' : 'Social Media'; ?></h3>
                    <div class="social-icons">
                        <a href="#" target="_blank"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" target="_blank"><i class="fab fa-twitter"></i></a>
                        <a href="#" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#" target="_blank"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Map Section -->
<section class="map-section">
    <div class="map-placeholder">
        <i class="fas fa-map-marked-alt"></i>
        <p><?php echo $lang === 'tr' ? 'Harita entegrasyonu buraya eklenebilir' : 'Map integration can be added here'; ?></p>
    </div>
</section>
