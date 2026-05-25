@extends('layouts.admin')

@section('title', 'Rezervasyonlar')
@section('page_title', 'Rezervasyonlar')

@section('content')

<div class="admin-card">
    <div class="admin-card-header">
        <h3 class="admin-card-title">Tüm Rezervasyonlar</h3>
        <span style="font-size:0.875rem; color:#94A3B8;">Toplam: {{ $reservations->total() }}</span>
    </div>
    <div class="table-responsive">
        <table class="admin-table reservations-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Ad Soyad</th>
                    <th>İletişim</th>
                    <th>Tarih & Saat</th>
                    <th>Kişi</th>
                    <th>Not</th>
                    <th>Durum</th>
                    <th>İşlemler</th>
                </tr>
            </thead>
            <tbody>
                @forelse($reservations as $res)
                <tr>
                    <td data-label="#"> <span style="color:#94A3B8; font-size:0.8rem;">{{ $res->id }}</span></td>
                    <td data-label="Ad Soyad"><strong>{{ $res->name }}</strong></td>
                    <td data-label="İletişim">
                        <a href="tel:{{ $res->phone }}" style="color:var(--sea); font-size:0.875rem;">{{ $res->phone }}</a>
                        @if($res->email)<br><small style="color:#94A3B8;">{{ $res->email }}</small>@endif
                    </td>
                    <td data-label="Tarih & Saat">
                        <strong>{{ $res->date->format('d.m.Y') }}</strong><br>
                        <small style="color:#94A3B8;">{{ $res->time }}</small>
                    </td>
                    <td data-label="Kişi">{{ $res->guests }} kişi</td>
                    <td data-label="Not" style="max-width:120px; font-size:0.8rem; color:#64748B;">{{ $res->notes ?? '—' }}</td>
                    <td data-label="Durum">
                        <form action="{{ route('admin.reservations.update', $res) }}" method="POST" style="display:inline;">
                            @csrf @method('PATCH')
                            <select name="status" onchange="this.form.submit()" class="form-control" style="width:auto; padding:0.3rem 0.5rem; font-size:0.8rem;">
                                <option value="pending"   {{ $res->status == 'pending'   ? 'selected' : '' }}>⏳ Bekliyor</option>
                                <option value="confirmed" {{ $res->status == 'confirmed' ? 'selected' : '' }}>✅ Onaylandı</option>
                                <option value="cancelled" {{ $res->status == 'cancelled' ? 'selected' : '' }}>❌ İptal</option>
                            </select>
                        </form>
                    </td>
                    <td data-label="İşlemler">
                        <form action="{{ route('admin.reservations.destroy', $res) }}" method="POST" onsubmit="return confirm('Silmek istediğinizden emin misiniz?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm" style="background:#FEE2E2; color:#991B1B; padding:0.3rem 0.6rem;">Sil</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="8" style="text-align:center; padding:3rem; color:#94A3B8;">Henüz rezervasyon bulunmuyor</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

<style>
@media (max-width: 768px) {
    .reservations-table { display: block !important; width: 100%; border: none !important; }
    .reservations-table thead { display: none; }
    .reservations-table tbody { display: block; width: 100%; }
    .reservations-table tr {
        display: block;
        margin-bottom: 1rem;
        border: 1px solid rgba(201,169,110,0.2);
        border-radius: var(--radius-md);
        padding: 1rem;
        background: #fff;
        box-shadow: var(--shadow-sm);
    }
    .reservations-table td {
        display: flex;
        justify-content: space-between;
        align-items: center;
        text-align: right;
        padding: 0.6rem 0 !important;
        border-bottom: 1px solid #F1F5F9;
        font-size: 0.85rem !important;
        white-space: normal !important;
    }
    .reservations-table td:last-child { border-bottom: none; }
    .reservations-table td::before {
        content: attr(data-label);
        font-weight: 600;
        color: var(--navy);
        margin-right: 1rem;
        text-align: left;
    }
    .reservations-table td > * {
        text-align: right;
    }
    .reservations-table td form {
        display: flex;
        justify-content: flex-end;
    }
}
</style>
    <div style="padding:1rem 1.5rem;">
        {{ $reservations->links() }}
    </div>
</div>
@endsection
