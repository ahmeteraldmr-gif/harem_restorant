<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="@yield('meta_description', 'Bodrum\'un kalbinde eşsiz Ege lezzetleri. Harem Restaurant — deniz manzaralı terasımızda unutulmaz bir deneyim.')">
    <title>@yield('title', 'Harem Restaurant') — Bodrum</title>
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2280%22 fill=%22%23C9A96E%22 font-weight=%22bold%22 font-family=%22serif%22>H</text></svg>">
    <link rel="stylesheet" href="{{ asset('css/harem.css') }}?v={{ time() }}">
    <style>
        /* Language Dropdown Styles */
        .desktop-lang-switcher {
            position: relative;
            margin-right: 1rem;
        }
        .lang-dropdown-btn {
            background: transparent;
            border: 1px solid rgba(255,255,255,0.2);
            color: var(--gold);
            padding: 0.3rem 0.6rem;
            border-radius: var(--radius-sm);
            cursor: pointer;
            font-weight: bold;
            display: flex;
            align-items: center;
            gap: 0.3rem;
            transition: var(--transition);
        }
        .lang-dropdown-btn:hover {
            border-color: var(--gold);
            background: rgba(201, 169, 110, 0.1);
        }
        .lang-dropdown-content {
            position: absolute;
            top: 100%;
            right: 0;
            background: var(--navy);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: var(--radius-sm);
            min-width: 120px;
            margin-top: 0.5rem;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: var(--transition);
            box-shadow: 0 4px 20px rgba(0,0,0,0.5);
            z-index: 100;
        }
        .desktop-lang-switcher:hover .lang-dropdown-content {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }
        .lang-dropdown-content a {
            display: block;
            padding: 0.6rem 1rem;
            color: var(--white);
            text-decoration: none;
            transition: var(--transition);
            font-size: 0.9rem;
        }
        .lang-dropdown-content a:hover,
        .lang-dropdown-content a.active {
            background: rgba(255,255,255,0.05);
            color: var(--gold);
        }
        
        @media (max-width: 768px) {
            .desktop-lang-switcher {
                display: none !important;
            }
        }
        
        .mobile-lang-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 0.5rem;
            width: 100%;
        }
        .mobile-lang-grid a {
            display: block;
            text-align: center;
            padding: 0.5rem;
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: var(--radius-sm);
            text-decoration: none;
            font-weight: bold;
            transition: var(--transition);
        }
        .mobile-lang-grid a.active {
            border-color: var(--gold);
            color: var(--gold) !important;
            background: rgba(201, 169, 110, 0.1);
        }
    </style>
    @yield('head')
</head>
<body>

{{-- ── Navigation ─────────────────────────────────────────────────────── --}}
{{-- ── Navigation ─────────────────────────────────────────────────────── --}}
<nav class="navbar" id="navbar">
    <div class="container">
        <div class="navbar-inner">
            <a href="{{ route('home') }}" class="navbar-logo">
                <div class="logo-crest-wrapper">
                    <!-- Bespoke Premium Golden Crest Icon -->
                    <svg class="navbar-logo-icon" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="50" cy="50" r="44" fill="none" stroke="var(--gold)" stroke-width="2.5" stroke-dasharray="2 2" opacity="0.85"/>
                        <path d="M50 15 L50 85 M15 50 L85 50" stroke="var(--gold)" stroke-width="1" opacity="0.4"/>
                        <polygon points="50,22 62,38 50,54 38,38" fill="none" stroke="var(--gold)" stroke-width="1.5" stroke-linejoin="round"/>
                        <polygon points="50,46 62,62 50,78 38,62" fill="none" stroke="var(--gold)" stroke-width="1.5" stroke-linejoin="round"/>
                        <path d="M50 30 L50 70 M30 50 L70 50" stroke="var(--gold)" stroke-width="2" stroke-linecap="round"/>
                        <circle cx="50" cy="50" r="5" fill="var(--gold)"/>
                    </svg>
                </div>
                <div class="navbar-logo-brand">
                    <span class="navbar-logo-text">HAREM</span>
                    <span class="navbar-logo-sub">B O D R U M</span>
                </div>
            </a>

            <ul class="nav-links" id="navLinks">
                <li><a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">{{ __('Anasayfa') }}</a></li>
                <li><a href="{{ route('menu') }}" class="nav-link {{ request()->routeIs('menu') ? 'active' : '' }}">{{ __('Menü') }}</a></li>
                <li><a href="{{ route('hakkimizda') }}" class="nav-link {{ request()->routeIs('hakkimizda') ? 'active' : '' }}">{{ __('Hakkımızda') }}</a></li>
                <li><a href="{{ route('galeri') }}" class="nav-link {{ request()->routeIs('galeri') ? 'active' : '' }}">{{ __('Galeri') }}</a></li>
                <li><a href="{{ route('iletisim') }}" class="nav-link {{ request()->routeIs('iletisim') ? 'active' : '' }}">{{ __('İletişim') }}</a></li>
            </ul>

            <div class="navbar-actions">
                <div class="desktop-lang-switcher">
                    @php
                        $locales = ['tr' => 'Türkçe', 'en' => 'English', 'es' => 'Español', 'ar' => 'العربية', 'ru' => 'Русский'];
                        $currentLocale = app()->getLocale();
                    @endphp
                    <button class="lang-dropdown-btn">
                        {{ strtoupper($currentLocale) }}
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                    </button>
                    <div class="lang-dropdown-content">
                        @foreach($locales as $code => $name)
                            <a href="{{ route('lang.switch', $code) }}" class="{{ $currentLocale == $code ? 'active' : '' }}">
                                {{ $name }} ({{ strtoupper($code) }})
                            </a>
                        @endforeach
                    </div>
                </div>
                <a href="{{ route('rezervasyon') }}" class="navbar-cta-btn">{{ __('Rezervasyon Yap') }}</a>
                <button class="hamburger" id="hamburger" aria-label="Menüyü aç">
                    <span></span><span></span><span></span>
                </button>
            </div>
        </div>
    </div>
