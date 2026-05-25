@extends('layouts.admin')

@section('title', 'Mesajlar')
@section('page_title', 'İletişim Mesajları')

@section('content')

<div class="admin-card">
    <div class="admin-card-header">
        <h3 class="admin-card-title">Tüm Mesajlar</h3>
        <span style="font-size:0.875rem; color:#94A3B8;">Toplam: {{ $messages->total() }}</span>
    </div>
    <div class="table-responsive">
        <table class="admin-table messages-table">
            <thead>
                <tr>
                    <th>Gönderen</th>
                    <th>E-posta</th>
                    <th>Konu</th>
                    <th>Mesaj</th>
                    <th>Tarih</th>
                    <th>Durum</th>
                    <th>İşlem</th>
                </tr>
            </thead>
            <tbody>
                @forelse($messages as $msg)
                <tr>
                    <td data-label="Gönderen"><strong>{{ $msg->name }}</strong></td>
                    <td data-label="E-posta"><a href="mailto:{{ $msg->email }}" style="color:var(--sea); font-size:0.875rem;">{{ $msg->email }}</a></td>
                    <td data-label="Konu" style="max-width:120px;">{{ $msg->subject ?? '—' }}</td>
                    <td data-label="Mesaj" style="max-width:200px; font-size:0.82rem; color:#64748B;">{{ Str::limit($msg->message, 80) }}</td>
                    <td data-label="Tarih" style="white-space:nowrap; font-size:0.82rem;">{{ $msg->created_at->format('d.m.Y H:i') }}</td>
                    <td data-label="Durum"><span class="badge {{ $msg->read ? 'badge-read' : 'badge-unread' }}">{{ $msg->read ? 'Okundu' : 'Yeni' }}</span></td>
                    <td data-label="İşlem">
                        <form action="{{ route('admin.messages.destroy', $msg) }}" method="POST" onsubmit="return confirm('Silmek istediğinizden emin misiniz?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm" style="background:#FEE2E2; color:#991B1B; padding:0.3rem 0.6rem;">Sil</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" style="text-align:center; padding:3rem; color:#94A3B8;">Henüz mesaj bulunmuyor</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

<style>
@media (max-width: 768px) {
    .messages-table { display: block !important; width: 100%; border: none !important; }
    .messages-table thead { display: none; }
    .messages-table tbody { display: block; width: 100%; }
    .messages-table tr {
        display: block;
        margin-bottom: 1rem;
        border: 1px solid rgba(201,169,110,0.2);
        border-radius: var(--radius-md);
        padding: 1rem;
        background: #fff;
        box-shadow: var(--shadow-sm);
    }
    .messages-table td {
        display: flex;
        justify-content: space-between;
        align-items: center;
        text-align: right;
        padding: 0.6rem 0 !important;
        border-bottom: 1px solid #F1F5F9;
        font-size: 0.85rem !important;
        white-space: normal !important;
    }
    .messages-table td:last-child { border-bottom: none; }
    .messages-table td::before {
        content: attr(data-label);
        font-weight: 600;
        color: var(--navy);
        margin-right: 1rem;
        text-align: left;
    }
    .messages-table td > * {
        text-align: right;
    }
    .messages-table td form {
        display: flex;
        justify-content: flex-end;
    }
}
</style>
    <div style="padding:1rem 1.5rem;">{{ $messages->links() }}</div>
</div>
@endsection
