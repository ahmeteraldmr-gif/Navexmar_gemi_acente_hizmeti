<!-- Page Header Component -->
<?php
// Header görseli ve overlay ayarlarını al
$headerStyle = '';
if (isset($headerImage) && !empty($headerImage['image_path'])) {
    $headerImageUrl = upload($headerImage['image_path']);
    $headerStyle = "background-image: url('$headerImageUrl');";
}

// Overlay ayarları (eğer varsa)
$overlayOpacity = isset($headerSettings['overlay_opacity']) ? $headerSettings['overlay_opacity'] : 0.5;
$overlayColor = isset($headerSettings['overlay_color']) ? $headerSettings['overlay_color'] : '#000000';
?>

<section class="page-header" style="<?php echo $headerStyle; ?>">
    <div class="page-header-overlay" style="background-color: <?php echo $overlayColor; ?>; opacity: <?php echo $overlayOpacity; ?>;"></div>
    <div class="container">
        <h1><?php echo e($page['title_' . $lang] ?? 'Sayfa Başlığı'); ?></h1>
        <?php if (isset($page['subtitle_' . $lang]) && !empty($page['subtitle_' . $lang])): ?>
            <p><?php echo e($page['subtitle_' . $lang]); ?></p>
        <?php endif; ?>
    </div>
</section>
