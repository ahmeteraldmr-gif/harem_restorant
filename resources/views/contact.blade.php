@extends('layouts.app')

@section('title', __('İletişim'))
@section('meta_description', __('Harem Restaurant iletişim bilgileri — Bodrum\'da bize ulaşın, yol tarifi alın.'))

@section('content')

<section class="page-hero">
    <span class="page-hero-sub">{{ __('Bize Ulaşın') }}</span>
    <h1 class="page-hero-title">{{ __('İletişim') }}</h1>
    <p class="page-hero-desc">{{ __('Her türlü soru, öneri ve geri bildirim için buradayız') }}</p>
</section>

<section class="contact-section">
    <div class="container">
        <div class="contact-grid">

            {{-- Sol: İletişim Bilgileri --}}
            <div>
                <span class="section-label fade-up">{{ __('Bize Ulaşın') }}</span>
                <h2 class="section-title fade-up" style="font-size:2rem; margin-bottom:2rem;">{{ __('Hep Yanınızda') }} <em>{{ __('Olacağız') }}</em></h2>

                <div class="contact-card fade-up">
                    <div class="contact-card-icon">👤</div>
                    <div>
                        <div class="contact-card-title">{{ __('Yetkili') }}</div>
                        <div class="contact-card-value" style="color:var(--navy); font-weight:600;">Ozan ERDAL</div>
                    </div>
                </div>

                <div class="contact-card fade-up">
                    <div class="contact-card-icon">📍</div>
                    <div>
                        <div class="contact-card-title">{{ __('Adres') }}</div>
                        <div class="contact-card-value">Çarşı Mahallesi Neyzen Tevfik Cad. No: 14</div>
                        <div style="font-size:0.85rem; color:var(--text-muted); margin-top:0.2rem;">Bodrum / Muğla</div>
                    </div>
                </div>

                <div class="contact-card fade-up">
                    <div class="contact-card-icon">📞</div>
                    <div>
                        <div class="contact-card-title">{{ __('Telefon / GSM') }}</div>
                        <div class="contact-card-value">
                            <a href="tel:02523136895" style="color:var(--navy); display:block; font-weight:600;">Tel: 0252 313 68 95</a>
                            <a href="tel:+905435008226" style="color:var(--navy); display:block; margin-top:0.2rem; font-weight:600;">GSM: +90 543 500 82 26</a>
                        </div>
                        <div style="font-size:0.85rem; color:var(--text-muted); margin-top:0.2rem;">{{ __('Her gün 10:00 — 23:00 arası') }}</div>
                    </div>
                </div>

                <div class="contact-card fade-up">
                    <div class="contact-card-icon">✉️</div>
                    <div>
                        <div class="contact-card-title">{{ __('E-posta') }}</div>
                        <div class="contact-card-value"><a href="mailto:ozanolucu@gmail.com" style="color:var(--navy); font-weight:600;">ozanolucu@gmail.com</a></div>
                        <div style="font-size:0.85rem; color:var(--text-muted); margin-top:0.2rem;">{{ __('24 saat içinde yanıt veririz') }}</div>
                    </div>
                </div>

                {{-- Harita --}}
                <div class="map-frame fade-up">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3218.9!2d27.4256!3d37.0350!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMzfCsDAyJzA2LjAiTiAyN8KwMjUnMzIuMiJF!5e0!3m2!1str!2str!4v1234567890"
                        width="100%" height="250" style="border:0; display:block;" allowfullscreen="" loading="lazy">
                    </iframe>
                </div>
            </div>

            {{-- Sağ: Form --}}
            <div class="fade-up">
                @if(session('success'))
                    <div class="alert alert-success">✅ {{ session('success') }}</div>
                @endif

                <div class="form-card">
                    <div style="margin-bottom:2rem;">
                        <span class="section-label">{{ __('Mesaj Gönderin') }}</span>
                        <h3 style="font-family:var(--font-serif); font-size:1.5rem; color:var(--navy);">{{ __('İletişim Formu') }}</h3>
                        <p style="font-size:0.875rem; color:var(--text-muted); margin-top:0.5rem;">{{ __('Sorularınız, önerileriniz veya özel etkinlik taleplerini bizimle paylaşabilirsiniz.') }}</p>
                    </div>

                    <form action="{{ route('iletisim.store') }}" method="POST">
                        @csrf

                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label" for="con_name">{{ __('Ad Soyad') }} *</label>
                                <input type="text" id="con_name" name="name" class="form-control @error('name') is-invalid @enderror"
                                       placeholder="{{ __('Adınız') }}" value="{{ old('name') }}" required>
                                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="con_email">{{ __('E-posta') }} *</label>
                                <input type="email" id="con_email" name="email" class="form-control @error('email') is-invalid @enderror"
                                       placeholder="ornek@mail.com" value="{{ old('email') }}" required>
                                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="con_subject">{{ __('Konu') }}</label>
                            <input type="text" id="con_subject" name="subject" class="form-control @error('subject') is-invalid @enderror"
                                   placeholder="{{ __('Mesajınızın konusu') }}" value="{{ old('subject') }}">
                            @error('subject')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="con_message">{{ __('Mesajınız') }} *</label>
                            <textarea id="con_message" name="message" class="form-control @error('message') is-invalid @enderror"
                                      rows="6" placeholder="{{ __('Mesajınızı buraya yazın...') }}" required>{{ old('message') }}</textarea>
                            @error('message')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <button type="submit" class="btn btn-primary btn-lg" style="width:100%; justify-content:center;">
                            ✉️ {{ __('Mesajı Gönder') }}
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection
