<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e($page['title_tr']); ?> Düzenle - Navexmar Admin</title>
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
                <h1><?php echo e($page['title_tr']); ?> - Sayfa Düzenleme</h1>
            </div>
            <div class="topbar-right">
                <a href="<?php echo url('/admin/pages'); ?>" class="btn btn-sm btn-secondary">
                    <i class="fas fa-arrow-left"></i> Geri Dön
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

            <!-- Page Edit Form -->
            <style>
                .tab-btn {
                    background: none;
                    border: none;
                    font-size: 1rem;
                    font-weight: 600;
                    padding: 0.75rem 1.5rem;
                    cursor: pointer;
                    color: #6c757d;
                    border-bottom: 3px solid transparent;
                    transition: all 0.3s ease;
                    display: flex;
                    align-items: center;
                    gap: 0.5rem;
                }
                .tab-btn.active {
                    color: var(--primary);
                    border-bottom: 3px solid var(--primary);
                }
                .tab-btn:hover {
                    color: var(--primary);
                }
                .form-section-card {
                    background: #fff;
                    border-radius: 12px;
                    box-shadow: 0 4px 15px rgba(0,0,0,0.05);
                    border: 1px solid #eef2f5;
                    border-left: 5px solid var(--primary);
                    margin-bottom: 2rem;
                    transition: all 0.3s ease;
                }
                .form-section-card:hover {
                    transform: translateY(-2px);
                    box-shadow: 0 6px 20px rgba(0,0,0,0.08);
                }
                .section-header-badge {
                    background: #f1f5f9;
                    padding: 0.25rem 0.75rem;
                    border-radius: 20px;
                    font-size: 0.8rem;
                    color: #475569;
                    font-weight: 600;
                }
                .form-grid {
                    display: grid;
                    grid-template-columns: 1fr 1fr;
                    gap: 2rem;
                }
                @media (max-width: 992px) {
                    .form-grid {
                        grid-template-columns: 1fr;
                        gap: 1.5rem;
                    }
                }
                .form-group {
                    margin-bottom: 1.25rem;
                }
                .form-group label {
                    display: block;
                    font-weight: 600;
                    margin-bottom: 0.5rem;
                    color: #495057;
                    font-size: 0.95rem;
                }
                .form-group input, .form-group textarea {
                    width: 100%;
                    padding: 0.75rem 1rem;
                    border: 1.5px solid #dee2e6;
                    border-radius: 8px;
                    font-family: inherit;
                    font-size: 0.95rem;
                    color: #495057;
                    transition: all 0.3s ease;
                    background-color: #fdfdfd;
                }
                .form-group input:focus, .form-group textarea:focus {
                    outline: none;
                    border-color: var(--primary);
                    background-color: #fff;
                    box-shadow: 0 0 0 3px rgba(26, 77, 125, 0.1);
                }
                .flag-tr { color: #d63031; }
                .flag-en { color: #0984e3; }
            </style>

            <form method="POST" action="<?php echo url('/admin/pages/update'); ?>">
                <input type="hidden" name="page_key" value="<?php echo e($page['page_key']); ?>">

                <!-- Tab Navigation -->
                <div class="admin-tabs" style="display: flex; gap: 1rem; margin-bottom: 2rem; border-bottom: 2px solid #e2e8f0; padding-bottom: 0.5rem;">
                    <button type="button" class="tab-btn active" id="btn-seo" onclick="switchTab('seo-tab')">
                        <i class="fas fa-search"></i> Genel & SEO Ayarları
                    </button>
                    <?php if (!empty($sections)): ?>
                    <button type="button" class="tab-btn" id="btn-sections" onclick="switchTab('sections-tab')">
                        <i class="fas fa-th-list"></i> Sayfa İçerikleri & Kartlar (<?php echo count($sections); ?> Bölüm)
                    </button>
                    <?php endif; ?>
                </div>

                <!-- Tab 1: SEO & General -->
                <div id="seo-tab" class="tab-content">
                    <div class="card" style="border-left: 5px solid var(--secondary);">
                        <div class="card-header">
                            <h2><i class="fas fa-info-circle"></i> Genel Sayfa Bilgileri & SEO</h2>
                        </div>
                        <div class="card-body">
                            <div class="form-grid">
                                <!-- Türkçe Versiyonu -->
                                <div style="border-right: 1px solid #e2e8f0; padding-right: 1.5rem;">
                                    <h3 style="color: #d63031; margin-bottom: 1.5rem;"><i class="fas fa-flag"></i> Türkçe Başlık & Arama Motoru Ayarları</h3>
                                    
                                    <div class="form-group">
                                        <label>Sayfa Ana Başlığı (TR) <span style="color:red;">*</span></label>
                                        <input type="text" name="title_tr" value="<?php echo e($page['title_tr']); ?>" required>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Sayfa Alt Başlığı (TR)</label>
                                        <input type="text" name="subtitle_tr" value="<?php echo e($page['subtitle_tr'] ?? ''); ?>">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Arama Motoru Açıklaması (Meta Description TR)</label>
                                        <textarea name="meta_description_tr" rows="4"><?php echo e($page['meta_description_tr'] ?? ''); ?></textarea>
                                        <small class="text-muted">Arama motorlarında (Google) görünecek 150-160 karakterlik özet yazı.</small>
                                    </div>
                                </div>

                                <!-- English Version -->
                                <div style="padding-left: 0.5rem;">
                                    <h3 style="color: #0984e3; margin-bottom: 1.5rem;"><i class="fas fa-flag"></i> English Title & SEO Settings</h3>
                                    
                                    <div class="form-group">
                                        <label>Page Title (EN) <span style="color:red;">*</span></label>
                                        <input type="text" name="title_en" value="<?php echo e($page['title_en']); ?>" required>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Page Subtitle (EN)</label>
                                        <input type="text" name="subtitle_en" value="<?php echo e($page['subtitle_en'] ?? ''); ?>">
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Search Engine Description (Meta Description EN)</label>
                                        <textarea name="meta_description_en" rows="4"><?php echo e($page['meta_description_en'] ?? ''); ?></textarea>
                                        <small class="text-muted">English summary of this page that appears in Google search results.</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tab 2: Sections Content -->
                <?php if (!empty($sections)): ?>
                <div id="sections-tab" class="tab-content" style="display: none;">
                    <div style="margin-bottom: 1.5rem; padding: 1rem; background-color: #ebf5ff; border-radius: 8px; border-left: 4px solid var(--primary); display: flex; align-items: center; gap: 0.75rem;">
                        <i class="fas fa-lightbulb" style="color: var(--primary); font-size: 1.2rem;"></i>
                        <span style="font-size: 0.95rem; color: #1e3a8a; font-weight: 500;">
                            Aşağıda sayfanın dinamik olarak düzenlenen tüm alanları listelenmiştir. Her alanı hem Türkçe hem İngilizce olarak doldurabilirsiniz.
                        </span>
                    </div>

                    <?php foreach ($sections as $section): ?>
                        <?php
                        $friendlyName = $section['section_key'];
                        if ($section['section_key'] === 'intro') {
                            $friendlyName = 'Giriş Bölümü (Intro)';
                        } elseif (strpos($section['section_key'], 'card_') === 0) {
                            $num = substr($section['section_key'], 5);
                            $friendlyName = 'İçerik Kartı ' . $num . ' (Card ' . $num . ')';
                        } elseif ($section['section_key'] === 'mission') {
                            $friendlyName = 'Misyonumuz (Our Mission)';
                        } elseif ($section['section_key'] === 'vision') {
                            $friendlyName = 'Vizyonumuz (Our Vision)';
                        } elseif ($section['section_key'] === 'cta') {
                            $friendlyName = 'Harekete Geçirici Mesaj / Alt Alan (CTA)';
                        } elseif (strpos($section['section_key'], 'commit_') === 0) {
                            $num = substr($section['section_key'], 7);
                            $friendlyName = 'Değer / Taahhüt ' . $num . ' (Commitment ' . $num . ')';
                        }
                        ?>
                        <div class="form-section-card">
                            <div class="card-header" style="background: rgba(26, 77, 125, 0.03); border-bottom: 1px solid #eef2f5; display: flex; justify-content: space-between; align-items: center; padding: 1rem 1.5rem;">
                                <h3 style="font-size: 1.05rem; margin: 0; color: var(--primary); font-weight: 700;">
                                    <i class="fas fa-puzzle-piece" style="margin-right: 0.25rem;"></i> <?php echo e($friendlyName); ?>
                                </h3>
                                <span class="section-header-badge">Anahtar: <?php echo e($section['section_key']); ?></span>
                            </div>
                            <div class="card-body" style="padding: 1.5rem;">
                                <div class="form-grid">
                                    <!-- Türkçe Versiyon -->
                                    <div style="border-right: 1px solid #e2e8f0; padding-right: 1.5rem;">
                                        <h4 style="color: #d63031; margin-bottom: 1rem; font-size: 0.95rem; font-weight: 700; display: flex; align-items: center; gap: 0.4rem;">
                                            <i class="fas fa-flag"></i> Türkçe
                                        </h4>
                                        <div class="form-group">
                                            <label>Başlık (TR)</label>
                                            <input type="text" name="sections[<?php echo e($section['section_key']); ?>][title_tr]" value="<?php echo e($section['title_tr']); ?>">
                                        </div>
                                        <div class="form-group" style="margin-bottom: 0;">
                                            <label>İçerik (TR)</label>
                                            <textarea name="sections[<?php echo e($section['section_key']); ?>][content_tr]" rows="4"><?php echo e($section['content_tr']); ?></textarea>
                                        </div>
                                    </div>
                                    
                                    <!-- English Version -->
                                    <div style="padding-left: 0.5rem;">
                                        <h4 style="color: #0984e3; margin-bottom: 1rem; font-size: 0.95rem; font-weight: 700; display: flex; align-items: center; gap: 0.4rem;">
                                            <i class="fas fa-flag"></i> English
                                        </h4>
                                        <div class="form-group">
                                            <label>Title (EN)</label>
                                            <input type="text" name="sections[<?php echo e($section['section_key']); ?>][title_en]" value="<?php echo e($section['title_en']); ?>">
                                        </div>
                                        <div class="form-group" style="margin-bottom: 0;">
                                            <label>Content (EN)</label>
                                            <textarea name="sections[<?php echo e($section['section_key']); ?>][content_en]" rows="4"><?php echo e($section['content_en']); ?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>

                <!-- Form Action Buttons -->
                <div class="card" style="margin-top: 2rem; border-top: 3px solid var(--primary); box-shadow: 0 4px 15px rgba(0,0,0,0.05);">
                    <div class="card-body" style="padding: 1.25rem 1.5rem; display: flex; gap: 1rem; justify-content: space-between; align-items: center;">
                        <span style="font-size: 0.9rem; color: #64748b; font-weight: 500;">
                            <i class="fas fa-info-circle"></i> Düzenlemeleri tamamladıktan sonra aşağıdaki kaydet butonunu kullanın.
                        </span>
                        <div style="display: flex; gap: 1rem;">
                            <button type="submit" class="btn btn-primary" style="background: var(--primary); border: none; padding: 0.75rem 2rem; border-radius: 8px; font-weight: 700; color: white;">
                                <i class="fas fa-save"></i> Değişiklikleri Kaydet
                            </button>
                            <a href="<?php echo url('/admin/pages'); ?>" class="btn btn-secondary" style="background: #e2e8f0; color: #475569; padding: 0.75rem 2rem; border-radius: 8px; font-weight: 700;">
                                <i class="fas fa-times"></i> İptal
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Sidebar toggle
        document.getElementById('sidebarToggle')?.addEventListener('click', function() {
            document.querySelector('.admin-sidebar').classList.toggle('collapsed');
        });

        // Tab Switcher
        function switchTab(tabId) {
            // Hide all tab contents
            document.querySelectorAll('.tab-content').forEach(function(content) {
                content.style.display = 'none';
            });
            
            // Show target tab content
            document.getElementById(tabId).style.display = 'block';
            
            // Reset active states on all tab buttons
            document.querySelectorAll('.tab-btn').forEach(function(btn) {
                btn.classList.remove('active');
            });
            
            // Set active class to active button
            if (tabId === 'seo-tab') {
                document.getElementById('btn-seo').classList.add('active');
            } else if (tabId === 'sections-tab') {
                document.getElementById('btn-sections').classList.add('active');
            }
        }
    </script>
</body>
</html>
