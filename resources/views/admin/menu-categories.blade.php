@extends('layouts.admin')

@section('title', 'Menü Kategorileri')
@section('page_title', 'Menü Kategorileri')

@section('content')

<div class="admin-split-grid">

    <div class="admin-card">
        <div class="admin-card-header">
            <h3 class="admin-card-title">Yeni Kategori</h3>
        </div>
        <div class="admin-card-body">
            <form action="{{ route('admin.menu.categories.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label class="form-label">Kategori Adı (TR) *</label>
                    <input type="text" name="name" id="cat_name" class="form-control" placeholder="Örn: Başlangıçlar" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Kategori Adı (EN)</label>
                    <input type="text" name="name_en" class="form-control" placeholder="Örn: Starters">
                </div>
                <div class="form-group">
                    <label class="form-label">Kategori Adı (ES)</label>
                    <input type="text" name="name_es" class="form-control">
                </div>
                <div class="form-group">
                    <label class="form-label">Kategori Adı (AR)</label>
                    <input type="text" name="name_ar" class="form-control" dir="rtl">
                </div>
                <div class="form-group">
                    <label class="form-label">Kategori Adı (RU)</label>
                    <input type="text" name="name_ru" class="form-control">
                </div>
                <div class="form-group">
                    <label class="form-label">Slug *</label>
                    <input type="text" name="slug" id="cat_slug" class="form-control" placeholder="baslangiclar" required>
                </div>
                <div class="form-group">
                    <label class="form-label">İkon (emoji)</label>
                    <input type="text" name="icon" class="form-control" placeholder="🥗">
                </div>
                <div class="form-group">
                    <label class="form-label">Sıra</label>
                    <input type="number" name="order" class="form-control" value="0">
                </div>
                <button type="submit" class="btn btn-primary" style="width:100%; justify-content:center;">Kategori Ekle</button>
            </form>
        </div>
    </div>

    <div class="admin-card">
        <div class="admin-card-header">
            <h3 class="admin-card-title">Kategoriler</h3>
        </div>
        <table class="admin-table">
            <thead><tr><th>İkon</th><th>Ad (TR)</th><th>Ad (EN)</th><th>ES/AR/RU</th><th>Slug</th><th>Sıra</th><th>İşlem</th></tr></thead>
            <tbody>
                @forelse($categories as $cat)
                <tr>
                    <td>
                        <form id="edit-cat-form-{{ $cat->id }}" action="{{ route('admin.menu.categories.update', $cat) }}" method="POST" style="display:none;">
                            @csrf
                            @method('PATCH')
                        </form>
                        <input type="text" name="icon" form="edit-cat-form-{{ $cat->id }}" class="form-control" value="{{ $cat->icon }}" style="width: 50px; text-align: center; padding: 0.25rem; font-size: 1.25rem; border-color: rgba(201, 169, 110, 0.2);">
                    </td>
                    <td>
                        <input type="text" name="name" form="edit-cat-form-{{ $cat->id }}" class="form-control" value="{{ $cat->name }}" style="min-width: 140px; font-weight: bold; padding: 0.25rem; border-color: rgba(201, 169, 110, 0.2);" required>
                    </td>
                    <td>
                        <input type="text" name="name_en" form="edit-cat-form-{{ $cat->id }}" class="form-control" value="{{ $cat->name_en }}" style="min-width: 140px; padding: 0.25rem; border-color: rgba(201, 169, 110, 0.2);" placeholder="EN">
                    </td>
                    <td>
                        <div style="display:flex; flex-direction:column; gap:0.25rem;">
                            <input type="text" name="name_es" form="edit-cat-form-{{ $cat->id }}" class="form-control" value="{{ $cat->name_es }}" style="min-width: 100px; padding: 0.25rem; border-color: rgba(201, 169, 110, 0.2); font-size:0.8rem;" placeholder="ES">
                            <input type="text" name="name_ar" form="edit-cat-form-{{ $cat->id }}" class="form-control" value="{{ $cat->name_ar }}" style="min-width: 100px; padding: 0.25rem; border-color: rgba(201, 169, 110, 0.2); font-size:0.8rem;" placeholder="AR" dir="rtl">
                            <input type="text" name="name_ru" form="edit-cat-form-{{ $cat->id }}" class="form-control" value="{{ $cat->name_ru }}" style="min-width: 100px; padding: 0.25rem; border-color: rgba(201, 169, 110, 0.2); font-size:0.8rem;" placeholder="RU">
                        </div>
                    </td>
                    <td style="font-size:0.8rem; color:#94A3B8; vertical-align: middle;">{{ $cat->slug }}</td>
                    <td>
                        <input type="number" name="order" form="edit-cat-form-{{ $cat->id }}" class="form-control" value="{{ $cat->order }}" style="width: 70px; padding: 0.25rem; border-color: rgba(201, 169, 110, 0.2);" required>
                    </td>
                    <td>
                        <div style="display:flex; gap:0.35rem; align-items:center;">
                            <button type="submit" form="edit-cat-form-{{ $cat->id }}" class="btn btn-sm" style="background:var(--gold); color:var(--navy-deep); padding:0.3rem 0.6rem; font-weight: 600;">Kaydet</button>
                            <form action="{{ route('admin.menu.categories.destroy', $cat) }}" method="POST" onsubmit="return confirm('Silmek istediğinizden emin misiniz? Bu kategorideki tüm ürünler de silinecektir!')" style="display:inline; margin:0;">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm" style="background:#FEE2E2; color:#991B1B; padding:0.3rem 0.6rem;">Sil</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" style="text-align:center; padding:2rem; color:#94A3B8;">Henüz kategori yok</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<script>
document.getElementById('cat_name')?.addEventListener('input', function() {
    let text = this.value.toLowerCase()
        .replace(/ğ/g, 'g')
        .replace(/ü/g, 'u')
        .replace(/ş/g, 's')
        .replace(/ı/g, 'i')
        .replace(/ö/g, 'o')
        .replace(/ç/g, 'c')
        .replace(/[^a-z0-9 -]/g, '')
        .replace(/\s+/g, '-')
        .replace(/-+/g, '-');
    document.getElementById('cat_slug').value = text;
});
</script>
@endsection
