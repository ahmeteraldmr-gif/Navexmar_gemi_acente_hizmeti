<!-- Navigation -->
<nav class="navbar">
    <div class="container">
        <div class="nav-wrapper">
            <div class="logo">
                <a href="<?php echo url('/'); ?>">
                    <?php if (isset($settings['site_logo']) && !empty($settings['site_logo'])): ?>
                        <img src="<?php echo asset($settings['site_logo']); ?>" alt="NAVEXMAR Logo" class="logo-img">
                    <?php endif; ?>
                    <h1><?php echo e($settings['site_name'] ?? 'NAVEXMAR'); ?></h1>
                </a>
            </div>
            <div class="hamburger" id="hamburger">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <ul class="nav-menu" id="navMenu">
                <li>
                    <a href="<?php echo url('/'); ?>" class="<?php echo (isset($activePage) && $activePage === 'home') ? 'active' : ''; ?>" data-i18n="nav.home">
                        Ana Sayfa
                    </a>
                </li>
                <li>
                    <a href="<?php echo url('/yaklasimimiz'); ?>" class="<?php echo (isset($activePage) && $activePage === 'approach') ? 'active' : ''; ?>" data-i18n="nav.approach">
                        Yaklaşımımız
                    </a>
                </li>
                <li class="dropdown">
                    <a href="<?php echo url('/hizmetlerimiz'); ?>" class="<?php echo (isset($activePage) && $activePage === 'services') ? 'active' : ''; ?>" data-i18n="nav.services">
                        Hizmetler <i class="fas fa-chevron-down"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <?php if (isset($services) && !empty($services)): ?>
                            <?php foreach(array_slice($services, 0, 5) as $service): ?>
                                <li>
                                    <a href="<?php echo url('/hizmetlerimiz#' . e($service['slug'])); ?>">
                                        <?php echo e($service['name_' . $lang]); ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <li><a href="<?php echo url('/hizmetlerimiz'); ?>" data-i18n="services.view_all">Tümünü Görüntüle</a></li>
                        <?php endif; ?>
                    </ul>
                </li>
                <li>
                    <a href="<?php echo url('/politikalarimiz'); ?>" class="<?php echo (isset($activePage) && $activePage === 'policies') ? 'active' : ''; ?>" data-i18n="nav.policies">
                        Politikalarımız
                    </a>
                </li>
                <li>
                    <a href="<?php echo url('/iletisim'); ?>" class="<?php echo (isset($activePage) && $activePage === 'contact') ? 'active' : ''; ?>" data-i18n="nav.contact">
                        İletişim
                    </a>
                </li>
                <li class="language-selector">
                    <a href="#" class="lang-toggle">
                        <i class="fas fa-globe"></i> 
                        <span class="lang-text"><?php echo strtoupper($lang); ?></span> 
                        <i class="fas fa-chevron-down"></i>
                    </a>
                    <ul class="language-menu">
                        <li>
                            <a href="<?php echo url('/lang/tr'); ?>" class="lang-option" data-lang="tr">
                                🇹🇷 Türkçe
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo url('/lang/en'); ?>" class="lang-option" data-lang="en">
                                🇬🇧 English
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
