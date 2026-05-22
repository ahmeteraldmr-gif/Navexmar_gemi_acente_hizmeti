<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Sayfa Bulunamadı | Navexmar</title>
    <link rel="stylesheet" href="<?php echo asset('css/style.css'); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .error-page {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #1a4d7d 0%, #144066 100%);
            color: white;
            text-align: center;
            padding: 2rem;
        }
        .error-content {
            max-width: 600px;
        }
        .error-code {
            font-size: 8rem;
            font-weight: bold;
            margin: 0;
            line-height: 1;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }
        .error-title {
            font-size: 2rem;
            margin: 1rem 0;
        }
        .error-description {
            font-size: 1.1rem;
            margin: 1.5rem 0;
            opacity: 0.9;
        }
        .error-actions {
            margin-top: 2rem;
        }
        .btn {
            display: inline-block;
            padding: 1rem 2rem;
            margin: 0 0.5rem;
            background: white;
            color: #1a4d7d;
            text-decoration: none;
            border-radius: 5px;
            font-weight: 600;
            transition: all 0.3s;
        }
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
        }
        .btn-secondary {
            background: transparent;
            color: white;
            border: 2px solid white;
        }
        .btn-secondary:hover {
            background: white;
            color: #1a4d7d;
        }
        .error-icon {
            font-size: 5rem;
            margin-bottom: 1rem;
            opacity: 0.8;
        }
    </style>
</head>
<body>
    <div class="error-page">
        <div class="error-content">
            <div class="error-icon">
                <i class="fas fa-ship"></i>
            </div>
            <h1 class="error-code">404</h1>
            <h2 class="error-title">Sayfa Bulunamadı</h2>
            <p class="error-description">
                Üzgünüz, aradığınız sayfa bulunamadı. Sayfa kaldırılmış, adı değiştirilmiş veya geçici olarak kullanılamıyor olabilir.
            </p>
            <div class="error-actions">
                <a href="<?php echo url('/'); ?>" class="btn">
                    <i class="fas fa-home"></i> Ana Sayfaya Dön
                </a>
                <a href="<?php echo url('/iletisim'); ?>" class="btn btn-secondary">
                    <i class="fas fa-envelope"></i> İletişime Geç
                </a>
            </div>
        </div>
    </div>
</body>
</html>