</nav>

{{-- ── Mobile Premium Menu Slideout ───────────────────────────────────────── --}}
<div class="mobile-menu-overlay" id="mobileMenuOverlay">
    <div class="mobile-menu-header">
        <a href="{{ route('home') }}" class="navbar-logo">
            <div class="navbar-logo-brand">
                <span class="navbar-logo-text" style="color: var(--gold);">HAREM</span>
                <span class="navbar-logo-sub" style="color: var(--white); opacity: 0.6;">B O D R U M</span>
            </div>
        </a>
        <button class="mobile-menu-close" id="mobileMenuClose" aria-label="Kapat">×</button>
    </div>
    
    <div class="mobile-menu-content">
        <ul class="mobile-nav-links">
            <li style="--i:1;"><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">{{ __('Anasayfa') }}</a></li>
            <li style="--i:2;"><a href="{{ route('menu') }}" class="{{ request()->routeIs('menu') ? 'active' : '' }}">{{ __('Menü') }}</a></li>
            <li style="--i:3;"><a href="{{ route('hakkimizda') }}" class="{{ request()->routeIs('hakkimizda') ? 'active' : '' }}">{{ __('Hakkımızda') }}</a></li>
            <li style="--i:4;"><a href="{{ route('galeri') }}" class="{{ request()->routeIs('galeri') ? 'active' : '' }}">{{ __('Galeri') }}</a></li>
            <li style="--i:5;"><a href="{{ route('iletisim') }}" class="{{ request()->routeIs('iletisim') ? 'active' : '' }}">{{ __('İletişim') }}</a></li>
            <li style="--i:6; margin-top: 1.5rem;">
                <div class="mobile-lang-grid">
                    @php
                        $locales = ['tr' => 'TR', 'en' => 'EN', 'es' => 'ES', 'ar' => 'AR', 'ru' => 'RU'];
                        $currentLocale = app()->getLocale();
                    @endphp
                    @foreach($locales as $code => $name)
                        <a href="{{ route('lang.switch', $code) }}" class="{{ $currentLocale == $code ? 'active' : '' }}" style="color: var(--white);">
                            {{ $name }}
                        </a>
                    @endforeach
                </div>
            </li>
        </ul>

        <div class="mobile-menu-footer">
            <a href="{{ route('rezervasyon') }}" class="btn btn-primary btn-lg" style="width: 100%; justify-content: center; margin-bottom: 2rem;">🗓 {{ __('Masa Rezervasyonu') }}</a>
            
            <div class="mobile-menu-info">
                <div class="info-item">
                    <span class="icon">📍</span>
                    <span>Çarşı Mahallesi Neyzen Tevfik Cad. No: 14, Bodrum</span>
                </div>
                <div class="info-item">
                    <span class="icon">📞</span>
                    <div style="display:flex; flex-direction:column; gap:0.25rem;">
                        <a href="tel:02523136895">Tel: 0252 313 68 95</a>
                        <a href="tel:+905435008226">GSM: +90 543 500 82 26</a>
                    </div>
                </div>
            </div>
            
            <div class="mobile-socials">
                <a href="#">📘</a>
                <a href="#">📸</a>
                <a href="#">🐦</a>
            </div>
        </div>
    </div>
