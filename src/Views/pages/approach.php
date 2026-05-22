<?php
// Convert sections to a keyed array for quick access
$sec = [];
foreach ($sections as $s) {
    $sec[$s['section_key']] = $s;
}

// Helper to get section title dynamically based on active language
$title = function($key) use ($sec, $lang) {
    if (!isset($sec[$key])) return '';
    return $lang === 'tr' ? ($sec[$key]['title_tr'] ?? '') : ($sec[$key]['title_en'] ?? '');
};

// Helper to get section content dynamically based on active language
$content = function($key) use ($sec, $lang) {
    if (!isset($sec[$key])) return '';
    return $lang === 'tr' ? ($sec[$key]['content_tr'] ?? '') : ($sec[$key]['content_en'] ?? '');
};

require VIEWS_PATH . '/components/page-header.php'; 
?>

<!-- Approach Content -->
<section class="approach-content">
    <div class="container">
        <div class="approach-intro">
            <h2><?php echo e($title('intro')); ?></h2>
            <p>
                <?php echo nl2br(e($content('intro'))); ?>
            </p>
        </div>

        <div class="approach-grid">
            <div class="approach-card">
                <i class="fas fa-users"></i>
                <h3><?php echo e($title('card_1')); ?></h3>
                <p><?php echo nl2br(e($content('card_1'))); ?></p>
            </div>

            <div class="approach-card">
                <i class="fas fa-handshake"></i>
                <h3><?php echo e($title('card_2')); ?></h3>
                <p><?php echo nl2br(e($content('card_2'))); ?></p>
            </div>

            <div class="approach-card">
                <i class="fas fa-cogs"></i>
                <h3><?php echo e($title('card_3')); ?></h3>
                <p><?php echo nl2br(e($content('card_3'))); ?></p>
            </div>

            <div class="approach-card">
                <i class="fas fa-lightbulb"></i>
                <h3><?php echo e($title('card_4')); ?></h3>
                <p><?php echo nl2br(e($content('card_4'))); ?></p>
            </div>

            <div class="approach-card">
                <i class="fas fa-award"></i>
                <h3><?php echo e($title('card_5')); ?></h3>
                <p><?php echo nl2br(e($content('card_5'))); ?></p>
            </div>

            <div class="approach-card">
                <i class="fas fa-globe"></i>
                <h3><?php echo e($title('card_6')); ?></h3>
                <p><?php echo nl2br(e($content('card_6'))); ?></p>
            </div>
        </div>
    </div>
</section>

<!-- Mission Vision Section -->
<section class="about-section">
    <div class="container">
        <div class="about-content">
            <h2 style="color: white; text-align: center; margin-bottom: 2rem;">
                <?php echo $lang === 'tr' ? 'Misyon ve Vizyonumuz' : 'Our Mission and Vision'; ?>
            </h2>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 3rem; margin-top: 2rem;">
                <div style="text-align: center;">
                    <i class="fas fa-bullseye" style="font-size: 3rem; margin-bottom: 1rem;"></i>
                    <h3 style="margin-bottom: 1rem;"><?php echo e($title('mission')); ?></h3>
                    <p>
                        <?php echo nl2br(e($content('mission'))); ?>
                    </p>
                </div>
                <div style="text-align: center;">
                    <i class="fas fa-eye" style="font-size: 3rem; margin-bottom: 1rem;"></i>
                    <h3 style="margin-bottom: 1rem;"><?php echo e($title('vision')); ?></h3>
                    <p>
                        <?php echo nl2br(e($content('vision'))); ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section">
    <div class="container">
        <h2><?php echo e($title('cta')); ?></h2>
        <a href="<?php echo url('/iletisim'); ?>" class="btn btn-light"><?php echo $lang === 'tr' ? 'İletişime Geçin' : 'Get in Touch'; ?></a>
    </div>
</section>
