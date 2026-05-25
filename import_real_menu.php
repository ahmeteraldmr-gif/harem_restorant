<?php
require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\MenuCategory;
use App\Models\MenuItem;
use Illuminate\Support\Str;

echo "=== BAŞLIYORUZ: REAL MENU AKTARIMI ===\n";

// Eski verileri temizle
echo "Eski kategoriler ve ürünler temizleniyor...\n";
MenuItem::truncate();
MenuCategory::truncate();

$categoryMapping = [
    'Balıklar' => [
        'name' => 'Balıklar',
        'name_en' => 'Fish',
        'icon' => '🐟',
        'order' => 1,
        'price' => 0, // Piyasa Fiyatı
        'desc' => 'Günlük olarak temin edilen, ızgara veya buğulama seçenekleriyle hazırlanan mevsim balıkları.'
    ],
    'Denız Ürünleri' => [
        'name' => 'Deniz Ürünleri',
        'name_en' => 'Seafood',
        'icon' => '🦞',
        'order' => 2,
        'price' => 0, // Piyasa Fiyatı
        'desc' => 'Taze Ege denizinden gelen özel deniz mahsulleri.'
    ],
    'Meze Başlangıc' => [
        'name' => 'Başlangıçlar',
        'name_en' => 'Starters',
        'icon' => '🥗',
        'order' => 3,
        'price' => 220,
        'desc' => 'Ege otları ve taze malzemelerle günlük olarak hazırlanan soğuk başlangıçlarımız.'
    ],
    'Soğuklar' => [
        'name' => 'Mezeler',
        'name_en' => 'Appetizers',
        'icon' => '🥣',
        'order' => 4,
        'price' => 195,
        'desc' => 'Geleneksel meze kültürünün en seçkin ve taze örnekleri.'
    ],
    'Ara Sıcaklar' => [
        'name' => 'Ara Sıcaklar',
        'name_en' => 'Warm Starters',
        'icon' => '🍤',
        'order' => 5,
        'price' => 420,
        'desc' => 'Deniz mahsulleri ve sıcak lezzetlerle hazırlanan iştah açıcı ara sıcaklarımız.'
    ],
    'Kebaplar' => [
        'name' => 'Kebaplar',
        'name_en' => 'Kebabs',
        'icon' => '🍢',
        'order' => 6,
        'price' => 620,
        'desc' => 'Geleneksel Türk mutfağının zırhta çekilmiş ve özenle hazırlanmış seçkin kebapları.'
    ],
    'Bonfileler' => [
        'name' => 'Bonfileler',
        'name_en' => 'Steaks',
        'icon' => '🥩',
        'order' => 7,
        'price' => 790,
        'desc' => 'Özenle dinlendirilmiş, şefimizin özel reçeteleriyle hazırlanan dana bonfile ve et çeşitleri.'
    ],
    'Izgara' => [
        'name' => 'Izgara',
        'name_en' => 'Grills',
        'icon' => '🔥',
        'order' => 8,
        'price' => 680,
        'desc' => 'Özel marine edilmiş, kömür ateşinde pişirilen enfes ızgara çeşitleri.'
    ],
    'Çorbalar' => [
        'name' => 'Çorbalar',
        'name_en' => 'Soups',
        'icon' => '🍲',
        'order' => 9,
        'price' => 160,
        'desc' => 'Sıcak ve taze hazırlanan günlük çorba çeşitlerimiz.'
    ],
    'Tavuklar' => [
        'name' => 'Tavuklar',
        'name_en' => 'Chicken Dishes',
        'icon' => '🍗',
        'order' => 10,
        'price' => 380,
        'desc' => 'Özel marinasyonlu ve soslu taze tavuk lezzetleri.'
    ],
    'Salatalar' => [
        'name' => 'Salatalar',
        'name_en' => 'Salads',
        'icon' => '🥗',
        'order' => 11,
        'price' => 260,
        'desc' => 'Bodrum bahçelerinden gelen taze yeşillikler ve özel soslarla hazırlanan salatalarımız.'
    ],
    'Güveçler' => [
        'name' => 'Güveçler',
        'name_en' => 'Casseroles',
        'icon' => '🍲',
        'order' => 12,
        'price' => 520,
        'desc' => 'Geleneksel güveçte, ağır ateşte pişirilen özel deniz ve et lezzetleri.'
    ],
    'Makarnalar' => [
        'name' => 'Makarnalar',
        'name_en' => 'Pastas',
        'icon' => '🍝',
        'order' => 13,
        'price' => 390,
        'desc' => 'Ev yapımı soslar ve taze malzemelerle hazırlanan makarna ve erişte çeşitleri.'
    ],
    'Tatlılar' => [
        'name' => 'Tatlılar',
        'name_en' => 'Desserts',
        'icon' => '🍮',
        'order' => 14,
        'price' => 240,
        'desc' => 'Gecenizi tatlandıracak geleneksel ve modern tatlı alternatiflerimiz.'
    ]
];

// Helper to generate description
function getTurkishDescription($itemName, $categoryName) {
    $desc = "";
    $itemNameLower = mb_strtolower($itemName, 'UTF-8');
    
    if (strpos($itemNameLower, 'ahtapot') !== false) {
        $desc = "Ege denizinin taze ahtapotu, özel baharatlar, zeytinyağı ve şefin sosuyla harmanlanarak sunulur.";
    } elseif (strpos($itemNameLower, 'karides') !== false) {
        $desc = "Taze körfez karidesleri, sarımsak, sızma zeytinyağı, domates ve eritilmiş kaşar peyniri eşliğinde enfes bir lezzet.";
    } elseif (strpos($itemNameLower, 'kalamar') !== false) {
        $desc = "Özel marinasyonla yumuşatılmış taze kalamarlar, altın sarısı çıtırlıkta pişirilerek özel tartar sos ile sunulur.";
    } elseif (strpos($itemNameLower, 'börülce') !== false) {
        $desc = "Bodrum kıyılarından toplanan taze börülceler, bol sarımsak, sızma zeytinyağı ve limon sosu ile Ege klasiği.";
    } elseif (strpos($itemNameLower, 'humus') !== false) {
        $desc = "Nohut, tahin, limon suyu ve sarımsağın kremsi uyumu, üzerine sızma zeytinyağı ve taze nohut taneleri ile.";
    } elseif (strpos($itemNameLower, 'ciğer') !== false) {
        $desc = "Kuzu ciğeri küpleri, özel un ve baharat karışımı ile tavada kızartılarak soğan ve maydanoz piyazı eşliğinde servis edilir.";
    } elseif (strpos($itemNameLower, 'salata') !== false) {
        $desc = "Mevsimin en taze yeşillikleri, zeytinler, Ege zeytinyağı ve nar ekşili sos eşliğinde sağlıklı ve ferahlatıcı bir tercih.";
    } elseif (strpos($itemNameLower, 'çorba') !== false) {
        $desc = "Günlük taze malzemelerle hazırlanan, içinizi ısıtacak lezzetli ve şifalı çorbamız.";
    } elseif (strpos($itemNameLower, 'kebap') !== false || strpos($itemNameLower, 'şiş') !== false || strpos($itemNameLower, 'köfte') !== false) {
        $desc = "Kömür ateşinde özenle pişirilmiş, közlenmiş biber, domates ve taze lavaş eşliğinde sunulan leziz kebap çeşidimiz.";
    } elseif (strpos($itemNameLower, 'bonfile') !== false || strpos($itemNameLower, 'antrikot') !== false || strpos($itemNameLower, 'biftek') !== false || strpos($itemNameLower, 'chateaubriand') !== false) {
        $desc = "Özenle dinlendirilmiş birinci sınıf dana eti, kömür ızgarasında pişirilerek patates püresi ve şefin özel sosu ile servis edilir.";
    } elseif (strpos($itemNameLower, 'makarna') !== false || strpos($itemNameLower, 'pasta') !== false || strpos($itemNameLower, 'spaghetti') !== false || strpos($itemNameLower, 'penne') !== false) {
        $desc = "İtalyan usulü taze makarna, enfes ev yapımı sosu, rendelenmiş parmesan peyniri ve taze otlar ile buluşuyor.";
    } elseif (strpos($itemNameLower, 'baklava') !== false || strpos($itemNameLower, 'kadayıf') !== false || strpos($itemNameLower, 'dondurma') !== false || strpos($itemNameLower, 'kazandibi') !== false) {
        $desc = "Geleneksel yöntemlerle hazırlanan, damağınızda unutulmaz bir tat bırakacak enfes tatlımız.";
    } elseif (strpos($itemNameLower, 'güveç') !== false) {
        $desc = "Toprak güveçte, ağır ateşte domates sosu, sarımsak, mantar ve kaşar peyniriyle pişirilmiş fırın lezzeti.";
    } elseif (strpos($itemNameLower, 'tavuk') !== false || strpos($itemNameLower, 'şinitzel') !== false || strpos($itemNameLower, 'nuggets') !== false) {
        $desc = "Marine edilmiş taze tavuk eti, enfes baharatlar ve garnitür eşliğinde hafif ve lezzetli bir ana yemek.";
    } elseif (strpos($itemNameLower, 'balık') !== false || strpos($itemNameLower, 'levrek') !== false || strpos($itemNameLower, 'çipura') !== false || strpos($itemNameLower, 'barbun') !== false || strpos($itemNameLower, 'somon') !== false || strpos($itemNameLower, 'lahos') !== false || strpos($itemNameLower, 'lüfer') !== false || strpos($itemNameLower, 'istakoz') !== false) {
        $desc = "Denizden taze çıkmış balığımız, kömür ızgarasında veya buğulama yöntemiyle pişirilerek roka, soğan ve limon ile servis edilir.";
    } else {
        $desc = "Harem Restaurant'ın taze malzemeler ve özel şef reçetesiyle hazırlanan eşsiz Ege lezzetlerinden biri.";
    }
    
    return $desc;
}

