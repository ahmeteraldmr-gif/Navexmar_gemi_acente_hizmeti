<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sayfalar - Navexmar Admin</title>
    <link rel="stylesheet" href="<?php echo asset('css/style.css'); ?>">
    <link rel="stylesheet" href="<?php echo asset('css/admin.css'); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="admin-body">
    <!-- Sidebar -->
    <div class="admin-sidebar">
        <div class="sidebar-header">
            <h2><i class="fas fa-anchor"></i> NAVEXMAR</h2>
        </div>
        <nav class="sidebar-nav">
            <a href="<?php echo url('/admin'); ?>" class="nav-item">
                <i class="fas fa-tachometer-alt"></i> Dashboard
            </a>
            <a href="<?php echo url('/admin/services'); ?>" class="nav-item">
                <i class="fas fa-briefcase"></i> Hizmetler
            </a>
            <a href="<?php echo url('/admin/messages'); ?>" class="nav-item">
                <i class="fas fa-envelope"></i> Mesajlar
            </a>
            <a href="<?php echo url('/admin/pages'); ?>" class="nav-item active">
                <i class="fas fa-file-alt"></i> Sayfalar
            </a>
            <a href="<?php echo url('/admin/headers'); ?>" class="nav-item">
                <i class="fas fa-images"></i> Header Görselleri
            </a>
            <a href="<?php echo url('/admin/settings'); ?>" class="nav-item">
                <i class="fas fa-cog"></i> Ayarlar
            </a>
        </nav>
        <div class="sidebar-footer">
            <a href="<?php echo url('/admin/logout'); ?>" class="nav-item">
                <i class="fas fa-sign-out-alt"></i> Çıkış
            </a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="admin-main">
        <!-- Top Bar -->
        <div class="admin-topbar">
            <div class="topbar-left">
                <button class="sidebar-toggle" id="sidebarToggle">
                    <i class="fas fa-bars"></i>
                </button>
                <h1>Sayfalar Yönetimi</h1>
            </div>
            <div class="topbar-right">
                <a href="<?php echo url('/'); ?>" target="_blank" class="btn btn-sm btn-primary">
                    <i class="fas fa-external-link-alt"></i> Siteyi Görüntüle
                </a>
            </div>
        </div>

        <!-- Content -->
        <div class="admin-content">
            <?php if (isset($flash)): ?>
                <div class="alert alert-<?php echo e($flash['type']); ?>">
                    <i class="fas fa-<?php echo $flash['type'] === 'success' ? 'check-circle' : 'exclamation-circle'; ?>"></i>
                    <?php echo e($flash['message']); ?>
                </div>
            <?php endif; ?>

            <!-- Pages Grid -->
            <div class="card">
                <div class="card-header">
                    <h2><i class="fas fa-file-alt"></i> Site Sayfaları</h2>
                </div>
                <div class="card-body">
                    <?php if (!empty($pages)): ?>
                        <div class="actions-grid">
                            <?php foreach ($pages as $page): ?>
                                <a href="<?php echo url('/admin/pages/edit/' . $page['page_key']); ?>" class="action-card">
                                    <i class="fas fa-<?php 
                                        echo $page['page_key'] == 'home' ? 'home' : 
                                            ($page['page_key'] == 'services' ? 'briefcase' : 
                                            ($page['page_key'] == 'contact' ? 'envelope' : 
                                            ($page['page_key'] == 'approach' ? 'compass' : 'file-alt'))); 
                                    ?>"></i>
                                    <span><?php echo e($page['title_tr']); ?></span>
                                    <small style="color: #999; font-size: 0.85rem;"><?php echo e($page['title_en']); ?></small>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <div class="text-center text-muted">
                            <p>Henüz sayfa bulunmamaktadır.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Info Box -->
            <div class="card" style="margin-top: 2rem; background: #e3f2fd; border-left: 4px solid #2196F3;">
                <div class="card-body">
                    <h3 style="color: #1976d2; margin-bottom: 1rem;"><i class="fas fa-info-circle"></i> Bilgi</h3>
                    <p style="color: #555; line-height: 1.6;">
                        Bu bölümde site sayfalarınızın başlık, alt başlık ve meta açıklamalarını düzenleyebilirsiniz.
                        Her sayfanın Türkçe ve İngilizce versiyonları bulunmaktadır.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Sidebar toggle
        document.getElementById('sidebarToggle')?.addEventListener('click', function() {
            document.querySelector('.admin-sidebar').classList.toggle('collapsed');
        });
    </script>
</body>
</html>
