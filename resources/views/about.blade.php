@extends('layouts.app')

@section('title', __('Hakkımızda'))
@section('meta_description', __('Harem Restaurant hakkında — 2008\'den bu yana Bodrum\'un en iyi Ege mutfağı deneyimi.'))

@section('content')

<section class="page-hero">
    <span class="page-hero-sub">{{ __('Hikayemiz') }}</span>
    <h1 class="page-hero-title">{{ __('Hakkımızda') }}</h1>
    <p class="page-hero-desc">{{ __('2008\'den bu yana Bodrum\'da eşsiz Ege lezzetleri sunuyoruz') }}</p>
</section>

{{-- ── Story Section ────────────────────────────────────────────────────────── --}}
<section class="section about-page" style="padding-top:5rem;">
    <div class="container">
        <div class="about-preview-grid">
            <div class="about-text">
                <span class="section-label fade-up">{{ __('Hikayemiz') }}</span>
                <h2 class="section-title fade-up">{{ __('Ege\'nin Kalbinde') }} <em>{{ __('Bir Cennet') }}</em></h2>
                <div class="divider-gold fade-up"></div>
                <p class="fade-up" style="line-height: 1.8; font-size: 1.1rem; color: var(--text-dark);">
                    {{ __('Bodrum kıyısında, derin mavinin altın ışıkla buluştuğu o eşsiz anda doğan Harem, misafirlerine yalnızca bir yemek değil — unutulmaz bir deneyim sunar. Taze Ege ürünleri, ustalıkla hazırlanmış tatlar ve Bodrum\'un nefes kesen manzarası.') }}
                </p>
                <p class="fade-up" style="line-height: 1.8; font-size: 1.1rem; color: var(--text-dark); margin-top: 1rem;">
                    {{ __('Her tabak, Akdeniz\'in zenginliğini ve Türk mutfağının köklü geleneğini taşır. Şef ekibimiz, her akşam yalnızca o güne özgü mönüyle sofranıza gelir.') }}
                </p>
            </div>
            <div class="about-image-frame fade-up">
                <img src="{{ asset('images/interior.png') }}" alt="{{ __('Harem Restaurant İç Mekan') }}" class="about-image-main">
                <div class="about-image-badge">
                    <span class="num">★4.9</span>
                    <span class="lbl">{{ __('Google Puanı') }}</span>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ── Values ───────────────────────────────────────────────────────────────── --}}
<section class="values-section">
    <div class="container">
        <div style="text-align:center; margin-bottom:1rem;">
            <span class="section-label fade-up">{{ __('Değerlerimiz') }}</span>
            <h2 class="section-title fade-up">{{ __('Bizi') }} <em>{{ __('Biz') }}</em> {{ __('Yapan') }}</h2>
        </div>
        <div class="values-grid">
            <div class="value-card fade-up">
                <span class="value-icon">🌿</span>
                <h3>{{ __('Taze & Yerel') }}</h3>
                <p>{{ __('Tüm malzemelerimiz Muğla ve çevre illerden, güvenilir üreticilerden günlük olarak temin edilir. Donmuş ürün kullanmıyoruz.') }}</p>
            </div>
            <div class="value-card fade-up">
                <span class="value-icon">👨‍🍳</span>
                <h3>{{ __('Zanaatkarlık') }}</h3>
                <p>{{ __('Her tarif, yıllar içinde mükemmelleştirilmiş bir zanaatın ürünüdür. Hazır sos ve kısayol kullanmıyoruz — sadece el emeği, göz nuru.') }}</p>
            </div>
            <div class="value-card fade-up">
                <span class="value-icon">💙</span>
                <h3>{{ __('Misafirperverlik') }}</h3>
                <p>{{ __('Türk misafirperverliğinin en güzel halini yaşatıyoruz. Restoranımıza giren herkes ailemizin bir parçası olur.') }}</p>
            </div>
            <div class="value-card fade-up">
                <span class="value-icon">🌊</span>
                <h3>{{ __('Sürdürülebilirlik') }}</h3>
                <p>{{ __('Ege\'nin doğasını korumak için sorumlu balıkçılık destekçisiyiz. Aşırı avlanmış türlere menümüzde yer vermiyoruz.') }}</p>
            </div>
            <div class="value-card fade-up">
                <span class="value-icon">🏆</span>
                <h3>{{ __('Kalite') }}</h3>
                <p>{{ __('Detaylara verdiğimiz özen, servisimizden sunuma, ambiyansımızdan menümüze kadar her şeyde hissedilir.') }}</p>
            </div>
            <div class="value-card fade-up">
                <span class="value-icon">🎭</span>
                <h3>{{ __('Deneyim') }}</h3>
                <p>{{ __('Sadece yemek sunmuyoruz — bir hikaye, bir anı, bir Bodrum gecesi sunuyoruz. Her ziyaretiniz farklı olacak.') }}</p>
            </div>
        </div>
    </div>
</section>

<section class="cta-banner">
    <div class="container">
        <div class="cta-inner">
            <h2 style="color:var(--white);">{{ __('Bizi') }} <em>{{ __('Ziyaret Edin') }}</em></h2>
            <p>{{ __('Harem deneyimini yaşamak için masanızı ayırtın.') }}</p>
            <a href="{{ route('rezervasyon') }}" class="btn btn-primary btn-lg">{{ __('Rezervasyon Yap') }}</a>
        </div>
    </div>
</section>

@endsection