// Helper to generate english description
function getEnglishDescription($itemName) {
    $itemNameLower = mb_strtolower($itemName, 'UTF-8');
    
    if (strpos($itemNameLower, 'ahtapot') !== false) {
        return "Fresh Aegean octopus blended with special spices, olive oil, and chef's special sauce.";
    } elseif (strpos($itemNameLower, 'karides') !== false) {
        return "Fresh bay shrimps served with garlic, extra virgin olive oil, tomatoes, and melted kashar cheese.";
    } elseif (strpos($itemNameLower, 'kalamar') !== false) {
        return "Fresh calamari tenderized with special marination, fried to golden crispiness, and served with tartar sauce.";
    } elseif (strpos($itemNameLower, 'börülce') !== false) {
        return "Fresh cowpeas gathered from Bodrum shores, served with plenty of garlic, extra virgin olive oil, and lemon sauce - an Aegean classic.";
    } elseif (strpos($itemNameLower, 'humus') !== false) {
        return "Creamy harmony of chickpeas, tahini, lemon juice, and garlic, topped with extra virgin olive oil and fresh chickpeas.";
    } elseif (strpos($itemNameLower, 'ciğer') !== false) {
        return "Lamb liver cubes pan-fried with a special flour and spice blend, served with onion and parsley sumac salad.";
    } elseif (strpos($itemNameLower, 'salata') !== false) {
        return "A healthy and refreshing choice with the freshest seasonal greens, olives, Aegean olive oil, and pomegranate molasses dressing.";
    } elseif (strpos($itemNameLower, 'çorba') !== false) {
        return "Our delicious and healing daily soup prepared with fresh ingredients to warm you up.";
    } elseif (strpos($itemNameLower, 'kebap') !== false || strpos($itemNameLower, 'şiş') !== false || strpos($itemNameLower, 'köfte') !== false) {
        return "Our delicious kebab variety carefully cooked over charcoal, served with roasted peppers, tomatoes, and fresh flatbread.";
    } elseif (strpos($itemNameLower, 'bonfile') !== false || strpos($itemNameLower, 'antrikot') !== false || strpos($itemNameLower, 'biftek') !== false || strpos($itemNameLower, 'chateaubriand') !== false) {
        return "Premium aged beef carefully cooked on charcoal grill, served with mashed potatoes and chef's special sauce.";
    } elseif (strpos($itemNameLower, 'makarna') !== false || strpos($itemNameLower, 'pasta') !== false || strpos($itemNameLower, 'spaghetti') !== false || strpos($itemNameLower, 'penne') !== false) {
        return "Italian style fresh pasta meets delicious homemade sauce, grated parmesan cheese, and fresh herbs.";
    } elseif (strpos($itemNameLower, 'baklava') !== false || strpos($itemNameLower, 'kadayıf') !== false || strpos($itemNameLower, 'dondurma') !== false || strpos($itemNameLower, 'kazandibi') !== false) {
        return "Our delicious dessert prepared with traditional methods that will leave an unforgettable taste on your palate.";
    } elseif (strpos($itemNameLower, 'güveç') !== false) {
        return "Baked delicacy cooked in an earthen casserole over low heat with tomato sauce, garlic, mushrooms, and kashar cheese.";
    } elseif (strpos($itemNameLower, 'tavuk') !== false || strpos($itemNameLower, 'şinitzel') !== false || strpos($itemNameLower, 'nuggets') !== false) {
        return "Light and delicious main course with marinated fresh chicken meat, exquisite spices, and garnish.";
    } elseif (strpos($itemNameLower, 'balık') !== false || strpos($itemNameLower, 'levrek') !== false || strpos($itemNameLower, 'çipura') !== false || strpos($itemNameLower, 'barbun') !== false || strpos($itemNameLower, 'somon') !== false || strpos($itemNameLower, 'lahos') !== false || strpos($itemNameLower, 'lüfer') !== false || strpos($itemNameLower, 'istakoz') !== false) {
        return "Our fresh fish straight from the sea, cooked on charcoal grill or steamed, served with arugula, onion, and lemon.";
    } else {
        return "One of the unique Aegean flavors of Harem Restaurant, prepared with fresh ingredients and a special chef's recipe.";
    }
}


