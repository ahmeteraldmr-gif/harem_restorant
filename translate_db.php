<?php
require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\MenuCategory;
use App\Models\MenuItem;

echo "Translating Menu Categories...\n";

$categoryTranslations = [
    'Balıklar' => 'Fish',
    'Deniz Ürünleri' => 'Seafood',
    'Başlangıçlar' => 'Starters',
    'Mezeler' => 'Appetizers',
    'Ara Sıcaklar' => 'Warm Starters',
    'Kebaplar' => 'Kebabs',
    'Bonfileler' => 'Steaks',
    'Izgara' => 'Grills',
    'Çorbalar' => 'Soups',
    'Tavuklar' => 'Chicken Dishes',
    'Salatalar' => 'Salads',
    'Güveçler' => 'Casseroles',
    'Makarnalar' => 'Pastas',
    'Tatlılar' => 'Desserts'
];

foreach ($categoryTranslations as $trName => $enName) {
    MenuCategory::where('name', $trName)->update(['name_en' => $enName]);
}

echo "Translating Menu Items...\n";

$itemTranslations = [
    'Ahtapot Beyti' => 'Octopus Beyti',
    'Ahtapot Izgara' => 'Grilled Octopus',
    'Deniz Ürünleri Böreği' => 'Seafood Pastry',
    'Jumbo Izgara' => 'Grilled Jumbo Shrimp',
    'Kalamar Izgara' => 'Grilled Calamari',
    'Kalamar Tava' => 'Fried Calamari',
    'Karides Beyti' => 'Shrimp Beyti',
    'Karides Izgara' => 'Grilled Shrimp',
    'Karides Mantı' => 'Shrimp Manti',
    'Karides Tava' => 'Pan-Fried Shrimp',
    'Levrek Mantı' => 'Sea Bass Manti',
    'Levrek Simit' => 'Sea Bass Simit',
    'Mantar Dolma' => 'Stuffed Mushrooms',
    'Mantar Tava' => 'Pan-Fried Mushrooms',
    'Midye Tava' => 'Fried Mussels',
    'Sigara Böreği' => 'Cheese Roll Pastry',
    'Çıtır Karides' => 'Crispy Shrimp',
    'Balık Buğulama' => 'Steamed Fish',
    'Balık Şiş' => 'Fish Skewer',
    'Barbun' => 'Red Mullet',
    'Hamsi' => 'Anchovies',
    'Istakoz' => 'Lobster',
    'Karışık Deniz Ürünleri' => 'Mixed Seafood',
    'Lahos' => 'Grouper',
    'Levrek' => 'Sea Bass',
    'Lüfer' => 'Bluefish',
    'Mercan' => 'Red Seabream',
    'Somon' => 'Salmon',
    'Tuzda Balık' => 'Fish in Salt',
    'Çipura' => 'Sea Bream',
    'Antrikot' => 'Ribeye Steak',
    'Beef Stroganof' => 'Beef Stroganoff',
    'Biberli Bonfile' => 'Pepper Steak',
    'Bonfile' => 'Beef Tenderloin',
    'Chateaubriand' => 'Chateaubriand',
    'Dana Pirzola' => 'Veal Chop',
    'Kemikli Biftek' => 'T-Bone Steak',
    'Mantarlı Bonfile' => 'Mushroom Steak',
    'Meksika Bonfile' => 'Mexican Steak',
    'Rokfor Bonfile' => 'Roquefort Steak',
    'Sarımsaklı Bonfile' => 'Garlic Steak',
    'gunun balıgı' => 'Fish of the Day',
    'kalamar tava' => 'Fried Calamari',
    'karıdes guvecı' => 'Shrimp Casserole',
    'ızgara ahtapot' => 'Grilled Octopus',
    'Ahtapot Güveç' => 'Octopus Casserole',
    'Balık Güveç' => 'Fish Casserole',
    'Dana Güveç' => 'Beef Casserole',
    'Harem Güveç' => 'Harem Casserole',
    'Karides Güveç' => 'Shrimp Casserole',
    'Karışık Güveç' => 'Mixed Casserole',
    'Sebzeli Güveç' => 'Vegetable Casserole',
    'Tavuk Güveç' => 'Chicken Casserole',
    'Dana Bonfile' => 'Beef Tenderloin',
    'Karışık Izgara' => 'Mixed Grill',
    'Kuzu Pirzola' => 'Lamb Chops',
    'Tavuk Şiş' => 'Chicken Skewer',
    'Adana Kebap' => 'Adana Kebab',
    'Dana Şiş' => 'Beef Skewer',
    'Izgara Köfte' => 'Grilled Meatballs',
    'Karışık Kebap' => 'Mixed Kebab',
    'Kuzu Şiş' => 'Lamb Skewer',
    'Patlıcanlı Kebap' => 'Eggplant Kebab',
    'Sebze Kebap' => 'Vegetable Kebab',
    'Urfa Kebap' => 'Urfa Kebab',
    'Çökertme' => 'Cokertme Kebab',
    'İskender Kebap' => 'Iskender Kebab',
    'Lobster Pasta' => 'Lobster Pasta',
    'Penne Arrabiata' => 'Penne Arrabiata',
    'Seafood Pasta' => 'Seafood Pasta',
    'Spaghetti Bolognese' => 'Spaghetti Bolognese',
    'Spaghetti Napolitan' => 'Spaghetti Napolitana',
    'Arnavut Ciğeri' => 'Albanian Style Liver',
    'Deniz Börülcesi' => 'Sea Beans',
    'Humus' => 'Hummus',
    'Patlıcan Ezmesi' => 'Eggplant Dip',
    'Ahtapot Salata' => 'Octopus Salad',
    'Akdeniz Salata' => 'Mediterranean Salad',
    'Deniz Ürünleri Salatası' => 'Seafood Salad',
    'Karides Salatası' => 'Shrimp Salad',
    'Mevsim Salata' => 'Seasonal Salad',
    'Sezar Salata' => 'Caesar Salad',
    'Tavuk Salata' => 'Chicken Salad',
    'Ton Balıklı Salata' => 'Tuna Salad',
    'Yeşil Salata' => 'Green Salad',
    'Çoban Salata' => 'Shepherd\'s Salad',
    'Deniz  börülcesi' => 'Sea Beans',
    'Haydari' => 'Haydari',
    'Karides Kokdeyli' => 'Shrimp Cocktail',
    'Köpeoğlu' => 'Kopeoglu',
    'Midye dolma' => 'Stuffed Mussels',
    'Ordöv Tabağı' => 'Hors d\'oeuvre Plate',
    'Patlican Salatası' => 'Eggplant Salad',
    'Patlican soslu' => 'Sauced Eggplant',
    'Peynir Tabağı' => 'Cheese Platter',
    'Yaprak Dolma' => 'Stuffed Grape Leaves',
    'Dondurma Tabağı' => 'Ice Cream Plate',
    'Ekmek Kadayıfı' => 'Bread Pudding',
    'Fıstıklı Baklava' => 'Pistachio Baklava',
    'Kazandibi' => 'Kazandibi',
    'Kremalı Mantarlı Tavuk' => 'Creamy Mushroom Chicken',
    'Tavuk Izgara' => 'Grilled Chicken',
    'Tavuk Kanat' => 'Chicken Wings',
    'Tavuk Köri' => 'Curry Chicken',
    'Tavuk Nuggets' => 'Chicken Nuggets',
    'Tavuk Şinitzel' => 'Chicken Schnitzel',
    'Balık Çorbası' => 'Fish Soup',
    'Deniz Ürünleri Çorbası' => 'Seafood Soup',
    'Domates Çorbası' => 'Tomato Soup',
    'Mercimek Çorbası' => 'Lentil Soup'
];

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

foreach ($itemTranslations as $trName => $enName) {
    MenuItem::where('name', $trName)->update([
        'name_en' => $enName,
        'description_en' => getEnglishDescription($trName)
    ]);
}

$untranslated = MenuItem::whereNull('name_en')->get();
foreach ($untranslated as $item) {
    $item->update([
        'name_en' => $item->name,
        'description_en' => getEnglishDescription($item->name)
    ]);
}

echo "Done!\n";
