@extends('layouts.app')

@section('title', 'Ana Sayfa')
@section('meta_description', 'Bodrum\'un kalbinde Harem Restaurant — Ege\'nin lezzetleri, Bodrum\'un büyüsü. Deniz manzaralı terasımızda rezervasyon yapın.')

@section('content')

{{-- ── Hero ─────────────────────────────────────────────────────────────────── --}}
<section class="hero">
    <div class="hero-bg"></div>
    <div class="hero-overlay"></div>

    <div class="container">
        <div class="hero-content">
            <div class="hero-eyebrow">
                <div class="hero-eyebrow-line"></div>
                <span class="hero-eyebrow-text">Bodrum, Muğla — Est. 2008</span>
            </div>

            <h1 class="hero-title">
                {{ __('Ege\'nin') }} <em>{{ __('Ruhu') }}</em>,<br>
                {{ __('Bir Tabakta') }}
            </h1>

            <p class="hero-desc">
                {{ __('Bodrum\'un masmavi denizine karşı, geleneksel Ege lezzetlerini modern bir yorumla sunuyoruz. Her malzeme özenle seçilmiş, her tarif sevgiyle hazırlanmış.') }}
            </p>

            <div class="hero-actions">
                <a href="{{ route('rezervasyon') }}" class="btn btn-primary btn-lg">
                    🗓 {{ __('Rezervasyon Yap') }}
                </a>
                <a href="{{ route('menu') }}" class="btn btn-outline btn-lg">
                    {{ __('Menüyü İncele') }}
                </a>
            </div>
        </div>
    </div>

    <div class="hero-scroll">
        <span>Keşfet</span>
        <div class="hero-scroll-line"></div>
    </div>
</section>

{{-- ── Stats ────────────────────────────────────────────────────────────────── --}}
<section class="stats-bar">
    <div class="container">
        <div class="stats-grid" style="max-width: 900px; margin: 0 auto;">
            <div class="stat-item">
                <span class="stat-number">2008</span>
                <span class="stat-label">{{ __('Kuruluş') }}</span>
            </div>
            <div class="stat-item">
                <span class="stat-number">12</span>
                <span class="stat-label">{{ __('Şef') }}</span>
            </div>
            <div class="stat-item">
                <span class="stat-number">4.9</span>
                <span class="stat-label">{{ __('Puan') }}</span>
            </div>
        </div>
    </div>
</section>

{{-- ── About Preview ────────────────────────────────────────────────────────── --}}
<section class="section about-preview">
    <div class="container">
        <div class="about-preview-grid">
            <div class="about-image-frame fade-up">
                <img src="{{ asset('images/interior.png') }}" alt="Harem Restaurant İç Mekan" class="about-image-main">
                <div class="about-image-badge">
                    <span class="num">2008</span>
                    <span class="lbl">Bodrum'da</span>
                </div>
            </div>

            <div class="about-text">
                <span class="section-label fade-up">{{ __('Hikayemiz') }}</span>
                <h2 class="section-title fade-up">{{ __('Ege\'nin Kalbinde') }} <em style="color:var(--gold);">{{ __('Bir Cennet') }}</em></h2>
                <div class="divider-gold fade-up"></div>
                <p class="fade-up" style="line-height: 1.8; font-size: 1.1rem; color: var(--text-dark);">
                    {{ __('Bodrum kıyısında, derin mavinin altın ışıkla buluştuğu o eşsiz anda doğan Harem, misafirlerine yalnızca bir yemek değil — unutulmaz bir deneyim sunar. Taze Ege ürünleri, ustalıkla hazırlanmış tatlar ve Bodrum\'un nefes kesen manzarası.') }}
                </p>
                <p class="fade-up" style="line-height: 1.8; font-size: 1.1rem; color: var(--text-dark); margin-top: 1rem;">
                    {{ __('Her tabak, Akdeniz\'in zenginliğini ve Türk mutfağının köklü geleneğini taşır. Şef ekibimiz, her akşam yalnızca o güne özgü mönüyle sofranıza gelir.') }}
                </p>

                <div class="features-grid fade-up" style="margin-top:2rem;">
                    <div class="feature-card">
                        <span class="feature-icon">🌿</span>
                        <div>
                            <h4>{{ __('Taze & Yerel') }}</h4>
                            <p>{{ __('Günlük tedarik edilen yerel ürünler') }}</p>
                        </div>
                    </div>
                    <div class="feature-card">
                        <span class="feature-icon">🦞</span>
                        <div>
                            <h4>{{ __('Deniz Ürünleri') }}</h4>
                            <p>{{ __('Bodrum körfezinden taze balık') }}</p>
                        </div>
                    </div>
                    <div class="feature-card">
                        <span class="feature-icon">🍷</span>
                        <div>
                            <h4>{{ __('Seçkin Şaraplar') }}</h4>
                            <p>{{ __('Ege bölgesi yerli şarap koleksiyonu') }}</p>
                        </div>
                    </div>
                </div>

                <div class="fade-up" style="margin-top:2rem;">
                    <a href="{{ route('hakkimizda') }}" class="btn btn-outline-gold">
                        {{ __('Hikayemizi Okuyun') }} →
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ── Gallery Preview ──────────────────────────────────────────────────────── --}}
<section class="section gallery-section">
    <div class="container">
        <div style="text-align:center; margin-bottom:3rem;">
            <span class="section-label fade-up">{{ __('Atmosfer') }}</span>
            <h2 class="section-title fade-up">{{ __('Harem\'de') }} <em>{{ __('Bir An') }}</em></h2>
        </div>

        <div class="gallery-grid">
            @if($galleryImages->count() > 0)
                @foreach($galleryImages->take(5) as $index => $img)
                <div class="gallery-item {{ $index === 0 ? 'wide' : '' }} fade-up">
                    <img src="{{ asset('images/{{ $img->image }}') }}" alt="{{ __($img->title ?? 'Harem Restaurant') }}">
                    <div class="gallery-overlay">
                        <span class="gallery-overlay-text">{{ __($img->title ?? 'Harem Restaurant') }}</span>
                    </div>
                </div>
                @endforeach
            @else
                <div class="gallery-item wide fade-up">
                    <img src="{{ asset('images/gallery-terrace.png') }}" alt="{{ __('Deniz Manzaralı Teras') }}">
                    <div class="gallery-overlay"><span class="gallery-overlay-text">{{ __('Deniz Manzaralı Teras') }}</span></div>
                </div>
                <div class="gallery-item fade-up">
                    <img src="{{ asset('images/interior.png') }}" alt="{{ __('Zarif İç Mekan') }}">
                    <div class="gallery-overlay"><span class="gallery-overlay-text">{{ __('Zarif İç Mekan') }}</span></div>
                </div>
                <div class="gallery-item fade-up">
                    <img src="{{ asset('images/hero.png') }}" alt="{{ __('Restoran') }}">
                    <div class="gallery-overlay"><span class="gallery-overlay-text">{{ __('Bodrum\'da Bir Akşam') }}</span></div>
                </div>
                <div class="gallery-item fade-up">
                    <img src="{{ asset('images/gallery-terrace.png') }}" alt="{{ __('Açık Teras') }}">
                    <div class="gallery-overlay"><span class="gallery-overlay-text">{{ __('Açık Teras') }}</span></div>
                </div>
            @endif
        </div>

        <div style="text-align:center; margin-top:2.5rem;" class="fade-up">
            <a href="{{ route('galeri') }}" class="btn btn-outline-gold">{{ __('Tüm Galeriyi Gör') }}</a>
        </div>
    </div>
</section>

{{-- ── CTA Banner ───────────────────────────────────────────────────────────── --}}
<section class="cta-banner">
    <div class="container">
        <div class="cta-inner">
            <span class="section-label">{{ __('Masanızı Ayırtın') }}</span>
            <h2 class="section-title" style="color:var(--white);">{{ __('Unutulmaz Bir') }} <em>{{ __('Akşam') }}</em> {{ __('Sizi Bekliyor') }}</h2>
            <p>{{ __('Bodrum\'un eşsiz manzarası eşliğinde, sevdiklerinizle özel bir deneyim için rezervasyonunuzu şimdiden yapın.') }}</p>
            <a href="{{ route('rezervasyon') }}" class="btn btn-primary btn-lg">{{ __('Hemen Rezervasyon Yap') }}</a>
        </div>
    </div>
</section>

@endsection