// Create categories and items
$basePath = 'GOOGLE FOTO MENU -';
$directories = scandir($basePath);

foreach ($directories as $dir) {
    if ($dir === '.' || $dir === '..' || !is_dir($basePath . DIRECTORY_SEPARATOR . $dir)) {
        continue;
    }
    
    if (!isset($categoryMapping[$dir])) {
        echo "Bilinmeyen kategori klasörü es geçiliyor: {$dir}\n";
        continue;
    }
    
    $mapping = $categoryMapping[$dir];
    $categorySlug = Str::slug($mapping['name']);
    
    $category = MenuCategory::create([
        'name' => $mapping['name'],
        'name_en' => $mapping['name_en'] ?? null,
        'name_es' => null,
        'name_ar' => null,
        'name_ru' => null,
        'slug' => $categorySlug,
        'icon' => $mapping['icon'],
        'order' => $mapping['order'],
        'active' => true
    ]);
    
    echo "Kategori oluşturuldu: {$mapping['name']} ({$mapping['icon']})\n";
    
    $itemDirs = scandir($basePath . DIRECTORY_SEPARATOR . $dir);
    $itemOrder = 1;
    
    foreach ($itemDirs as $itemDir) {
        if ($itemDir === '.' || $itemDir === '..') continue;
        $itemPath = $basePath . DIRECTORY_SEPARATOR . $dir . DIRECTORY_SEPARATOR . $itemDir;
        
        if (is_dir($itemPath)) {
            $itemName = $itemDir;
            // Find image
            $files = scandir($itemPath);
            $imageFile = null;
            
            foreach ($files as $file) {
                if ($file === '.' || $file === '..') continue;
                $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                if (in_array($ext, ['png', 'jpg', 'jpeg', 'webp'])) {
                    $imageFile = $file;
                    break;
                }
            }
            
            $copiedImageName = null;
            if ($imageFile) {
                $ext = strtolower(pathinfo($imageFile, PATHINFO_EXTENSION));
                $cleanImageName = Str::slug($itemName) . '.' . $ext;
                $destPath = public_path('images' . DIRECTORY_SEPARATOR . $cleanImageName);
                
                if (copy($itemPath . DIRECTORY_SEPARATOR . $imageFile, $destPath)) {
                    $copiedImageName = $cleanImageName;
                }
            }
            
            // Set price
            $price = $mapping['price'];
            // Specific overrides for premium items
            if ($price > 0) {
                if (strpos(strtolower($itemName), 'karışık') !== false || strpos(strtolower($itemName), 'chateaubriand') !== false) {
                    $price = $price * 1.5;
                }
            }
            
            $description = getTurkishDescription($itemName, $mapping['name']);
            $descriptionEn = getEnglishDescription($itemName);
            
            // Basic translation fallback for item names if you were to add an array, here we just use name.
            // A more complete translation map can be used. For now, name_en can be set by the translate_db script later, 
            // but we can initialize it to null or the same name.
            
            // Create item
            MenuItem::create([
                'menu_category_id' => $category->id,
                'name' => $itemName,
                'name_en' => null, // Will be updated by translate_db_v2
                'name_es' => null,
                'name_ar' => null,
                'name_ru' => null,
                'description' => $description,
                'description_en' => $descriptionEn,
                'description_es' => null,
                'description_ar' => null,
                'description_ru' => null,
                'price' => $price,
                'image' => $copiedImageName,
                'featured' => ($itemOrder <= 2 && $price > 0), // ilk 2 ürünü öne çıkan yap (fiyatı varsa)
                'active' => true,
                'order' => $itemOrder++
            ]);
            
            echo "  -> Ürün eklendi: {$itemName} (Görsel: " . ($copiedImageName ? $copiedImageName : 'Yok') . ")\n";
        }
    }
}

