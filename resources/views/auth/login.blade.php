<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Girişi — Harem Restaurant</title>
    <link rel="stylesheet" href="/css/harem.css">
</head>
<body>
<div class="login-page">
    <div class="login-card">
        <div class="login-logo">
            <span class="login-logo-text">Harem</span>
            <span class="login-logo-sub">Yönetim Paneli</span>
        </div>

        @if($errors->any())
        <div class="alert alert-error">
            ❌ E-posta veya şifre hatalı.
        </div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="form-group">
                <label class="form-label" for="email">E-posta</label>
                <input type="email" id="email" name="email" class="form-control"
                       value="{{ old('email') }}" placeholder="admin@harem.com" required autofocus>
            </div>
            <div class="form-group">
                <label class="form-label" for="password">Şifre</label>
                <input type="password" id="password" name="password" class="form-control"
                       placeholder="••••••••" required>
            </div>
            <div class="form-group" style="display:flex; align-items:center; gap:0.5rem;">
                <input type="checkbox" id="remember" name="remember">
                <label for="remember" style="font-size:0.85rem; color:var(--text-muted); cursor:pointer;">Beni hatırla</label>
            </div>
            <button type="submit" class="btn btn-primary btn-lg" style="width:100%; justify-content:center; margin-top:0.5rem;">
                Giriş Yap
            </button>
        </form>

        <div style="text-align:center; margin-top:1.5rem;">
            <a href="{{ route('home') }}" style="font-size:0.8rem; color:var(--text-muted);">← Siteye Dön</a>
        </div>
    </div>
</div>
</body>
</html>
