@extends('layouts.app')

@section('title', __('Rezervasyon'))
@section('meta_description', __('Harem Restaurant\'ta masa rezervasyonu yapın — Bodrum\'un en güzel deneyimi için.'))

@section('content')

<section class="page-hero">
    <span class="page-hero-sub">{{ __('Masanızı Ayırtın') }}</span>
    <h1 class="page-hero-title">{{ __('Rezervasyon') }}</h1>
    <p class="page-hero-desc">{{ __('En az 24 saat öncesinden rezervasyon yapmanızı öneririz') }}</p>
</section>

<section class="reservation-section">
    <div class="container">
        <div class="reservation-grid">

            {{-- Sol: Bilgi --}}
            <div>
                <span class="section-label">{{ __('Bize Ulaşın') }}</span>
                <h3 style="font-family:var(--font-serif); font-size:1.8rem; margin-bottom:1.5rem; color:var(--navy);">{{ __('Sizi Ağırlamaktan') }} <em style="color:var(--gold);">{{ __('Mutluluk Duyarız') }}</em></h3>

                <div class="contact-card fade-up">
                    <div class="contact-card-icon">📞</div>
                    <div>
                        <div class="contact-card-title">{{ __('Telefon ile Rezervasyon') }}</div>
                        <div class="contact-card-value">
                            <a href="tel:02523136895" style="display:block; font-weight:600;">Tel: 0252 313 68 95</a>
                            <a href="tel:+905435008226" style="display:block; margin-top:0.2rem; font-weight:600;">GSM: +90 543 500 82 26</a>
                        </div>
                    </div>
                </div>

                <div class="contact-card fade-up">
                    <div class="contact-card-icon">📍</div>
                    <div>
                        <div class="contact-card-title">{{ __('Adresimiz') }}</div>
                        <div class="contact-card-value">Çarşı Mahallesi Neyzen Tevfik Cad. No: 14, Bodrum</div>
                    </div>
                </div>

                <div class="fade-up" style="background:linear-gradient(135deg, rgba(201,169,110,0.12), rgba(201,169,110,0.04)); border:1px solid var(--border); border-radius:var(--radius-md); padding:1.5rem; margin-top:1rem;">
                    <p style="font-size:0.875rem; color:var(--text-muted); line-height:1.7; margin:0;">
                        💡 <strong style="color:var(--navy);">{{ __('Önemli Bilgi:') }}</strong> {{ __('10 kişi ve üzeri gruplar için lütfen en az 48 saat öncesinden arayın. Özel etkinlikler ve doğum günleri için özel düzenleme yapabiliriz.') }}
                    </p>
                </div>
            </div>

            {{-- Sağ: Form --}}
            <div class="fade-up">
                @if(session('success'))
                    <div class="alert alert-success">
                        ✅ {{ session('success') }}
                    </div>
                @endif

                <div class="form-card">
                    <div style="margin-bottom:2rem;">
                        <span class="section-label">{{ __('Online Rezervasyon') }}</span>
                        <h3 style="font-family:var(--font-serif); font-size:1.5rem; color:var(--navy);">{{ __('Masa Rezervasyonu Formu') }}</h3>
                    </div>

                    <form action="{{ route('rezervasyon.store') }}" method="POST" id="reservationForm">
                        @csrf

                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label" for="res_name">{{ __('Ad Soyad') }} *</label>
                                <input type="text" id="res_name" name="name" class="form-control @error('name') is-invalid @enderror"
                                       placeholder="{{ __('Adınız') }}" value="{{ old('name') }}" required>
                                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="res_phone">{{ __('Telefon') }} *</label>
                                <input type="tel" id="res_phone" name="phone" class="form-control @error('phone') is-invalid @enderror"
                                       placeholder="0532 000 00 00" value="{{ old('phone') }}" required>
                                @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="res_email">{{ __('E-posta') }}</label>
                            <input type="email" id="res_email" name="email" class="form-control @error('email') is-invalid @enderror"
                                   placeholder="ornek@mail.com" value="{{ old('email') }}">
                            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label class="form-label" for="res_date">{{ __('Tarih') }} *</label>
                                <input type="date" id="res_date" name="date" class="form-control @error('date') is-invalid @enderror"
                                       min="{{ date('Y-m-d') }}" value="{{ old('date') }}" required>
                                @error('date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="res_time">{{ __('Saat') }} *</label>
                                <select id="res_time" name="time" class="form-control @error('time') is-invalid @enderror" required>
                                    <option value="">{{ __('Saat seçin') }}</option>
                                    @foreach(['12:00','12:30','13:00','13:30','14:00','14:30','19:00','19:30','20:00','20:30','21:00','21:30','22:00','22:30'] as $t)
                                        <option value="{{ $t }}" {{ old('time') == $t ? 'selected' : '' }}>{{ $t }}</option>
                                    @endforeach
                                </select>
                                @error('time')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="res_guests">{{ __('Kişi Sayısı') }} *</label>
                            <select id="res_guests" name="guests" class="form-control @error('guests') is-invalid @enderror" required>
                                <option value="">{{ __('Kişi sayısı seçin') }}</option>
                                @for($i = 1; $i <= 20; $i++)
                                    <option value="{{ $i }}" {{ old('guests') == $i ? 'selected' : '' }}>{{ $i }} {{ __('Kişi') }}</option>
                                @endfor
                            </select>
                            @error('guests')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="res_notes">{{ __('Özel İstek / Not') }}</label>
                            <textarea id="res_notes" name="notes" class="form-control @error('notes') is-invalid @enderror"
                                      rows="3" placeholder="{{ __('Özel gün, diyet tercihi, masa konumu vb.') }}">{{ old('notes') }}</textarea>
                            @error('notes')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <button type="submit" class="btn btn-primary btn-lg" style="width:100%; justify-content:center;">
                            🗓 {{ __('Rezervasyonu Tamamla') }}
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection
