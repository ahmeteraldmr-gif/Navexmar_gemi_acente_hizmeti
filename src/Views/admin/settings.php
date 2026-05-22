<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site Ayarları - Navexmar Admin</title>
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
            <a href="<?php echo url('/admin/pages'); ?>" class="nav-item">
                <i class="fas fa-file-alt"></i> Sayfalar
            </a>
            <a href="<?php echo url('/admin/headers'); ?>" class="nav-item">
                <i class="fas fa-images"></i> Header Görselleri
            </a>
            <a href="<?php echo url('/admin/settings'); ?>" class="nav-item active">
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
                <h1>Site Ayarları</h1>
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

            <!-- Settings Form -->
            <form method="POST" action="<?php echo url('/admin/settings/update'); ?>">
                <input type="hidden" name="csrf_token" value="<?php echo generateCSRFToken(); ?>">
                
                <!-- General Settings -->
                <div class="card">
                    <div class="card-header">
                        <h2><i class="fas fa-cog"></i> Genel Ayarlar</h2>
                    </div>
                    <div class="card-body">
                        <?php if (isset($settings['general'])): ?>
                            <?php foreach ($settings['general'] as $setting): ?>
                                <div class="form-group">
                                    <label><?php echo e($setting['description']); ?></label>
                                    <?php if ($setting['setting_key'] === 'site_logo'): ?>
                                        <div style="margin-bottom: 1rem;">
                                            <?php if (!empty($setting['setting_value'])): ?>
                                                <img src="<?php echo asset($setting['setting_value']); ?>" alt="Logo" style="max-height: 50px;">
                                            <?php endif; ?>
                                        </div>
                                        <input type="file" id="logoUpload" accept="image/*">
                                        <button type="button" class="btn btn-sm btn-primary" id="uploadLogoBtn">
                                            <i class="fas fa-upload"></i> Logo Yükle
                                        </button>
                                    <?php else: ?>
                                        <input type="text" 
                                               name="<?php echo e($setting['setting_key']); ?>" 
                                               value="<?php echo e($setting['setting_value']); ?>">
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Contact Settings -->
                <div class="card">
                    <div class="card-header">
                        <h2><i class="fas fa-address-book"></i> İletişim Bilgileri</h2>
                    </div>
                    <div class="card-body">
                        <?php if (isset($settings['contact'])): ?>
                            <?php foreach ($settings['contact'] as $setting): ?>
                                <div class="form-group">
                                    <label><?php echo e($setting['description']); ?></label>
                                    <?php if (strpos($setting['setting_key'], 'address') !== false): ?>
                                        <textarea name="<?php echo e($setting['setting_key']); ?>" rows="3"><?php echo e($setting['setting_value']); ?></textarea>
                                    <?php else: ?>
                                        <input type="text" 
                                               name="<?php echo e($setting['setting_key']); ?>" 
                                               value="<?php echo e($setting['setting_value']); ?>">
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Social Media Settings -->
                <div class="card">
                    <div class="card-header">
                        <h2><i class="fas fa-share-alt"></i> Sosyal Medya</h2>
                    </div>
                    <div class="card-body">
                        <?php if (isset($settings['social'])): ?>
                            <?php foreach ($settings['social'] as $setting): ?>
                                <div class="form-group">
                                    <label>
                                        <i class="fab fa-<?php 
                                            echo strpos($setting['setting_key'], 'facebook') !== false ? 'facebook' : 
                                                (strpos($setting['setting_key'], 'twitter') !== false ? 'twitter' : 
                                                (strpos($setting['setting_key'], 'instagram') !== false ? 'instagram' : 
                                                (strpos($setting['setting_key'], 'linkedin') !== false ? 'linkedin' : 'link'))); 
                                        ?>"></i>
                                        <?php echo e($setting['description']); ?>
                                    </label>
                                    <input type="url" 
                                           name="<?php echo e($setting['setting_key']); ?>" 
                                           value="<?php echo e($setting['setting_value']); ?>"
                                           placeholder="https://">
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- SEO Settings -->
                <div class="card">
                    <div class="card-header">
                        <h2><i class="fas fa-search"></i> SEO Ayarları</h2>
                    </div>
                    <div class="card-body">
                        <?php if (isset($settings['seo'])): ?>
                            <?php foreach ($settings['seo'] as $setting): ?>
                                <div class="form-group">
                                    <label><?php echo e($setting['description']); ?></label>
                                    <?php if (strpos($setting['setting_key'], 'keywords') !== false || strpos($setting['setting_key'], 'description') !== false): ?>
                                        <textarea name="<?php echo e($setting['setting_key']); ?>" rows="3"><?php echo e($setting['setting_value']); ?></textarea>
                                    <?php else: ?>
                                        <input type="text" 
                                               name="<?php echo e($setting['setting_key']); ?>" 
                                               value="<?php echo e($setting['setting_value']); ?>">
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Save Button -->
                <div style="margin-top: 2rem;">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Tüm Ayarları Kaydet
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Sidebar toggle
        document.getElementById('sidebarToggle')?.addEventListener('click', function() {
            document.querySelector('.admin-sidebar').classList.toggle('collapsed');
        });

        // Logo upload
        document.getElementById('uploadLogoBtn')?.addEventListener('click', function() {
            const fileInput = document.getElementById('logoUpload');
            const file = fileInput.files[0];
            
            if (!file) {
                alert('Lütfen bir dosya seçin.');
                return;
            }
            
            const formData = new FormData();
            formData.append('logo', file);
            
            fetch('<?php echo url('/admin/settings/logo'); ?>', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(data.message);
                    location.reload();
                } else {
                    alert(data.message);
                }
            });
        });
    </script>
</body>
</html>
