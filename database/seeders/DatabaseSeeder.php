<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MenuCategory;
use App\Models\MenuItem;
use App\Models\GalleryImage;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin kullanıcı
        User::updateOrCreate(
            ['email' => 'admin@harem.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('harem2024'),
                'email_verified_at' => now(),
            ]
        );

        // ── Menü Kategorileri (klasör yapısından) ────────────────────────────────
        $categories = [
            ['name' => 'Meze & Başlangıç', 'slug' => 'meze-baslangic',  'icon' => '🥗', 'order' => 1],
            ['name' => 'Deniz Ürünleri',   'slug' => 'deniz-urunleri',  'icon' => '🦞', 'order' => 2],
            ['name' => 'Izgara',            'slug' => 'izgara',          'icon' => '🔥', 'order' => 3],
            ['name' => 'Tatlılar',          'slug' => 'tatlilar',        'icon' => '🍮', 'order' => 4],
        ];

        foreach ($categories as $cat) {
            MenuCategory::create($cat);
        }

        // ── Meze & Başlangıç (ID: 1) ────────────────────────────────────────────
        $mezeItems = [
            [
                'name'        => 'Arnavut Ciğeri',
                'description' => 'Taze kuzu ciğeri, soğan, maydanoz ve baharat ile özel tarifimizde kavurma. Geleneksel Arnavut usulü.',
                'price'       => 185,
                'image'       => 'arnavut-cigeri.png',
                'featured'    => false,
                'order'       => 1,
            ],
            [
                'name'        => 'Deniz Börülcesi',
                'description' => 'Taze Ege börülcesi, sarımsak, sızma zeytinyağı ve limon ile. Bodrum kıyılarından gelen doğallık.',
                'price'       => 145,
                'image'       => 'deniz-borulcesi.png',
                'featured'    => true,
                'order'       => 2,
            ],
            [
                'name'        => 'Humus',
                'description' => 'Ev yapımı kremsi humus, zeytinyağı, kırmızı biber ve nohut ile. Taze pide eşliğinde.',
                'price'       => 155,
                'image'       => 'humus.png',
                'featured'    => false,
                'order'       => 3,
            ],
            [
                'name'        => 'Patlıcan Ezmesi',
                'description' => 'Közde pişirilmiş patlıcan ezmesi, nar ekşisi, sarımsak ve taze otlar. Ege\'nin vazgeçilmezi.',
                'price'       => 145,
                'image'       => 'patlican-ezmesi.png',
                'featured'    => false,
                'order'       => 4,
            ],
        ];

        foreach ($mezeItems as $item) {
            MenuItem::create(array_merge($item, ['menu_category_id' => 1]));
        }

        // ── Deniz Ürünleri (ID: 2) ──────────────────────────────────────────────
        $denizItems = [
            [
                'name'        => 'Günün Balığı',
                'description' => 'Sabahın erken saatlerinde Bodrum körfezinden gelen taze balık, günlük pişirme yöntemiyle. Mevsime ve pazara göre değişir.',
                'price'       => 0, // Piyasa fiyatına göre
                'image'       => 'gunun-baligi.png',
                'featured'    => true,
                'order'       => 1,
            ],
            [
                'name'        => 'Kalamar Tava',
                'description' => 'Taze kalamar halkalar, özel un karışımıyla kızartılmış, tartar sos ve limon ile servis edilir.',
                'price'       => 320,
                'image'       => 'kalamar-tava.png',
                'featured'    => false,
                'order'       => 2,
            ],
            [
                'name'        => 'Karides Güveç',
                'description' => 'Taze karides, domates sosu, mantar, sarımsak ve kaşar ile özel güveçte pişirilmiş. Ekmek ile servis edilir.',
                'price'       => 480,
                'image'       => 'karides-guveci.png',
                'featured'    => true,
                'order'       => 3,
            ],
            [
                'name'        => 'Izgara Ahtapot',
                'description' => 'Körfez ahtapotu ızgara, kapari ezmesi, roka ve limon sosu ile. Şefin en çok tercih edilen deniz ürünü.',
                'price'       => 560,
                'image'       => 'izgara-ahtapot.png',
                'featured'    => true,
                'order'       => 4,
            ],
        ];

        foreach ($denizItems as $item) {
            MenuItem::create(array_merge($item, ['menu_category_id' => 2]));
        }

        // ── Izgara (ID: 3) ───────────────────────────────────────────────────────
        $izgaraItems = [
            [
                'name'        => 'Dana Bonfile',
                'description' => '250gr siyah angus dana bonfile, mantar sosu, kızarmış patates ve mevsim salatası ile. Pişirme derecenizi belirtiniz.',
                'price'       => 720,
                'image'       => 'dana-bonfile.png',
                'featured'    => true,
                'order'       => 1,
            ],
            [
                'name'        => 'Karışık Izgara',
                'description' => 'Kuzu şiş, köfte, tavuk kanat, bıldırcın ve sebze ızgara. Pilav, salata ve sos ile. 2 kişilik.',
                'price'       => 890,
                'image'       => 'karisik-izgara.png',
                'featured'    => true,
                'order'       => 2,
            ],
            [
                'name'        => 'Kuzu Pirzola',
                'description' => 'Ege kuzusundan alınan pirzola, taze ot ve sarımsak marinasyonu, közlenmiş sebzeler ile servis edilir.',
                'price'       => 680,
                'image'       => 'kuzu-pirzola.png',
                'featured'    => false,
                'order'       => 3,
            ],
            [
                'name'        => 'Tavuk Şiş',
                'description' => 'Marine edilmiş köy tavuğu şiş, pilav, közlenmiş biber ve cacık ile. Hafif ve lezzetli seçenek.',
                'price'       => 380,
                'image'       => 'tavuk-sis.png',
                'featured'    => false,
                'order'       => 4,
            ],
        ];

        foreach ($izgaraItems as $item) {
            MenuItem::create(array_merge($item, ['menu_category_id' => 3]));
        }

        // ── Tatlılar (ID: 4) ─────────────────────────────────────────────────────
        $tatlilar = [
            [
                'name'        => 'Harem Künefesi',
                'description' => 'Antep fıstıklı özel tel kadayıf, bol kaymak ve dövme fıstık ile. Sıcak servis edilir.',
                'price'       => 245,
                'image'       => null,
                'featured'    => true,
                'order'       => 1,
            ],
            [
                'name'        => 'Lokum Tabağı',
                'description' => 'El yapımı 6 çeşit Türk lokumu: gül, antep fıstıklı, portakallı, narlı ve daha fazlası.',
                'price'       => 185,
                'image'       => null,
                'featured'    => false,
                'order'       => 2,
            ],
            [
                'name'        => 'Panna Cotta',
                'description' => 'Gül suyu panna cotta, çilek coulis ve taze nane. Şefin tatlı tabağı.',
                'price'       => 165,
                'image'       => null,
                'featured'    => false,
                'order'       => 3,
            ],
        ];

        foreach ($tatlilar as $item) {
            MenuItem::create(array_merge($item, ['menu_category_id' => 4]));
        }

        // ── Galeri ───────────────────────────────────────────────────────────────
        $gallery = [
            ['title' => 'Deniz Manzaralı Teras',    'image' => 'gallery-terrace.png',  'category' => 'atmosfer', 'order' => 1],
            ['title' => 'Zarif İç Mekan',            'image' => 'interior.png',         'category' => 'atmosfer', 'order' => 2],
            ['title' => 'Izgara Ahtapot',            'image' => 'izgara-ahtapot.png',   'category' => 'yemekler', 'order' => 3],
            ['title' => 'Karides Güveç',             'image' => 'karides-guveci.png',   'category' => 'yemekler', 'order' => 4],
            ['title' => 'Dana Bonfile',              'image' => 'dana-bonfile.png',     'category' => 'yemekler', 'order' => 5],
            ['title' => 'Humus',                     'image' => 'humus.png',            'category' => 'yemekler', 'order' => 6],
        ];

        foreach ($gallery as $img) {
            GalleryImage::create($img);
        }
    }
}
