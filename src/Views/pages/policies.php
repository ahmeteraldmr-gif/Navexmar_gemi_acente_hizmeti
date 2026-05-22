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

<!-- Policies Content -->
<section class="policies-content">
    <div class="container">
        <div class="content-intro">
            <h2><?php echo e($title('intro')); ?></h2>
            <p>
                <?php echo nl2br(e($content('intro'))); ?>
            </p>
        </div>

        <div class="policies-grid">
            <div class="policy-card">
                <i class="fas fa-star"></i>
                <h3><?php echo e($title('card_1')); ?></h3>
                <p><?php echo nl2br(e($content('card_1'))); ?></p>
            </div>

            <div class="policy-card">
                <i class="fas fa-shield-alt"></i>
                <h3><?php echo e($title('card_2')); ?></h3>
                <p><?php echo nl2br(e($content('card_2'))); ?></p>
            </div>

            <div class="policy-card">
                <i class="fas fa-leaf"></i>
                <h3><?php echo e($title('card_3')); ?></h3>
                <p><?php echo nl2br(e($content('card_3'))); ?></p>
            </div>

            <div class="policy-card">
                <i class="fas fa-balance-scale"></i>
                <h3><?php echo e($title('card_4')); ?></h3>
                <p><?php echo nl2br(e($content('card_4'))); ?></p>
            </div>

            <div class="policy-card">
                <i class="fas fa-user-shield"></i>
                <h3><?php echo e($title('card_5')); ?></h3>
                <p><?php echo nl2br(e($content('card_5'))); ?></p>
            </div>

            <div class="policy-card">
                <i class="fas fa-lock"></i>
                <h3><?php echo e($title('card_6')); ?></h3>
                <p><?php echo nl2br(e($content('card_6'))); ?></p>
            </div>
        </div>

        <!-- Commitments Section -->
        <div style="background: var(--light-color, #f8f9fa); padding: 3rem; border-radius: 15px; margin-top: 4rem;">
            <h3 style="color: var(--primary-color, #1a4d7d); text-align: center; margin-bottom: 2rem;">
                <?php echo $lang === 'tr' ? 'Taahhütlerimiz' : 'Our Commitments'; ?>
            </h3>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 2rem;">
                <div style="text-align: center;">
                    <i class="fas fa-check-circle" style="font-size: 3rem; color: var(--secondary-color, #ff6b35); margin-bottom: 1rem;"></i>
                    <h4 style="margin-bottom: 0.5rem;"><?php echo e($title('commit_1')); ?></h4>
                    <p><?php echo nl2br(e($content('commit_1'))); ?></p>
                </div>
                <div style="text-align: center;">
                    <i class="fas fa-check-circle" style="font-size: 3rem; color: var(--secondary-color, #ff6b35); margin-bottom: 1rem;"></i>
                    <h4 style="margin-bottom: 0.5rem;"><?php echo e($title('commit_2')); ?></h4>
                    <p><?php echo nl2br(e($content('commit_2'))); ?></p>
                </div>
                <div style="text-align: center;">
                    <i class="fas fa-check-circle" style="font-size: 3rem; color: var(--secondary-color, #ff6b35); margin-bottom: 1rem;"></i>
                    <h4 style="margin-bottom: 0.5rem;"><?php echo e($title('commit_3')); ?></h4>
                    <p><?php echo nl2br(e($content('commit_3'))); ?></p>
                </div>
                <div style="text-align: center;">
                    <i class="fas fa-check-circle" style="font-size: 3rem; color: var(--secondary-color, #ff6b35); margin-bottom: 1rem;"></i>
                    <h4 style="margin-bottom: 0.5rem;"><?php echo e($title('commit_4')); ?></h4>
                    <p><?php echo nl2br(e($content('commit_4'))); ?></p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section">
    <div class="container">
        <h2><?php echo e($title('cta')); ?></h2>
        <a href="<?php echo url('/iletisim'); ?>" class="btn btn-light"><?php echo $lang === 'tr' ? 'Bizimle İletişime Geçin' : 'Contact Us'; ?></a>
    </div>
</section>
