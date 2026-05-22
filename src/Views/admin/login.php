<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Girişi - Navexmar</title>
    <link rel="stylesheet" href="<?php echo asset('css/style.css'); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #1a4d7d 0%, #144066 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }
        .login-container {
            background: white;
            padding: 3rem;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.3);
            max-width: 450px;
            width: 100%;
        }
        .login-logo {
            text-align: center;
            margin-bottom: 2rem;
        }
        .login-logo i {
            font-size: 4rem;
            color: #1a4d7d;
            margin-bottom: 1rem;
        }
        .login-logo h1 {
            color: #1a4d7d;
            margin-bottom: 0.5rem;
            font-size: 2rem;
        }
        .login-logo p {
            color: #666;
            font-size: 0.9rem;
        }
        .form-group {
            margin-bottom: 1.5rem;
        }
        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: #333;
            font-weight: 500;
        }
        .form-group input {
            width: 100%;
            padding: 0.875rem;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 1rem;
            transition: border-color 0.3s;
        }
        .form-group input:focus {
            outline: none;
            border-color: #1a4d7d;
        }
        .flash-message {
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        .flash-error {
            background: #fee;
            color: #c33;
            border-left: 4px solid #c33;
        }
        .flash-success {
            background: #d4edda;
            color: #155724;
            border-left: 4px solid #28a745;
        }
        .btn-login {
            width: 100%;
            padding: 1rem;
            background: #1a4d7d;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }
        .btn-login:hover {
            background: #ff6b35;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }
        .login-footer {
            text-align: center;
            margin-top: 2rem;
            color: #666;
            font-size: 0.875rem;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-logo">
            <i class="fas fa-shield-alt"></i>
            <h1>NAVEXMAR</h1>
            <p>Admin Paneli Girişi</p>
        </div>
        
        <?php if (isset($flash)): ?>
            <div class="flash-message flash-<?php echo e($flash['type']); ?>">
                <i class="fas fa-<?php echo $flash['type'] === 'error' ? 'exclamation-circle' : 'check-circle'; ?>"></i>
                <span><?php echo e($flash['message']); ?></span>
            </div>
        <?php endif; ?>
        
        <form method="POST" action="<?php echo url('/admin/auth'); ?>">
            <div class="form-group">
                <label for="username"><i class="fas fa-user"></i> Kullanıcı Adı</label>
                <input type="text" id="username" name="username" required autofocus placeholder="Kullanıcı adınızı girin">
            </div>
            
            <div class="form-group">
                <label for="password"><i class="fas fa-lock"></i> Şifre</label>
                <input type="password" id="password" name="password" required placeholder="Şifrenizi girin">
            </div>
            
            <button type="submit" class="btn-login">
                <i class="fas fa-sign-in-alt"></i> Giriş Yap
            </button>
        </form>
        
        <div class="login-footer">
            <p>&copy; <?php echo date('Y'); ?> Navexmar. Tüm hakları saklıdır.</p>
        </div>
    </div>
</body>
</html>
