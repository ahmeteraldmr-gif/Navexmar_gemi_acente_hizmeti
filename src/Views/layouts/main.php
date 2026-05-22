<!DOCTYPE html>
<html lang="<?php echo e($lang ?? 'tr'); ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo e($page['meta_description_' . $lang] ?? 'Navexmar - Gemi Bakım ve Lojistik Hizmetleri'); ?>">
    <title><?php echo e($page['title_' . $lang] ?? 'Navexmar'); ?> - NAVEXMAR</title>
    
    <!-- Stylesheets -->
    <link rel="stylesheet" href="<?php echo asset('css/style.css'); ?>?v=1.3">
    <link rel="stylesheet" href="<?php echo asset('css/pages.css'); ?>?v=1.3">
    <?php if (isset($additionalCss)): ?>
        <?php foreach ($additionalCss as $css): ?>
            <link rel="stylesheet" href="<?php echo asset($css); ?>">
        <?php endforeach; ?>
    <?php endif; ?>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <!-- Favicon -->
    <?php if (isset($settings['site_favicon']) && !empty($settings['site_favicon'])): ?>
        <link rel="icon" type="image/jpeg" href="<?php echo asset($settings['site_favicon']); ?>?v=1.3">
    <?php endif; ?>
</head>
<body>
    <?php 
    // Navigation dahil et
    require __DIR__ . '/nav.php'; 
    ?>
    
    <!-- Ana içerik -->
    <?php echo $content; ?>
    
    <?php 
    // Footer dahil et
    require __DIR__ . '/footer.php'; 
    ?>
    
    <!-- Scripts -->
    <script src="<?php echo asset('js/i18n.js'); ?>"></script>
    <script src="<?php echo asset('js/main.js'); ?>"></script>
    <?php if (isset($additionalJs)): ?>
        <?php foreach ($additionalJs as $js): ?>
            <script src="<?php echo asset($js); ?>"></script>
        <?php endforeach; ?>
    <?php endif; ?>
</body>
</html>
