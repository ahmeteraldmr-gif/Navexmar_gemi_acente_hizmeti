<!-- Footer -->
<footer class="footer">
    <div class="container">
        <div class="footer-grid">
            <!-- Menü -->
            <div class="footer-col">
                <h4 data-i18n="footer.menu">Menü</h4>
                <ul>
                    <li><a href="<?php echo url('/'); ?>" data-i18n="nav.home">Ana Sayfa</a></li>
                    <li><a href="<?php echo url('/yaklasimimiz'); ?>" data-i18n="nav.approach">Yaklaşımımız</a></li>
                    <li><a href="<?php echo url('/hizmetlerimiz'); ?>" data-i18n="nav.services">Hizmetler</a></li>
                    <li><a href="<?php echo url('/iletisim'); ?>" data-i18n="nav.contact">İletişim</a></li>
                </ul>
            </div>
            
            <!-- İletişim -->
            <div class="footer-col">
                <h4 data-i18n="footer.contact">İletişim</h4>
                <ul>
                    <li>
                        <i class="fas fa-envelope"></i> 
                        <?php 
                        echo e($settings['contact_email_1'] ?? 'agency@navexmar.com'); 
                        if (isset($settings['contact_email_2'])): echo '<br>' . e($settings['contact_email_2']); endif;
                        if (isset($settings['contact_email_3'])): echo '<br>' . e($settings['contact_email_3']); endif;
                        ?>
                    </li>
                    <li>
                        <i class="fas fa-phone"></i> 
                        <?php 
                        if (isset($settings['contact_phone_1'])): echo e($settings['contact_phone_1']); endif;
                        if (isset($settings['contact_phone_2'])): echo '<br>' . e($settings['contact_phone_2']); endif;
                        ?>
                    </li>
                    <li>
                        <i class="fas fa-map-marker-alt"></i> 
                        <span data-i18n="footer.location">
                            <?php echo e($settings['contact_city'] ?? 'Hatay'); ?>, 
                            <?php echo e($settings['contact_country'] ?? 'Türkiye'); ?>
                        </span>
                    </li>
                </ul>
            </div>
            
            <!-- Çalışma Saatleri -->
            <div class="footer-col">
                <h4 data-i18n="footer.workingHours">Çalışma Saatleri</h4>
                <ul>
                    <li data-i18n="footer.workingHoursDesc">
                        <?php echo e($settings['working_hours'] ?? 'Zaman Kısıtı Olmaksızın 7/24 Operasyon Takibi Ve Her Aşamada Erişilebilir Opersayon Ekibi'); ?>
                    </li>
                </ul>
            </div>
            
            <!-- Bülten -->
            <div class="footer-col">
                <h4 data-i18n="footer.newsletter">Bülten</h4>
                <p data-i18n="footer.newsletterDesc">Haberlerden haberdar olun</p>
                <form class="newsletter-form" id="newsletterForm">
                    <input type="email" name="email" data-i18n="footer.emailPlaceholder" data-i18n-placeholder="true" placeholder="E-posta adresiniz" required>
                    <button type="submit" data-i18n="common.send">Gönder</button>
                </form>
            </div>
        </div>
        
        <!-- Social Media Links -->
        <?php if (isset($settings['social_facebook']) || isset($settings['social_twitter']) || 
                  isset($settings['social_linkedin']) || isset($settings['social_instagram'])): ?>
        <div class="footer-social" style="text-align: center; margin-top: 2rem; padding-top: 2rem; border-top: 1px solid rgba(255,255,255,0.1);">
            <?php if (!empty($settings['social_facebook'])): ?>
                <a href="<?php echo e($settings['social_facebook']); ?>" target="_blank" rel="noopener" style="margin: 0 10px;">
                    <i class="fab fa-facebook-f"></i>
                </a>
            <?php endif; ?>
            <?php if (!empty($settings['social_twitter'])): ?>
                <a href="<?php echo e($settings['social_twitter']); ?>" target="_blank" rel="noopener" style="margin: 0 10px;">
                    <i class="fab fa-twitter"></i>
                </a>
            <?php endif; ?>
            <?php if (!empty($settings['social_linkedin'])): ?>
                <a href="<?php echo e($settings['social_linkedin']); ?>" target="_blank" rel="noopener" style="margin: 0 10px;">
                    <i class="fab fa-linkedin-in"></i>
                </a>
            <?php endif; ?>
            <?php if (!empty($settings['social_instagram'])): ?>
                <a href="<?php echo e($settings['social_instagram']); ?>" target="_blank" rel="noopener" style="margin: 0 10px;">
                    <i class="fab fa-instagram"></i>
                </a>
            <?php endif; ?>
        </div>
        <?php endif; ?>
        
        <!-- Copyright -->
        <div class="footer-bottom">
            <p>&copy; <?php echo date('Y'); ?> <?php echo e($settings['site_name'] ?? 'Navexmar'); ?>. 
            <span data-i18n="footer.copyright">Tüm Hakları Saklıdır.</span></p>
        </div>
    </div>
</footer>
