<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hizmetler Yönetimi - Navexmar Admin</title>
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
            <a href="<?php echo url('/admin/services'); ?>" class="nav-item active">
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
                <h1>Hizmetler Yönetimi</h1>
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

            <!-- Add Service Button -->
            <div class="card-header">
                <h2><i class="fas fa-briefcase"></i> Tüm Hizmetler (<?php echo count($services); ?>)</h2>
                <button class="btn btn-primary" id="addServiceBtn">
                    <i class="fas fa-plus"></i> Yeni Hizmet Ekle
                </button>
            </div>

            <!-- Services List -->
            <div class="card">
                <div class="card-body">
                    <?php if (!empty($services)): ?>
                        <div id="servicesList">
                            <?php foreach ($services as $service): ?>
                                <div class="service-card" data-id="<?php echo $service['id']; ?>">
                                    <div class="service-header">
                                        <div class="service-icon">
                                            <?php echo $service['icon'] ?: '📋'; ?>
                                        </div>
                                        <div class="service-info">
                                            <h3><?php echo e($service['name']); ?></h3>
                                            <p class="service-name-en"><?php echo e($service['name_en']); ?></p>
                                        </div>
                                        <div class="service-actions">
                                            <button class="btn btn-sm btn-primary edit-service" data-id="<?php echo $service['id']; ?>">
                                                <i class="fas fa-edit"></i> Düzenle
                                            </button>
                                            <button class="btn btn-sm btn-danger delete-service" data-id="<?php echo $service['id']; ?>">
                                                <i class="fas fa-trash"></i> Sil
                                            </button>
                                        </div>
                                    </div>
                                    <div class="service-body">
                                        <p><strong>Açıklama (TR):</strong> <?php echo e(substr($service['description'], 0, 150)); ?>...</p>
                                        <?php if (!empty($service['features'])): ?>
                                            <p><strong>Özellikler:</strong></p>
                                            <ul>
                                                <?php 
                                                $features = is_string($service['features']) ? json_decode($service['features'], true) : $service['features'];
                                                if (is_array($features)):
                                                    foreach (array_slice($features, 0, 3) as $feature):
                                                ?>
                                                    <li><?php echo e($feature); ?></li>
                                                <?php endforeach; endif; ?>
                                            </ul>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <div class="text-center text-muted">
                            <p>Henüz hizmet eklenmemiş.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Service Modal -->
    <div id="serviceModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 id="modalTitle">Yeni Hizmet Ekle</h2>
                <button class="modal-close">&times;</button>
            </div>
            <div class="modal-body">
                <form id="serviceForm">
                    <input type="hidden" id="serviceId" name="id">
                    
                    <!-- Service Name TR -->
                    <div class="form-group">
                        <label><i class="fas fa-heading"></i> Hizmet Adı (TR)</label>
                        <input type="text" name="name" id="serviceName" required>
                    </div>
                    
                    <!-- Service Name EN -->
                    <div class="form-group">
                        <label><i class="fas fa-heading"></i> Service Name (EN)</label>
                        <input type="text" name="name_en" id="serviceNameEn" required>
                    </div>
                    
                    <!-- Icon -->
                    <div class="form-group">
                        <label><i class="fas fa-icons"></i> İkon (Emoji)</label>
                        <input type="text" name="icon" id="serviceIcon" placeholder="⚓">
                    </div>
                    
                    <!-- Description TR -->
                    <div class="form-group">
                        <label><i class="fas fa-align-left"></i> Açıklama (TR)</label>
                        <textarea name="description" id="serviceDescription" rows="4" required></textarea>
                    </div>
                    
                    <!-- Description EN -->
                    <div class="form-group">
                        <label><i class="fas fa-align-left"></i> Description (EN)</label>
                        <textarea name="description_en" id="serviceDescriptionEn" rows="4" required></textarea>
                    </div>
                    
                    <!-- Features TR -->
                    <div class="form-group">
                        <label><i class="fas fa-list"></i> Özellikler (TR)</label>
                        <div id="featuresTr"></div>
                        <button type="button" class="btn btn-secondary btn-sm" id="addFeatureTr">
                            <i class="fas fa-plus"></i> Özellik Ekle
                        </button>
                    </div>
                    
                    <!-- Features EN -->
                    <div class="form-group">
                        <label><i class="fas fa-list"></i> Features (EN)</label>
                        <div id="featuresEn"></div>
                        <button type="button" class="btn btn-secondary btn-sm" id="addFeatureEn">
                            <i class="fas fa-plus"></i> Add Feature
                        </button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary modal-close">İptal</button>
                <button class="btn btn-primary" id="saveServiceBtn">Kaydet</button>
            </div>
        </div>
    </div>

    <script>
        window.BASE_URL = "<?php echo url(); ?>";
    </script>
    <script src="<?php echo asset('js/admin.js'); ?>?v=<?php echo time(); ?>"></script>
    <script>
        // Sidebar toggle
        document.getElementById('sidebarToggle')?.addEventListener('click', function() {
            document.querySelector('.admin-sidebar').classList.toggle('collapsed');
        });

        // Services management script burada yüklenecek (admin.js içinde)
    </script>
</body>
</html>
