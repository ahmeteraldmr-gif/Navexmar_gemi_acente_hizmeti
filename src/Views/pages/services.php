<?php require VIEWS_PATH . '/components/page-header.php'; ?>

<!-- Services Detail Section -->
<section class="services-detail">
    <div class="container">
        <?php if (isset($services) && !empty($services)): ?>
            <?php 
            $index = 0;
            foreach ($services as $service): 
                $reverse = $index % 2 !== 0 ? 'reverse' : '';
                $features = $lang === 'tr' ? $service['features'] : $service['features_en'];
            ?>
                <div class="service-detail-item" id="<?php echo e($service['slug']); ?>">
                    <div class="service-detail-content <?php echo $reverse; ?>">
                        
                        <!-- Left Column (Icon and Title) -->
                        <div class="service-detail-left">
                            <div class="service-detail-icon">
                                <i class="<?php echo e($service['icon'] ?: 'fas fa-ship'); ?>"></i>
                            </div>
                            <h2><?php echo e($service['name_' . $lang]); ?></h2>
                            <h3><?php echo $lang === 'tr' ? 'Özellikler' : 'Features'; ?></h3>
                        </div>
                        
                        <!-- Right Column (Description and Features Grid) -->
                        <div class="service-detail-right">
                            <p class="service-description"><?php echo e($service['description_' . $lang]); ?></p>
                            
                            <div class="service-action-bar">
                                <a href="<?php echo url('/iletisim'); ?>" class="btn btn-orange">
                                    <?php echo $lang === 'tr' ? 'Teklif Alın' : 'Get a Quote'; ?>
                                </a>
                            </div>
                            
                            <?php if (!empty($features)): ?>
                                <ul class="service-features">
                                    <?php foreach ($features as $feature): ?>
                                        <li>
                                            <i class="fas fa-check-circle"></i>
                                            <span><?php echo e($feature); ?></span>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                        </div>
                        
                    </div>
                </div>
            <?php 
                $index++;
            endforeach; ?>
        <?php else: ?>
            <p style="text-align: center; padding: 5rem 0; font-size: 1.2rem; color: #7f8c8d;">
                <i class="fas fa-exclamation-circle" style="font-size: 2rem; color: var(--primary-color); display: block; margin-bottom: 1rem;"></i>
                <?php echo $lang === 'tr' ? 'Henüz hizmet bulunmamaktadır.' : 'No services available yet.'; ?>
            </p>
        <?php endif; ?>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section">
    <div class="container">
        <h2 data-i18n="services.cta.title">Hizmetlerimiz Hakkında Detaylı Bilgi Almak İster Misiniz?</h2>
        <a href="<?php echo url('/iletisim'); ?>" class="btn btn-light" data-i18n="services.cta.button">Bize Ulaşın</a>
    </div>
</section>
