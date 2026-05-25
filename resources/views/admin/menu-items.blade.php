@extends('layouts.admin')

@section('title', 'Menü Ürünleri')
@section('page_title', 'Menü Ürünleri')

@section('content')

<div class="admin-split-grid">

    {{-- Form --}}
    <div class="admin-card">
        <div class="admin-card-header">
            <h3 class="admin-card-title">Yeni Ürün Ekle</h3>
        </div>
        <div class="admin-card-body">
            <form action="{{ route('admin.menu.items.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="form-label">Kategori *</label>
                    <select name="menu_category_id" class="form-control" required>
                        <option value="">Kategori seçin</option>
                        @foreach($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->icon }} {{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Ürün Adı (TR) *</label>
                    <input type="text" name="name" class="form-control" placeholder="Ürün adı" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Ürün Adı (EN)</label>
                    <input type="text" name="name_en" class="form-control" placeholder="Product name">
                </div>
                <div class="form-group">
                    <label class="form-label">Ürün Adı (ES/AR/RU)</label>
                    <div style="display:flex; gap:0.5rem; flex-wrap:wrap;">
                        <input type="text" name="name_es" class="form-control" style="flex:1; min-width:80px;" placeholder="ES">
                        <input type="text" name="name_ar" class="form-control" style="flex:1; min-width:80px;" placeholder="AR" dir="rtl">
                        <input type="text" name="name_ru" class="form-control" style="flex:1; min-width:80px;" placeholder="RU">
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Açıklama (TR)</label>
                    <textarea name="description" class="form-control" rows="2" placeholder="Kısa açıklama"></textarea>
                </div>
                <div class="form-group">
                    <label class="form-label">Açıklama (EN)</label>
                    <textarea name="description_en" class="form-control" rows="2" placeholder="Short description"></textarea>
                </div>
                <div class="form-group">
                    <label class="form-label">Açıklama (ES/AR/RU)</label>
                    <div style="display:flex; gap:0.5rem; flex-wrap:wrap;">
                        <textarea name="description_es" class="form-control" rows="1" style="flex:1; min-width:120px;" placeholder="ES"></textarea>
                        <textarea name="description_ar" class="form-control" rows="1" style="flex:1; min-width:120px;" placeholder="AR" dir="rtl"></textarea>
                        <textarea name="description_ru" class="form-control" rows="1" style="flex:1; min-width:120px;" placeholder="RU"></textarea>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Fiyat (₺) *</label>
                        <input type="number" name="price" step="0.01" class="form-control" placeholder="0.00" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Sıra</label>
                        <input type="number" name="order" class="form-control" placeholder="0" value="0">
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Görsel</label>
                    <input type="file" name="image" class="form-control" accept="image/*">
                </div>
                <div class="form-group">
                    <label style="display:flex; align-items:center; gap:0.5rem; cursor:pointer;">
                        <input type="checkbox" name="featured" value="1"> Öne Çıkan ürün olarak işaretle
                    </label>
                </div>
                <button type="submit" class="btn btn-primary" style="width:100%; justify-content:center;">Ürün Ekle</button>
            </form>
        </div>
    </div>

    {{-- Liste --}}
    <div class="admin-card">
        <div class="admin-card-header">
            <h3 class="admin-card-title">Menü Ürünleri ({{ $items->count() }})</h3>
        </div>
        <div style="overflow:auto; max-height:600px;">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Ürün</th>
                        <th>Kategori</th>
                        <th>Fiyat</th>
                        <th>Sıra</th>
                        <th>Durum</th>
                        <th>İşlem</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($items as $item)
                    <tr>
                        <td>
                            <form id="edit-item-form-{{ $item->id }}" action="{{ route('admin.menu.items.update', $item) }}" method="POST" style="display:none;">
                                @csrf
                                @method('PATCH')
                            </form>
                            <input type="text" name="name" form="edit-item-form-{{ $item->id }}" class="form-control" value="{{ $item->name }}" style="font-weight:bold; font-size:0.875rem; padding:0.25rem; border-color: rgba(201, 169, 110, 0.2);" required>
                            <input type="text" name="name_en" form="edit-item-form-{{ $item->id }}" class="form-control" value="{{ $item->name_en }}" style="font-size:0.875rem; padding:0.25rem; border-color: rgba(201, 169, 110, 0.2); margin-top:0.25rem;" placeholder="EN Name">
                            <div style="display:flex; gap:0.25rem; margin-top:0.25rem;">
                                <input type="text" name="name_es" form="edit-item-form-{{ $item->id }}" class="form-control" value="{{ $item->name_es }}" style="flex:1; font-size:0.75rem; padding:0.25rem; border-color: rgba(201, 169, 110, 0.2);" placeholder="ES">
                                <input type="text" name="name_ar" form="edit-item-form-{{ $item->id }}" class="form-control" value="{{ $item->name_ar }}" style="flex:1; font-size:0.75rem; padding:0.25rem; border-color: rgba(201, 169, 110, 0.2);" placeholder="AR" dir="rtl">
                                <input type="text" name="name_ru" form="edit-item-form-{{ $item->id }}" class="form-control" value="{{ $item->name_ru }}" style="flex:1; font-size:0.75rem; padding:0.25rem; border-color: rgba(201, 169, 110, 0.2);" placeholder="RU">
                            </div>
                            @if($item->featured) <span class="menu-badge" style="font-size:0.6rem; padding:0.2rem 0.4rem; vertical-align: middle;">★</span>@endif
                            @if($item->description)
                            <br><small style="color:#94A3B8; font-size:0.75rem;">{{ Str::limit($item->description, 40) }}</small>
                            @endif
                        </td>
                        <td style="font-size:0.825rem; vertical-align: middle;">{{ $item->category->name ?? '—' }}</td>
                        <td>
                            <input type="number" name="price" step="0.01" form="edit-item-form-{{ $item->id }}" class="form-control" value="{{ $item->price }}" style="width: 90px; padding:0.25rem; border-color: rgba(201, 169, 110, 0.2); font-weight: 500;" required>
                        </td>
                        <td>
                            <input type="number" name="order" form="edit-item-form-{{ $item->id }}" class="form-control" value="{{ $item->order }}" style="width: 65px; padding:0.25rem; border-color: rgba(201, 169, 110, 0.2);" required>
                        </td>
                        <td style="vertical-align: middle;">
                            <form action="{{ route('admin.menu.items.toggle', $item) }}" method="POST" style="display:inline; margin:0;">
                                @csrf
                                <button type="submit" class="badge" style="cursor:pointer; border:none; {{ $item->active ? 'background:#D1FAE5; color:#065F46;' : 'background:#FEE2E2; color:#991B1B;' }}">
                                    {{ $item->active ? '✓ Aktif' : '✗ Pasif' }}
                                </button>
                            </form>
                        </td>
                        <td style="vertical-align: middle;">
                            <div style="display:flex; gap:0.35rem; align-items:center;">
                                <button type="submit" form="edit-item-form-{{ $item->id }}" class="btn btn-sm" style="background:var(--gold); color:var(--navy-deep); padding:0.3rem 0.6rem; font-weight: 600;">Kaydet</button>
                                <form action="{{ route('admin.menu.items.destroy', $item) }}" method="POST" onsubmit="return confirm('Silmek istediğinizden emin misiniz?')" style="display:inline; margin:0;">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm" style="background:#FEE2E2; color:#991B1B; padding:0.3rem 0.6rem;">Sil</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" style="text-align:center; padding:2rem; color:#94A3B8;">Henüz ürün yok</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
