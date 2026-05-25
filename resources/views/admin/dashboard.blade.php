@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page_title', 'Dashboard')

@section('content')

{{-- Stat Widgets --}}
<div class="admin-stats-grid">
    <div class="stat-widget">
        <div class="stat-widget-icon" style="background:rgba(201,169,110,0.12);">🗓</div>
        <span class="stat-widget-number">{{ $stats['reservations_total'] }}</span>
        <span class="stat-widget-label">Toplam Rezervasyon</span>
    </div>
    <div class="stat-widget">
        <div class="stat-widget-icon" style="background:rgba(46,107,143,0.12);">📅</div>
        <span class="stat-widget-number">{{ $stats['reservations_today'] }}</span>
        <span class="stat-widget-label">Bugünkü Rezervasyon</span>
    </div>
    <div class="stat-widget">
        <div class="stat-widget-icon" style="background:rgba(254,243,199,0.5);">⏳</div>
        <span class="stat-widget-number">{{ $stats['reservations_pending'] }}</span>
        <span class="stat-widget-label">Bekleyen Onay</span>
    </div>
    <div class="stat-widget">
        <div class="stat-widget-icon" style="background:rgba(219,234,254,0.5);">✉️</div>
        <span class="stat-widget-number">{{ $stats['messages_unread'] }}</span>
        <span class="stat-widget-label">Okunmamış Mesaj</span>
    </div>
    <div class="stat-widget">
        <div class="stat-widget-icon" style="background:rgba(209,250,229,0.5);">🍽</div>
        <span class="stat-widget-number">{{ $stats['menu_items'] }}</span>
        <span class="stat-widget-label">Menü Ürünü</span>
    </div>
</div>

<style>
.dashboard-shortcut {
    transition: all 0.2s ease-in-out;
}
.dashboard-shortcut:hover {
    transform: translateY(-4px) scale(1.01);
    border-color: var(--gold) !important;
    box-shadow: 0 10px 20px rgba(201,169,110,0.12) !important;
}
</style>

{{-- Hızlı İşlemler --}}
<div class="admin-card" style="margin-bottom: 2rem; border-color: rgba(201,169,110,0.2);">
    <div class="admin-card-header" style="background: linear-gradient(135deg, rgba(201,169,110,0.06), transparent); border-bottom: 1px solid #F1F5F9;">
        <h3 class="admin-card-title" style="display:flex; align-items:center; gap:0.5rem; font-size:1.15rem;">⚡ Hızlı Yönetim Kısayolları</h3>
        <span style="font-size:0.78rem; color:#64748B;">Sitenizi kolayca yönetmek için aşağıdaki düğmeleri kullanabilirsiniz</span>
    </div>
    <div class="admin-card-body" style="padding: 1.5rem; background: #FFF;">
        <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 1.25rem;">
            <a href="{{ route('admin.menu.items') }}" class="dashboard-shortcut" style="text-decoration:none; display:flex; flex-direction:column; align-items:center; justify-content:center; text-align:center; padding:1.5rem; background:#FAFAFA; border:1px solid #E2E8F0; border-radius:12px; box-shadow:0 2px 4px rgba(0,0,0,0.01);">
                <span style="font-size:2.2rem; margin-bottom:0.6rem;">🍽️</span>
                <span style="font-weight:600; color:var(--navy); font-size:0.95rem; display:block; margin-bottom:0.25rem;">Ürünleri Yönet</span>
                <span style="font-size:0.75rem; color:#94A3B8; line-height:1.2;">Ürün ekle, düzenle veya kaldır</span>
            </a>
            
            <a href="{{ route('admin.menu.categories') }}" class="dashboard-shortcut" style="text-decoration:none; display:flex; flex-direction:column; align-items:center; justify-content:center; text-align:center; padding:1.5rem; background:#FAFAFA; border:1px solid #E2E8F0; border-radius:12px; box-shadow:0 2px 4px rgba(0,0,0,0.01);">
                <span style="font-size:2.2rem; margin-bottom:0.6rem;">📂</span>
                <span style="font-weight:600; color:var(--navy); font-size:0.95rem; display:block; margin-bottom:0.25rem;">Kategoriler</span>
                <span style="font-size:0.75rem; color:#94A3B8; line-height:1.2;">Menü kategorilerini yönet</span>
            </a>
            
            <a href="{{ route('admin.reservations') }}" class="dashboard-shortcut" style="text-decoration:none; display:flex; flex-direction:column; align-items:center; justify-content:center; text-align:center; padding:1.5rem; background:#FAFAFA; border:1px solid #E2E8F0; border-radius:12px; box-shadow:0 2px 4px rgba(0,0,0,0.01);">
                <span style="font-size:2.2rem; margin-bottom:0.6rem;">🗓️</span>
                <span style="font-weight:600; color:var(--navy); font-size:0.95rem; display:block; margin-bottom:0.25rem;">Rezervasyonlar</span>
                <span style="font-size:0.75rem; color:#94A3B8; line-height:1.2;">Masa ve müşteri rezervasyonları</span>
            </a>
            
            <a href="{{ route('admin.messages') }}" class="dashboard-shortcut" style="text-decoration:none; display:flex; flex-direction:column; align-items:center; justify-content:center; text-align:center; padding:1.5rem; background:#FAFAFA; border:1px solid #E2E8F0; border-radius:12px; box-shadow:0 2px 4px rgba(0,0,0,0.01);">
                <span style="font-size:2.2rem; margin-bottom:0.6rem;">✉️</span>
                <span style="font-weight:600; color:var(--navy); font-size:0.95rem; display:block; margin-bottom:0.25rem;">Gelen Mesajlar</span>
                <span style="font-size:0.75rem; color:#94A3B8; line-height:1.2;">İletişim formu mesajlarını oku</span>
            </a>
            
            <a href="{{ route('admin.gallery') }}" class="dashboard-shortcut" style="text-decoration:none; display:flex; flex-direction:column; align-items:center; justify-content:center; text-align:center; padding:1.5rem; background:#FAFAFA; border:1px solid #E2E8F0; border-radius:12px; box-shadow:0 2px 4px rgba(0,0,0,0.01);">
                <span style="font-size:2.2rem; margin-bottom:0.6rem;">🖼️</span>
                <span style="font-weight:600; color:var(--navy); font-size:0.95rem; display:block; margin-bottom:0.25rem;">Galeri Yönetimi</span>
                <span style="font-size:0.75rem; color:#94A3B8; line-height:1.2;">Fotoğraf albümünü düzenle</span>
            </a>
        </div>
    </div>