</div>

{{-- ── Page Content ────────────────────────────────────────────────────── --}}
@yield('content')

{{-- ── Footer ──────────────────────────────────────────────────────────── --}}
<footer class="footer">
    <div class="container">
        <div class="footer-grid">
            <div>
                <div class="footer-brand-name">Harem</div>
                <p class="footer-desc">{{ __('Bodrum\'un büyüleyici manzarası eşliğinde geleneksel Ege lezzetlerini modern bir yorumla sunuyoruz. Her tabak bir hikaye, her an bir anı.') }}</p>
                <div style="display:flex; gap:1rem;">
                    <a href="#" style="color:var(--gold); font-size:1.2rem;">📘</a>
                    <a href="#" style="color:var(--gold); font-size:1.2rem;">📸</a>
                    <a href="#" style="color:var(--gold); font-size:1.2rem;">🐦</a>
                </div>
            </div>

            <div>
                <div class="footer-heading">{{ __('Sayfalar') }}</div>
                <ul class="footer-links">
                    <li><a href="{{ route('home') }}">{{ __('Anasayfa') }}</a></li>
                    <li><a href="{{ route('menu') }}">{{ __('Menü') }}</a></li>
                    <li><a href="{{ route('hakkimizda') }}">{{ __('Hakkımızda') }}</a></li>
                    <li><a href="{{ route('galeri') }}">{{ __('Galeri') }}</a></li>
                    <li><a href="{{ route('rezervasyon') }}">{{ __('Rezervasyon') }}</a></li>
                    <li><a href="{{ route('iletisim') }}">{{ __('İletişim') }}</a></li>
                </ul>
            </div>

            <div>
                <div class="footer-heading">{{ __('İletişim') }}</div>
                <div class="footer-contact-item">
                    <span class="icon">📍</span>
                    <span>{{ __('Çarşı Mahallesi Neyzen Tevfik Cad. No: 14, Bodrum') }}</span>
                </div>
                <div class="footer-contact-item">
                    <span class="icon">📞</span>
                    <div style="display:flex; flex-direction:column; gap:0.25rem;">
                        <a href="tel:02523136895" style="color:rgba(255,255,255,0.55);">Tel: 0252 313 68 95</a>
                        <a href="tel:+905435008226" style="color:rgba(255,255,255,0.55);">GSM: +90 543 500 82 26</a>
                    </div>
                </div>
                <div class="footer-contact-item">
                    <span class="icon">✉️</span>
                    <a href="mailto:ozanolucu@gmail.com" style="color:rgba(255,255,255,0.55);">ozanolucu@gmail.com</a>
                </div>
                <div style="margin-top:1.5rem;">
                    <a href="{{ route('rezervasyon') }}" class="btn btn-primary btn-sm">{{ __('Masa Rezervasyonu') }}</a>
                </div>
            </div>
        </div>

        <hr class="footer-divider">

        <div class="footer-bottom">
            <span>© {{ date('Y') }} Harem Restaurant. {{ __('Tüm hakları saklıdır.') }}</span>
            <span>{{ __('Bodrum, Muğla — Türkiye') }} 🇹🇷</span>
        </div>
    </div>
</footer>

<script>
// Navbar scroll effect
const navbar = document.getElementById('navbar');
window.addEventListener('scroll', () => {
    if (window.scrollY > 40) navbar.classList.add('scrolled');
    else navbar.classList.remove('scrolled');
}, { passive: true });

// Mobile Premium Menu interactions
const hamburger = document.getElementById('hamburger');
const mobileMenuOverlay = document.getElementById('mobileMenuOverlay');
const mobileMenuClose = document.getElementById('mobileMenuClose');

hamburger?.addEventListener('click', () => {
    mobileMenuOverlay?.classList.add('open');
    document.body.style.overflow = 'hidden';
});

mobileMenuClose?.addEventListener('click', () => {
    mobileMenuOverlay?.classList.remove('open');
    document.body.style.overflow = '';
});

// Close menu on backdrop click
mobileMenuOverlay?.addEventListener('click', (e) => {
    if (e.target === mobileMenuOverlay) {
        mobileMenuOverlay.classList.remove('open');
        document.body.style.overflow = '';
    }
});

// Intersection observer for fade animations
const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry, i) => {
        if (entry.isIntersecting) {
            setTimeout(() => entry.target.classList.add('visible'), i * 80);
        }
    });
}, { threshold: 0.1, rootMargin: '0px 0px -40px 0px' });

document.querySelectorAll('.fade-up').forEach(el => observer.observe(el));
</script>

@yield('scripts')
</body>
</html>
