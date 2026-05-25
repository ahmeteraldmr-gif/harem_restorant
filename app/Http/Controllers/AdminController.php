<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use App\Models\MenuCategory;
use App\Models\Reservation;
use App\Models\ContactMessage;
use App\Models\GalleryImage;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'reservations_total'  => Reservation::count(),
            'reservations_today'  => Reservation::whereDate('date', today())->count(),
            'reservations_pending'=> Reservation::where('status', 'pending')->count(),
            'messages_unread'     => ContactMessage::where('read', false)->count(),
            'menu_items'          => MenuItem::count(),
        ];
        $latestReservations = Reservation::latest()->take(5)->get();
        $latestMessages     = ContactMessage::latest()->take(5)->get();
        return view('admin.dashboard', compact('stats', 'latestReservations', 'latestMessages'));
    }

    // ── Menü Kategorileri ───────────────────────────────────────────────────────
    public function menuCategories()
    {
        $categories = MenuCategory::orderBy('order')->get();
        return view('admin.menu-categories', compact('categories'));
    }

    public function storeCat(Request $request)
    {
        if ($request->has('slug')) {
            $request->merge(['slug' => \Illuminate\Support\Str::slug($request->input('slug'))]);
        }
        $r = $request->validate([
            'name' => 'required',
            'name_en' => 'nullable',
            'name_es' => 'nullable',
            'name_ar' => 'nullable',
            'name_ru' => 'nullable',
            'slug' => 'required|unique:menu_categories',
            'icon' => 'nullable',
            'order' => 'nullable|integer'
        ]);
        $r['order'] = $r['order'] ?? 0;
        MenuCategory::create($r);
        return back()->with('success','Kategori eklendi.');
    }

    public function updateCat(Request $request, MenuCategory $category)
    {
        $r = $request->validate([
            'name' => 'required',
            'name_en' => 'nullable',
            'name_es' => 'nullable',
            'name_ar' => 'nullable',
            'name_ru' => 'nullable',
            'order' => 'required|integer',
            'icon' => 'nullable'
        ]);
        $category->update($r);
        return back()->with('success','Kategori güncellendi.');
    }

    public function destroyCat(MenuCategory $category)
    {
        $category->delete();
        return back()->with('success','Kategori silindi.');
    }

    // ── Menü Öğeleri ───────────────────────────────────────────────────────────
    public function menuItems()
    {
        $items      = MenuItem::with('category')->orderBy('menu_category_id')->orderBy('order')->get();
        $categories = MenuCategory::all();
        return view('admin.menu-items', compact('items', 'categories'));
    }

    public function storeItem(Request $request)
    {
        if ($request->has('price')) {
            $price = str_replace(',', '.', $request->input('price'));
            $request->merge(['price' => $price]);
        }
        $r = $request->validate([
            'menu_category_id'=>'required|exists:menu_categories,id',
            'name'            =>'required',
            'name_en'         =>'nullable',
            'name_es'         =>'nullable',
            'name_ar'         =>'nullable',
            'name_ru'         =>'nullable',
            'description'     =>'nullable',
            'description_en'  =>'nullable',
            'description_es'  =>'nullable',
            'description_ar'  =>'nullable',
            'description_ru'  =>'nullable',
            'price'           =>'required|numeric',
            'image'           =>'nullable|image|max:2048',
            'featured'        =>'boolean',
            'order'           =>'nullable|integer',
        ]);
        if ($request->hasFile('image')) {
            $r['image'] = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('images'), $r['image']);
        }
        $r['order'] = $r['order'] ?? 0;
        $r['featured'] = $request->boolean('featured');
        MenuItem::create($r);
        return back()->with('success','Ürün eklendi.');
    }

    public function updateItem(Request $request, MenuItem $item)
    {
        if ($request->has('price')) {
            $price = str_replace(',', '.', $request->input('price'));
            $request->merge(['price' => $price]);
        }
        $r = $request->validate([
            'name' => 'required',
            'name_en' => 'nullable',
            'name_es' => 'nullable',
            'name_ar' => 'nullable',
            'name_ru' => 'nullable',
            'description' => 'nullable',
            'description_en' => 'nullable',
            'description_es' => 'nullable',
            'description_ar' => 'nullable',
            'description_ru' => 'nullable',
            'price' => 'required|numeric',
            'order' => 'required|integer',
        ]);
        $item->update($r);
        return back()->with('success','Ürün güncellendi.');
    }

    public function destroyItem(MenuItem $item)
    {
        $item->delete();
        return back()->with('success','Ürün silindi.');
    }

    public function updateItemStatus(Request $request, MenuItem $item)
    {
        $item->update(['active' => !$item->active]);
        return back()->with('success','Ürün durumu güncellendi.');
    }

    // ── Rezervasyonlar ─────────────────────────────────────────────────────────
    public function reservations()
    {
        $reservations = Reservation::latest('date')->paginate(20);
        return view('admin.reservations', compact('reservations'));
    }

    public function updateReservation(Request $request, Reservation $reservation)
    {
        $reservation->update(['status' => $request->status]);
        return back()->with('success','Rezervasyon durumu güncellendi.');
    }

    public function destroyReservation(Reservation $reservation)
    {
        $reservation->delete();
        return back()->with('success','Rezervasyon silindi.');
    }

    // ── Mesajlar ───────────────────────────────────────────────────────────────
    public function messages()
    {
        $messages = ContactMessage::latest()->paginate(20);
        ContactMessage::where('read', false)->update(['read' => true]);
        return view('admin.messages', compact('messages'));
    }

    public function destroyMessage(ContactMessage $message)
    {
        $message->delete();
        return back()->with('success','Mesaj silindi.');
    }

    // ── Galeri ─────────────────────────────────────────────────────────────────
    public function gallery()
    {
        $images = GalleryImage::orderBy('order')->get();
        return view('admin.gallery', compact('images'));
    }

    public function storeGallery(Request $request)
    {
        $r = $request->validate([
            'title'    =>'nullable',
            'image'    =>'required|image|max:4096',
            'category' =>'required|in:yemekler,atmosfer,etkinlikler',
            'order'    =>'nullable|integer',
        ]);
        $r['image'] = time() . '_' . $request->file('image')->getClientOriginalName();
        $request->file('image')->move(public_path('images'), $r['image']);
        $r['order'] = $r['order'] ?? 0;
        GalleryImage::create($r);
        return back()->with('success','Görsel eklendi.');
    }

    public function destroyGallery(GalleryImage $galleryImage)
    {
        $galleryImage->delete();
        return back()->with('success','Görsel silindi.');
    }
}
