<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use App\Models\Category;
use App\Models\Product;

class StoreSeeder extends Seeder
{
    public function run(): void
    {
        // =====================
        // 🧠 تحميل صورة آمن
        // =====================
        $downloadImage = function ($url, $name) {

            $dir = storage_path('app/seeder');

            if (!file_exists($dir)) {
                mkdir($dir, 0777, true);
            }

            $image = Http::timeout(20)->get($url)->body();

            $path = $dir . '/' . $name;

            file_put_contents($path, $image);

            return $path;
        };

        // =====================
        // 🏠 الأقسام الرئيسية
        // =====================

        $bedroom = Category::create([
            'name' => 'غرفة النوم',
            'description' => 'مساحة هادئة تجمع بين الراحة والفخامة لتجربة نوم مثالية.'
        ]);

        $kitchen = Category::create([
            'name' => 'المطبخ',
            'description' => 'تصميم عملي يساعدك على تنظيم وتجربة طبخ ممتعة.'
        ]);

        $living = Category::create([
            'name' => 'الصالة',
            'description' => 'قلب المنزل الذي يجمع العائلة والضيوف بأناقة.'
        ]);

        $office = Category::create([
            'name' => 'المكتب',
            'description' => 'بيئة عمل احترافية تساعد على الإنتاجية والتركيز.'
        ]);

        $bathroom = Category::create([
            'name' => 'الحمام',
            'description' => 'نظافة وأناقة بتصميم عصري مريح.'
        ]);

        // =====================
        // 🖼️ صور الغرف (آمن)
        // =====================

        $bedroom->addMedia($downloadImage(
            'https://picsum.photos/800/600?random=1',
            'bedroom.jpg'
        ))->toMediaCollection('images');

        $kitchen->addMedia($downloadImage(
            'https://picsum.photos/800/600?random=2',
            'kitchen.jpg'
        ))->toMediaCollection('images');

        $living->addMedia($downloadImage(
            'https://picsum.photos/800/600?random=3',
            'living.jpg'
        ))->toMediaCollection('images');

        $office->addMedia($downloadImage(
            'https://picsum.photos/800/600?random=4',
            'office.jpg'
        ))->toMediaCollection('images');

        $bathroom->addMedia($downloadImage(
            'https://picsum.photos/800/600?random=5',
            'bathroom.jpg'
        ))->toMediaCollection('images');

        // =====================
        // 🪑 الأقسام الفرعية
        // =====================

        $tables = Category::create([
            'name' => 'طاولات',
            'description' => 'طاولات عصرية تناسب جميع المساحات.',
            'parent_id' => $bedroom->id
        ]);

        $chairs = Category::create([
            'name' => 'كراسي',
            'description' => 'كراسي مريحة وعملية للاستخدام اليومي.',
            'parent_id' => $office->id
        ]);

        $lamps = Category::create([
            'name' => 'أباجورات',
            'description' => 'إضاءة دافئة تضيف لمسة جمال وهدوء.',
            'parent_id' => $bedroom->id
        ]);

        $decor = Category::create([
            'name' => 'ديكورات',
            'description' => 'قطع ديكور فنية تعكس ذوقك.',
            'parent_id' => $living->id
        ]);

        $cabinets = Category::create([
            'name' => 'خزائن',
            'description' => 'تنظيم ذكي بمساحات تخزين أنيقة.',
            'parent_id' => $bedroom->id
        ]);

        // =====================
        // 🛍️ المنتجات
        // =====================

        $lamp = Product::create([
            'name' => 'أباجورة مودرن',
            'description' => 'إضاءة دافئة مثالية لغرف النوم والقراءة.',
            'price' => 180,
            'stock' => 10,
        ]);

        $lamp->addMedia($downloadImage(
            'https://picsum.photos/800/600?random=10',
            'lamp.jpg'
        ))->toMediaCollection('images');

        $lamp->categories()->attach([
            $bedroom->id,
            $kitchen->id,
            $lamps->id,
            $living->id
        ]);

        $table = Product::create([
            'name' => 'طاولة خشب فخمة',
            'description' => 'تصميم أنيق من خشب طبيعي فاخر.',
            'price' => 250,
            'stock' => 8,
        ]);

        $table->addMedia($downloadImage(
            'https://picsum.photos/800/600?random=11',
            'table.jpg'
        ))->toMediaCollection('images');

        $table->categories()->attach([
            $bedroom->id,
            $tables->id
        ]);

        $chair = Product::create([
            'name' => 'كرسي مكتب مريح',
            'description' => 'راحة كاملة أثناء العمل الطويل.',
            'price' => 300,
            'stock' => 6,
        ]);

        $chair->addMedia($downloadImage(
            'https://picsum.photos/800/600?random=12',
            'chair.jpg'
        ))->toMediaCollection('images');

        $chair->categories()->attach([
            $office->id,
            $chairs->id
        ]);

        $sofa = Product::create([
            'name' => 'كنب 3 مقاعد فاخر',
            'description' => 'راحة وأناقة لغرفة المعيشة.',
            'price' => 900,
            'stock' => 3,
        ]);

        $sofa->addMedia($downloadImage(
            'https://picsum.photos/800/600?random=13',
            'sofa.jpg'
        ))->toMediaCollection('images');

        $sofa->categories()->attach([
            $living->id,
            $decor->id
        ]);

        $cabinet = Product::create([
            'name' => 'خزانة ملابس فاخرة',
            'description' => 'تنظيم مثالي بلمسة فخامة.',
            'price' => 1200,
            'stock' => 4,
        ]);

        $cabinet->addMedia($downloadImage(
            'https://picsum.photos/800/600?random=14',
            'cabinet.jpg'
        ))->toMediaCollection('images');

        $cabinet->categories()->attach([
            $bedroom->id,
            $cabinets->id
        ]);
    }
}