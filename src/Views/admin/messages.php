<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mesajlar - Navexmar Admin</title>
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
            <a href="<?php echo url('/admin/messages'); ?>" class="nav-item active">
                <i class="fas fa-envelope"></i> Mesajlar
                <?php if ($unreadCount > 0): ?>
                    <span class="badge"><?php echo $unreadCount; ?></span>
                <?php endif; ?>
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
                <h1>Mesajlar</h1>
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

            <!-- Messages Stats -->
            <div class="stats-grid" style="margin-bottom: 2rem;">
                <div class="stat-card">
                    <div class="stat-icon" style="background: #2196F3;">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div class="stat-info">
                        <h3><?php echo count($messages); ?></h3>
                        <p>Toplam Mesaj</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon" style="background: #FF9800;">
                        <i class="fas fa-envelope-open"></i>
                    </div>
                    <div class="stat-info">
                        <h3><?php echo $unreadCount; ?></h3>
                        <p>Okunmamış Mesaj</p>
                    </div>
                </div>
            </div>

            <!-- Messages List -->
            <div class="card">
                <div class="card-header">
                    <h2><i class="fas fa-envelope"></i> Tüm Mesajlar</h2>
                </div>
                <div class="card-body">
                    <?php if (!empty($messages)): ?>
                        <div class="messages-list">
                            <?php foreach ($messages as $message): ?>
                                <div class="message-card <?php echo $message['is_read'] ? 'read' : ''; ?>" data-id="<?php echo $message['id']; ?>">
                                    <div class="message-header">
                                        <div class="message-info">
                                            <h3><?php echo e($message['name']); ?></h3>
                                            <p><strong>E-posta:</strong> <a href="mailto:<?php echo e($message['email']); ?>"><?php echo e($message['email']); ?></a></p>
                                            <p><strong>Telefon:</strong> <?php echo e($message['phone'] ?? '-'); ?></p>
                                            <?php if (!empty($message['service'])): ?>
                                                <p><strong>Hizmet:</strong> <?php echo e($message['service']); ?></p>
                                            <?php endif; ?>
                                            <p class="message-date"><?php echo date('d.m.Y H:i', strtotime($message['created_at'])); ?></p>
                                        </div>
                                        <div class="message-actions">
                                            <?php if (!$message['is_read']): ?>
                                                <button class="btn btn-sm btn-primary mark-read" data-id="<?php echo $message['id']; ?>">
                                                    <i class="fas fa-check"></i> Okundu İşaretle
                                                </button>
                                            <?php endif; ?>
                                            <button class="btn btn-sm btn-danger delete-message" data-id="<?php echo $message['id']; ?>">
                                                <i class="fas fa-trash"></i> Sil
                                            </button>
                                        </div>
                                    </div>
                                    <div class="message-body">
                                        <p><?php echo nl2br(e($message['message'])); ?></p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <div class="text-center text-muted">
                            <p>Henüz mesaj bulunmamaktadır.</p>
                        </div>
                    <?php endif; ?>
                </div>
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

        // Mark as read
        document.querySelectorAll('.mark-read').forEach(btn => {
            btn.addEventListener('click', function() {
                const id = this.dataset.id;
                fetch(`<?php echo url('/admin/messages/read/'); ?>${id}`, {
                    method: 'POST'
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        this.closest('.message-card').classList.add('read');
                        this.remove();
                        location.reload();
                    }
                });
            });
        });

        // Delete message
        document.querySelectorAll('.delete-message').forEach(btn => {
            btn.addEventListener('click', function() {
                if (confirm('Bu mesajı silmek istediğinizden emin misiniz?')) {
                    const id = this.dataset.id;
                    fetch(`<?php echo url('/admin/messages/delete/'); ?>${id}`, {
                        method: 'POST'
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            this.closest('.message-card').remove();
                            location.reload();
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>