</div>

<div class="admin-tables-grid">

    {{-- Son Rezervasyonlar --}}
    <div class="admin-card">
        <div class="admin-card-header">
            <h3 class="admin-card-title">Son Rezervasyonlar</h3>
            <a href="{{ route('admin.reservations') }}" class="btn btn-sm btn-outline-gold">Tümünü Gör</a>
        </div>
        <div style="overflow:auto;">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Ad</th>
                        <th>Tarih</th>
                        <th>Kişi</th>
                        <th>Durum</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($latestReservations as $res)
                    <tr>
                        <td><strong>{{ $res->name }}</strong><br><small style="color:#94A3B8;">{{ $res->phone }}</small></td>
                        <td>{{ $res->date->format('d.m.Y') }}<br><small style="color:#94A3B8;">{{ $res->time }}</small></td>
                        <td>{{ $res->guests }} kişi</td>
                        <td>
                            <span class="badge badge-{{ $res->status }}">
                                {{ $res->status === 'pending' ? 'Bekliyor' : ($res->status === 'confirmed' ? 'Onaylandı' : 'İptal') }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="4" style="text-align:center; color:#94A3B8; padding:2rem;">Henüz rezervasyon yok</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Son Mesajlar --}}
    <div class="admin-card">
        <div class="admin-card-header">
            <h3 class="admin-card-title">Son Mesajlar</h3>
            <a href="{{ route('admin.messages') }}" class="btn btn-sm btn-outline-gold">Tümünü Gör</a>
        </div>
        <div style="overflow:auto;">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Gönderen</th>
                        <th>Konu</th>
                        <th>Tarih</th>
                        <th>Durum</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($latestMessages as $msg)
                    <tr>
                        <td><strong>{{ $msg->name }}</strong><br><small style="color:#94A3B8;">{{ $msg->email }}</small></td>
                        <td style="max-width:150px; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;">{{ $msg->subject ?? substr($msg->message, 0, 30).'...' }}</td>
                        <td style="white-space:nowrap;">{{ $msg->created_at->format('d.m.Y') }}</td>
                        <td><span class="badge {{ $msg->read ? 'badge-read' : 'badge-unread' }}">{{ $msg->read ? 'Okundu' : 'Yeni' }}</span></td>
                    </tr>
                    @empty
                    <tr><td colspan="4" style="text-align:center; color:#94A3B8; padding:2rem;">Henüz mesaj yok</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
