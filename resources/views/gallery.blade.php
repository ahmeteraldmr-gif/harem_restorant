@extends('layouts.app')

@section('title', __('Galeri'))
@section('meta_description', __('Harem Restaurant galeri — Bodrum\'un güzelliği ve restoranımızdan kareler.'))

@section('content')

<section class="page-hero">
    <span class="page-hero-sub">{{ __('Gözlerinize Güzel') }}</span>
    <h1 class="page-hero-title">{{ __('Fotoğraf') }} <em>{{ __('Galerisi') }}</em></h1>
    <p class="page-hero-desc">{{ __('Restoranımızdan ve Bodrum\'un büyüleyici atmosferinden kareler') }}</p>
</section>

{{-- ── Video Bölümü ── --}}
<section class="gallery-video-section">
    <div class="container">
        <div style="text-align:center; margin-bottom:3rem;">
            <span class="section-label">{{ __('Atmosfer') }}</span>
            <h2 class="section-title">{{ __('Harem\'i') }} <em>{{ __('Hissedin') }}</em></h2>
            <p style="color:var(--text-muted); margin-top:0.75rem; font-size:1.05rem;">{{ __('Restoranımızın ambiyansını videolarla keşfedin') }}</p>
        </div>

        <div class="video-grid">
            <div class="video-card">
                <video
                    class="gallery-video"
                    controls
                    preload="metadata"
                    poster="/images/ambiance-1.png"
                >
                    <source src="/videos/ambiyans1.mp4" type="video/mp4">
                    {{ __('Tarayıcınız video desteklemiyor.') }}
                </video>
                <div class="video-card-label">
                    <span class="video-icon">▶</span>
                    <span>{{ __('Harem Ambiyansı') }}</span>
                </div>
            </div>

            <div class="video-card">
                <video
                    class="gallery-video"
                    controls
                    preload="metadata"
                    poster="/images/ambiance-2.png"
                >
                    <source src="/videos/ambiyans2.mp4" type="video/mp4">
                    {{ __('Tarayıcınız video desteklemiyor.') }}
                </video>
                <div class="video-card-label">
                    <span class="video-icon">▶</span>
                    <span>{{ __('Bodrum\'da Bir Akşam') }}</span>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ── Fotoğraf Galerisi ── --}}
<section class="section gallery-section" style="padding-top:2rem;">
    <div class="container">
        <div style="text-align:center; margin-bottom:3rem;">
            <span class="section-label">{{ __('Mekanımız') }}</span>
            <h2 class="section-title">{{ __('Restoran') }} <em>{{ __('Fotoğrafları') }}</em></h2>
        </div>

        <div class="gallery-grid" id="galleryGrid">
            @php
                $atmosferFotolar = [
                    ['img' => 'ambiance-2.png',  'title' => __('Zarif İç Mekan')],
                    ['img' => 'ambiance-3.png',  'title' => __('Bodrum Gecesi')],
                    ['img' => 'ambiance-4.png',  'title' => __('Restoran Bahçesi')],
                    ['img' => 'ambiance-5.jpg',  'title' => __('Teras Görünümü')],
                    ['img' => 'ambiance-6.png',  'title' => __('Akşam Işıkları')],
                    ['img' => 'ambiance-7.jpeg', 'title' => __('Özel Köşemiz')],
                    ['img' => 'ambiance-8.jpeg', 'title' => __('Deniz Manzarası')],
                    ['img' => 'gallery-terrace.png', 'title' => __('Deniz Manzaralı Teras')],
                    ['img' => 'interior.png',    'title' => __('Zarif İç Mekan')],
                ];
            @endphp

            @if($images->count() > 0)
                @foreach($images as $index => $img)
                <div class="gallery-item {{ $index % 5 === 0 ? 'wide' : '' }} fade-up">
                    <img src="/images/{{ $img->image }}" alt="{{ __($img->title ?? 'Harem Restaurant') }}" loading="lazy">
                    <div class="gallery-overlay">
                        <span class="gallery-overlay-text">{{ __($img->title ?? 'Harem Restaurant') }}</span>
                    </div>
                </div>
                @endforeach
            @else
                @foreach($atmosferFotolar as $index => $foto)
                @php
                    $filePath = public_path('images/' . $foto['img']);
                @endphp
                @if(file_exists($filePath))
                <div class="gallery-item {{ $index === 0 ? 'wide' : '' }} fade-up">
                    <img src="/images/{{ $foto['img'] }}" alt="{{ $foto['title'] }}" loading="lazy">
                    <div class="gallery-overlay">
                        <span class="gallery-overlay-text">{{ $foto['title'] }}</span>
                    </div>
                </div>
                @endif
                @endforeach
            @endif
        </div>
    </div>
</section>

<section class="cta-banner">
    <div class="container">
        <div class="cta-inner">
            <h2 style="color:var(--white);">{{ __('Bu Atmosferi') }} <em>{{ __('Yaşayın') }}</em></h2>
            <p>{{ __('Bodrum\'un eşsiz güzelliğinde bir masa rezervasyonu yapın.') }}</p>
            <a href="{{ route('rezervasyon') }}" class="btn btn-primary btn-lg">{{ __('Rezervasyon Yap') }}</a>
        </div>
    </div>
</section>

@endsection
