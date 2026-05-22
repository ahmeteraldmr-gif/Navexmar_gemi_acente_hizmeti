<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header Görselleri - Navexmar Admin</title>
    <link rel="stylesheet" href="<?php echo asset('css/style.css'); ?>">
    <link rel="stylesheet" href="<?php echo asset('css/admin.css'); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .header-images-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-top: 1.5rem;
        }
        .header-image-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }
        .header-image-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
        }
        .header-image-preview {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        .header-image-info {
            padding: 1rem;
        }
        .header-image-actions {
            display: flex;
            gap: 0.5rem;
            margin-top: 0.75rem;
        }
        .page-section {
            margin-bottom: 3rem;
        }
        .upload-area {
            border: 2px dashed #ccc;
            border-radius: 12px;
            padding: 2rem;
            text-align: center;
            background: #f9f9f9;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .upload-area:hover {
            border-color: var(--primary);
            background: #f0f8ff;
        }
        .upload-area i {
            font-size: 3rem;
            color: var(--primary);
            margin-bottom: 1rem;
        }
    </style>
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
            <a href="<?php echo url('/admin/headers'); ?>" class="nav-item active">
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
                <h1>Header Görselleri Yönetimi</h1>
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

            <!-- Upload Section -->
            <div class="card">
                <div class="card-header">
                    <h2><i class="fas fa-upload"></i> Yeni Görsel Yükle</h2>
                </div>
                <div class="card-body">
                    <form id="uploadForm" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Sayfa Seçin</label>
                            <select name="page_key" id="pageKey" required>
                                <?php if (!empty($pages)): ?>
                                    <?php foreach ($pages as $page): ?>
                                        <option value="<?php echo e($page['page_key']); ?>">
                                            <?php echo e($page['title_tr']); ?> (<?php echo e($page['title_en']); ?>)
                                        </option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                        <div class="upload-area" id="uploadArea">
                            <div id="uploadDefault">
                                <i class="fas fa-cloud-upload-alt"></i>
                                <p>Görseli buraya sürükleyin veya tıklayın</p>
                            </div>
                            <div id="uploadPreview" style="display: none;">
                                <img id="previewImage" src="" style="max-height: 180px; max-width: 100%; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); margin-bottom: 0.75rem; display: block; margin-left: auto; margin-right: auto; object-fit: contain;">
                                <p style="margin: 0; font-size: 0.9rem; color: #2c5f8d; font-weight: 600;"><i class="fas fa-check-circle"></i> Görsel Seçildi (Değiştirmek için tıklayın)</p>
                            </div>
                            <input type="file" name="image" id="imageInput" accept="image/*" style="display: none;" required>
                        </div>
                        <button type="submit" class="btn btn-primary" style="margin-top: 1rem;">
                            <i class="fas fa-upload"></i> Yükle
                        </button>
                    </form>
                </div>
            </div>

            <!-- Images by Page -->
            <?php if (!empty($pages)): ?>
                <?php foreach ($pages as $page): ?>
                    <div class="page-section">
                        <div class="card">
                            <div class="card-header">
                                <h2><i class="fas fa-images"></i> <?php echo e($page['title_tr']); ?> - Header Görselleri</h2>
                            </div>
                            <div class="card-body">
                                <?php 
                                $pageKey = $page['page_key'];
                                $pageImages = $imagesByPage[$pageKey] ?? [];
                                ?>
                                <?php if (!empty($pageImages)): ?>
                                    <div class="header-images-grid">
                                        <?php foreach ($pageImages as $image): ?>
                                            <div class="header-image-card">
                                                <img src="<?php echo upload($image['image_path']); ?>" alt="Header" class="header-image-preview">
                                                <div class="header-image-info">
                                                    <p style="font-size: 0.9rem; color: #666; margin-bottom: 0.5rem;">
                                                        <?php echo e($image['image_name']); ?>
                                                    </p>
                                                    <p style="font-size: 0.85rem; color: #999;">
                                                        <?php echo date('d.m.Y', strtotime($image['created_at'])); ?>
                                                    </p>
                                                    <div class="header-image-actions">
                                                        <button class="btn btn-sm <?php echo $image['is_active'] ? 'btn-secondary' : 'btn-primary'; ?> toggle-active" 
                                                                data-id="<?php echo $image['id']; ?>">
                                                            <i class="fas fa-<?php echo $image['is_active'] ? 'eye-slash' : 'eye'; ?>"></i>
                                                            <?php echo $image['is_active'] ? 'Pasif' : 'Aktif'; ?>
                                                        </button>
                                                        <button class="btn btn-sm btn-danger delete-image" data-id="<?php echo $image['id']; ?>">
                                                            <i class="fas fa-trash"></i> Sil
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                <?php else: ?>
                                    <div class="text-center text-muted">
                                        <p>Bu sayfa için henüz görsel yüklenmemiş.</p>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

    <script>
        // Sidebar toggle
        document.getElementById('sidebarToggle')?.addEventListener('click', function() {
            document.querySelector('.admin-sidebar').classList.toggle('collapsed');
        });

        // Upload area drag-and-drop & preview
        const uploadArea = document.getElementById('uploadArea');
        const imageInput = document.getElementById('imageInput');
        const uploadDefault = document.getElementById('uploadDefault');
        const uploadPreview = document.getElementById('uploadPreview');
        const previewImage = document.getElementById('previewImage');

        // Prevent default drag behaviors
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            uploadArea.addEventListener(eventName, preventDefaults, false);
            document.body.addEventListener(eventName, preventDefaults, false);
        });

        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }

        // Highlight drop area on hover
        ['dragenter', 'dragover'].forEach(eventName => {
            uploadArea.addEventListener(eventName, () => {
                uploadArea.style.borderColor = 'var(--primary)';
                uploadArea.style.background = '#eaf4fc';
            }, false);
        });

        ['dragleave', 'drop'].forEach(eventName => {
            uploadArea.addEventListener(eventName, () => {
                uploadArea.style.borderColor = '#ccc';
                uploadArea.style.background = '#f9f9f9';
            }, false);
        });

        // Handle dropped files
        uploadArea.addEventListener('drop', (e) => {
            const files = e.dataTransfer.files;
            if (files.length) {
                imageInput.files = files;
                imageInput.dispatchEvent(new Event('change'));
            }
        }, false);

        // Handle click-selected files
        imageInput.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                showPreview(this.files[0]);
            }
        });

        // Safe click trigger
        uploadArea.addEventListener('click', function(e) {
            if (e.target !== imageInput) {
                imageInput.click();
            }
        });

        function showPreview(file) {
            if (!file.type.startsWith('image/')) return;
            const reader = new FileReader();
            reader.readAsDataURL(file);
            reader.onloadend = function() {
                previewImage.src = reader.result;
                uploadDefault.style.display = 'none';
                uploadPreview.style.display = 'block';
            }
        }

        // Upload form
        document.getElementById('uploadForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            
            fetch('<?php echo url('/admin/headers/upload'); ?>', {
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

        // Toggle active
        document.querySelectorAll('.toggle-active').forEach(btn => {
            btn.addEventListener('click', function() {
                const id = this.dataset.id;
                fetch(`<?php echo url('/admin/headers/toggle/'); ?>${id}`, {
                    method: 'POST'
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    }
                });
            });
        });

        // Delete image
        document.querySelectorAll('.delete-image').forEach(btn => {
            btn.addEventListener('click', function() {
                if (confirm('Bu görseli silmek istediğinizden emin misiniz?')) {
                    const id = this.dataset.id;
                    fetch(`<?php echo url('/admin/headers/delete/'); ?>${id}`, {
                        method: 'POST'
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            location.reload();
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>
