@extends('layouts.admin')

@section('title', 'Galeri')
@section('page_title', 'Galeri Yönetimi')

@section('content')

<div class="admin-split-grid">

    <div class="admin-card">
        <div class="admin-card-header"><h3 class="admin-card-title">Görsel Ekle</h3></div>
        <div class="admin-card-body">
            <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="form-label">Başlık</label>
                    <input type="text" name="title" class="form-control" placeholder="Görsel başlığı">
                </div>
                <div class="form-group">
                    <label class="form-label">Görsel *</label>
                    <input type="file" name="image" class="form-control" accept="image/*" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Kategori *</label>
                    <select name="category" class="form-control" required>
                        <option value="yemekler">🍽 Yemekler</option>
                        <option value="atmosfer">🌊 Atmosfer</option>
                        <option value="etkinlikler">🎉 Etkinlikler</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Sıra</label>
                    <input type="number" name="order" class="form-control" value="0">
                </div>
                <button type="submit" class="btn btn-primary" style="width:100%; justify-content:center;">Görsel Ekle</button>
            </form>
        </div>
    </div>

    <div class="admin-card">
        <div class="admin-card-header"><h3 class="admin-card-title">Galeri Görselleri</h3></div>
        <div class="admin-gallery-grid">
            @forelse($images as $img)
            <div style="position:relative; border-radius:var(--radius-sm); overflow:hidden; border:1px solid #E2E8F0;">
                <img src="/images/{{ $img->image }}" alt="{{ $img->title }}" style="width:100%; height:120px; object-fit:cover;">
                <div style="padding:0.5rem; background:var(--white);">
                    <div style="font-size:0.75rem; font-weight:600; color:var(--navy); margin-bottom:0.2rem;">{{ $img->title ?? 'Başlıksız' }}</div>
                    <div style="font-size:0.65rem; color:#94A3B8; margin-bottom:0.5rem;">{{ $img->category }}</div>
                    <form action="{{ route('admin.gallery.destroy', $img) }}" method="POST" onsubmit="return confirm('Silmek istiyor musunuz?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-sm" style="background:#FEE2E2; color:#991B1B; padding:0.2rem 0.5rem; font-size:0.7rem; width:100%; justify-content:center;">Sil</button>
                    </form>
                </div>
            </div>
            @empty
            <div style="grid-column:span 3; text-align:center; padding:3rem; color:#94A3B8;">Henüz görsel eklenmemiş</div>
            @endforelse
        </div>
    </div>

</div>

<style>
.admin-gallery-grid {
    padding: 1rem;
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 1rem;
}
@media (max-width: 768px) {
    .admin-gallery-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}
@media (max-width: 480px) {
    .admin-gallery-grid {
        grid-template-columns: 1fr;
    }
}
</style>
@endsection
