<?php
// Hero için header görseli
$heroStyle = '';
if (isset($headerImage) && !empty($headerImage['image_path'])) {
    $heroImageUrl = upload($headerImage['image_path']);
    $heroStyle = "background-image: url('$heroImageUrl');";
}

// Sections'dan içerikleri al
$heroTitle = '';
$heroSubtitle = '';
$heroDescription = '';
$ctaTitle = '';
$aboutDescription = '';

if (isset($sections) && is_array($sections)) {
    foreach ($sections as $section) {
        switch ($section['section_key']) {
            case 'hero_title':
                $heroTitle = $section['title_' . $lang];
                break;
            case 'hero_subtitle':
                $heroSubtitle = $section['title_' . $lang];
                break;
            case 'hero_description':
                $heroDescription = $section['content_' . $lang];
                break;
            case 'cta_title':
                $ctaTitle = $section['title_' . $lang];
                break;
            case 'about_description':
                $aboutDescription = $section['content_' . $lang];
                break;
        }
    }
}
?>

<!-- Hero Section -->
<section class="hero" style="<?php echo $heroStyle; ?>">
    <div class="hero-overlay"></div>
    <div class="hero-content">
        <div class="container">
            <h2 class="hero-subtitle" data-i18n="home.hero.subtitle">
                <?php echo e($heroTitle ?: 'EN İYİYİ KEŞFEDİN'); ?>
            </h2>
            <h1 class="hero-title" data-i18n="home.hero.title">
                <?php echo e($heroSubtitle ?: 'OPTİMİZASYONA ADANMIŞ'); ?>
            </h1>
            <p class="hero-description" data-i18n="home.hero.description">
                <?php echo e($heroDescription ?: 'Navexmar, sektördeki diğer firmalardan farklı bir yaklaşımla gemi bakım ve uluslararası ticaret hizmetleri sunan bir şirkettir.'); ?>
            </p>
            <a href="<?php echo url('/yaklasimimiz'); ?>" class="btn btn-primary" data-i18n="common.readMore">Daha Fazla Bilgi</a>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="stats">
    <div class="container">
        <div class="stats-grid">
            <div class="stat-item">
                <i class="fas fa-ship"></i>
                <h3 class="stat-number" data-target="15">0</h3>
                <p data-i18n="home.stats.drydock">Kuru Havuzlama</p>
            </div>
            <div class="stat-item">
                <i class="fas fa-wrench"></i>
                <h3 class="stat-number" data-target="30">0</h3>
                <p data-i18n="home.stats.floating">Yüzer Onarım</p>
            </div>
            <div class="stat-item">
                <i class="fas fa-cogs"></i>
                <h3 class="stat-number" data-target="18">0</h3>
                <p data-i18n="home.stats.bwts">BWTS Kurulumu</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section">
    <div class="container">
        <h2 data-i18n="home.cta.title">
            <?php echo e($ctaTitle ?: 'Şimdi Bizimle İletişime Geçin!'); ?>
        </h2>
        <a href="<?php echo url('/iletisim'); ?>" class="btn btn-light" data-i18n="common.contact">İletişim</a>
    </div>
</section>

<!-- FLOKI Section -->
<section class="floki-section">
    <div class="container">
        <div class="floki-grid">
            <div class="floki-item">
                <h3>N</h3>
                <p data-i18n="home.floki.n">Navigasyon</p>
            </div>
            <div class="floki-item">
                <h3>A</h3>
                <p data-i18n="home.floki.a">Azimli</p>
            </div>
            <div class="floki-item">
                <h3>V</h3>
                <p data-i18n="home.floki.v">Verimli</p>
            </div>
            <div class="floki-item">
                <h3>E</h3>
                <p data-i18n="home.floki.e">Enerjik</p>
            </div>
            <div class="floki-item">
                <h3>X</h3>
                <p data-i18n="home.floki.x">Mükemmel</p>
            </div>
        </div>
    </div>
</section>

<!-- Services Section -->
<section class="services-section">
    <div class="container">
        <h2 class="section-title" data-i18n="home.services.title">HİZMETLERİMİZ</h2>
        <div class="services-grid">
            <?php if (isset($services) && !empty($services)): ?>
                <?php foreach ($services as $service): ?>
                    <div class="service-card">
                        <div class="service-icon">
                            <i class="<?php echo e($service['icon']); ?>"></i>
                        </div>
                        <h3><?php echo e($service['name_' . $lang]); ?></h3>
                        <p><?php echo e($service['description_' . $lang]); ?></p>
                        <a href="<?php echo url('/hizmetlerimiz#' . e($service['slug'])); ?>" class="btn btn-secondary">
                            <?php echo $lang === 'tr' ? 'Detayları Gör' : 'View Details'; ?>
                        </a>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="loading" style="text-align: center; padding: 2rem;">
                    <p data-i18n="home.services.loading">Hizmetler yükleniyor...</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- About Section -->
<section class="about-section">
    <div class="container">
        <div class="about-content">
            <p data-i18n="home.about.description">
                <?php echo e($aboutDescription ?: 'Navexmar, sektördeki diğer firmalardan farklı bir yaklaşımla gemi bakım hizmetleri sunan bir şirkettir.'); ?>
            </p>
        </div>
    </div>
</section>
