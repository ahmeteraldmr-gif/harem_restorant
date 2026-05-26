@extends('layouts.app')

@section('title', 'Menümüz')
@section('meta_description', 'Harem Restaurant\'ın zengin menüsü — Başlangıçlar, Deniz Ürünleri, Ana Yemekler, Tatlılar ve İçecekler.')

@section('content')

<section class="page-hero">
    <span class="page-hero-sub">Harem Restaurant</span>
    <h1 class="page-hero-title">{{ __('Lezzetli') }} <em>{{ __('Menümüz') }}</em></h1>
    <p class="page-hero-desc">{{ __('Ege\'nin en taze ürünleri ile hazırlanan, geleneksel ve modern lezzetlerin buluştuğu menümüzü keşfedin') }}</p>
</section>

<section class="menu-page">
    <div class="menu-container">

        {{-- Kategori Sekme Listesi (Sol Sidebar) --}}
        <div class="menu-sidebar">
            <div class="menu-sidebar-inner">
                <p class="menu-sidebar-label">{{ __('Kategoriler') }}</p>
                <nav class="menu-cat-nav">
                    @foreach($categories as $i => $cat)
                    <button
                        class="menu-cat-btn {{ $i === 0 ? 'active' : '' }}"
                        data-target="cat-{{ $cat->slug }}"
                        id="btn-{{ $cat->slug }}"
                    >
                        <span class="menu-cat-btn-icon">{{ $cat->icon }}</span>
                        <span class="menu-cat-btn-name">{{ $cat->translated_name }}</span>
                        <span class="menu-cat-btn-count">{{ $cat->items->count() }}</span>
                    </button>
                    @endforeach
                </nav>
            </div>
        </div>

        {{-- Menü İçeriği (Sağ Panel) --}}
        <div class="menu-content-area">
            @foreach($categories as $i => $category)
            <div class="menu-cat-panel {{ $i === 0 ? 'active' : '' }}" id="cat-{{ $category->slug }}">

                <div class="menu-cat-panel-header">
                    <div class="menu-cat-panel-icon">{{ $category->icon }}</div>
                    <div>
                        <h2 class="menu-cat-panel-title">{{ $category->translated_name }}</h2>
                        <p class="menu-cat-panel-sub">{{ $category->items->count() }} {{ __('çeşit lezzet') }}</p>
                    </div>
                </div>

                <div class="menu-items-list">
                    @foreach($category->items as $item)
                    <div class="menu-item-row">
                        <div class="menu-item-row-img">
                            @if($item->image && file_exists(public_path('images/'.$item->image)))
                                <img src="{{ asset('images/{{ $item->image }}') }}" alt="{{ $item->name }}">
                            @else
                                <div class="menu-item-row-placeholder">{{ $category->icon }}</div>
                            @endif
                        </div>
                        <div class="menu-item-row-body">
                            <div class="menu-item-row-top">
                                <h3 class="menu-item-row-name">
                                    {{ $item->translated_name }}
                                    @if($item->featured)
                                        <span class="menu-badge">✦ {{ __('Öne Çıkan') }}</span>
                                    @endif
                                </h3>
                            </div>
                            @if($item->description)
                                <p class="menu-item-row-desc">{{ $item->translated_description }}</p>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>

            </div>
            @endforeach
        </div>

    </div>
</section>

<section class="cta-banner">
    <div class="container">
        <div class="cta-inner">
            <h2 style="color:var(--white);">{{ __('Beğendiğiniz') }} <em>{{ __('Lezzetleri') }}</em> {{ __('Rezerve Edin') }}</h2>
            <p>{{ __('Hemen bir masa ayırtın, şefimiz sizi bekliyor.') }}</p>
            <a href="{{ route('rezervasyon') }}" class="btn btn-primary btn-lg">{{ __('Rezervasyon Yap') }}</a>
        </div>
    </div>
</section>

@endsection

@section('scripts')
<script>
const catBtns = document.querySelectorAll('.menu-cat-btn');
const catPanels = document.querySelectorAll('.menu-cat-panel');

catBtns.forEach(btn => {
    btn.addEventListener('click', () => {
        catBtns.forEach(b => b.classList.remove('active'));
        catPanels.forEach(p => p.classList.remove('active'));
        btn.classList.add('active');
        const target = document.getElementById(btn.dataset.target);
        if (target) target.classList.add('active');
        // Scroll to top of content on mobile
        if (window.innerWidth < 768) {
            document.querySelector('.menu-content-area')?.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
    });
});
</script>
@endsection