// Galeri resimlerini de güncelle
echo "Galeri veritabanı yenileniyor...\n";
\App\Models\GalleryImage::truncate();

$galleryImages = [
    ['title' => 'Ege Denizi Manzaralı Teras',         'image' => 'ambiance-1.png',  'category' => 'atmosfer', 'order' => 1],
    ['title' => 'Harem Mum Işığı Akşam Yemeği',       'image' => 'ambiance-2.png',  'category' => 'atmosfer', 'order' => 2],
    ['title' => 'Terasımızda Eşsiz Akdeniz Esintisi', 'image' => 'ambiance-3.png',  'category' => 'atmosfer', 'order' => 3],
    ['title' => 'Konforlu ve Şık Masalarımız',         'image' => 'ambiance-4.png',  'category' => 'atmosfer', 'order' => 4],
    ['title' => 'Harem Ağırlama ve İç Mekan Detayları','image' => 'ambiance-5.jpg',  'category' => 'atmosfer', 'order' => 5],
    ['title' => 'Bodrum Akşamında Romantik Atmosfer',  'image' => 'ambiance-6.png',  'category' => 'atmosfer', 'order' => 6],
    ['title' => 'Geleneksel ve Modern Lezzet Köşesi',  'image' => 'ambiance-7.jpeg', 'category' => 'atmosfer', 'order' => 7],
    ['title' => 'Akdeniz Akşam Güneşi Altında',       'image' => 'ambiance-8.jpeg', 'category' => 'atmosfer', 'order' => 8],
    ['title' => 'Zarif İç Mekan',                     'image' => 'interior.png',    'category' => 'atmosfer', 'order' => 9],
    ['title' => 'Taze Meze Sunumu',                   'image' => 'menu-meze.png',   'category' => 'yemekler', 'order' => 10],
    ['title' => 'Izgara Ahtapot',                     'image' => 'izgara-ahtapot.jpg', 'category' => 'yemekler', 'order' => 11],
    ['title' => 'Kalamar Tava',                       'image' => 'kalamar-tava.jpg', 'category' => 'yemekler', 'order' => 12],
    ['title' => 'Karides Güveç',                      'image' => 'karides-guveci.jpg', 'category' => 'yemekler', 'order' => 13],
    ['title' => 'Dana Bonfile',                       'image' => 'dana-bonfile.jpg', 'category' => 'yemekler', 'order' => 14],
];

foreach ($galleryImages as $img) {
    if (file_exists(public_path('images/' . $img['image']))) {
        \App\Models\GalleryImage::create($img);
        echo "  -> Galeriye eklendi: {$img['title']} ({$img['image']})\n";
    } else {
        echo "  -> Uyarı: Görsel bulunamadı: {$img['image']}\n";
    }
}

echo "=== BAŞARIYLA TAMAMLANDI! ===\n";
echo "Lütfen yeni diller için 'php translate_db_v2.php' komutunu çalıştırarak veritabanı çevirilerini uygulayın.\n";

