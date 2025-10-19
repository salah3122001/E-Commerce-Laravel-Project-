<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductImages;
use App\Models\Review;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $categories = [
            ['id' => '1', 'name_en' => 'Cameras', 'name_ar' => 'كاميرات', 'description_en' => 'Taking Photos And Videos', 'description_ar' => 'التقاط صور وفيديوهات', 'imagePath' => 'assets/img/cameras.jpeg'],
            ['id' => '2', 'name_en' => 'Food', 'name_ar' => 'طعام', 'description_en' => 'Grill Meals', 'description_ar' => 'وجبات مشوية', 'imagePath' => 'assets/img/meals.jpeg'],
            ['id' => '3', 'name_en' => 'Watches', 'name_ar' => 'ساعات', 'description_en' => 'Know  What Time Is It', 'description_ar' => 'معرفة الوقت', 'imagePath' => 'assets/img/watches.jpeg'],
            ['id' => '4', 'name_en' => 'Bags', 'name_ar' => 'شنط', 'description_en' => 'Back And Hand Bags', 'description_ar' => 'شنط ظهر و يد', 'imagePath' => 'assets/img/bags.jpeg'],
            ['id' => '5', 'name_en' => 'Electrical Devices', 'name_ar' => 'اجهزة الكترونية', 'description_en' => 'Devices That Use Electricity', 'description_ar' => 'اجهزة تعمل بالكهرباء', 'imagePath' => 'assets/img/electricaldevices.jpeg'],
        ];

        $products = [
            ['id' => '1', 'name_en' => 'Burger', 'name_ar' => 'بورجر', 'description_en' => 'Delicious', 'description_ar' => 'لذيذ', 'imagePath' => 'assets/img/burger.jpeg', 'price' => 200, 'quantity' => 5, 'category_id' => 2],
            ['id' => '2', 'name_en' => 'Canon camera', 'name_ar' => 'كاميرا كانون', 'description_en' => 'Nice Camera', 'description_ar' => 'كاميرا رئعة', 'imagePath' => 'assets/img/canon.jpeg', 'price' => 7000, 'quantity' => 11, 'category_id' => 1],
            ['id' => '3', 'name_en' => 'Sony camera', 'name_ar' => 'كاميرا سوني', 'description_en' => 'Nice Pictures', 'description_ar' => 'صور رائعة', 'imagePath' => 'assets/img/sony.jpeg', 'price' => 8000, 'quantity' => 7, 'category_id' => 1],
            ['id' => '4', 'name_en' => 'Chicken', 'name_ar' => 'فراخ', 'description_en' => 'Good', 'description_ar' => 'جيدة', 'imagePath' => 'assets/img/chicken.jpeg', 'price' => 150, 'quantity' => 25, 'category_id' => 2],
            ['id' => '5', 'name_en' => 'Hand Bag', 'name_ar' => 'شنطة يد', 'description_en' => 'Easy To Carry', 'description_ar' => 'سهلة الحمل', 'imagePath' => 'assets/img/bag1.jpeg', 'price' => 700, 'quantity' => 8, 'category_id' => 4],
            ['id' => '6', 'name_en' => 'Back Bag', 'name_ar' => 'شنطة ظهر', 'description_en' => 'Light Bag', 'description_ar' => 'شنطة خفيفة', 'imagePath' => 'assets/img/bag2.jpeg', 'price' => 500, 'quantity' => 5, 'category_id' => 4],
            ['id' => '7', 'name_en' => 'Rolex Watch', 'name_ar' => 'ساعة روليكس', 'description_en' => 'Gold', 'description_ar' => 'ذهبية', 'imagePath' => 'assets/img/rolex.jpeg', 'price' => 2000, 'quantity' => 6, 'category_id' => 3],
            ['id' => '8', 'name_en' => 'Casio Watch', 'name_ar' => 'ساعة كاسيو', 'description_en' => 'Cheap', 'description_ar' => 'رخيصة', 'imagePath' => 'assets/img/casio.jpeg', 'price' => 700, 'quantity' => 15, 'category_id' => 3],
            ['id' => '9', 'name_en' => 'Fridge', 'name_ar' => 'ثلاجة', 'description_en' => 'Keeps Foods Fresh', 'description_ar' => 'بقاء الأكل طازج', 'imagePath' => 'assets/img/fridge.jpeg', 'price' => 17000, 'quantity' => 8, 'category_id' => 5],

        ];

        $reviews = [
            ['id' => '1', 'name' => 'eman', 'email' => 'eman@gmail.com', 'phone' => '01065974231', 'image' => 'assets/img/avatars/avatar1.png', 'subject' => 'bags', 'message' => 'easy to carry'],
            ['id' => '2', 'name' => 'islam', 'email' => 'islam@gmail.com', 'phone' => '01065924231', 'image' => 'assets/img/avatars/avatar2.png', 'subject' => 'electronics', 'message' => 'mobiles are cheap'],
            ['id' => '3', 'name' => 'mohamed', 'email' => 'mohamed@gmail.com', 'phone' => '01065974231', 'image' => 'assets/img/avatars/avatar3.png', 'subject' => 'food', 'message' => 'nice meals'],
        ];

        $productImages = [
            ['id' => '1', 'images' => 'assets/img/moreimagesofproducts/sony2.jpeg', 'product_id' => '3'],
            ['id' => '2', 'images' => 'assets/img/moreimagesofproducts/rolex2.jpeg', 'product_id' => '7'],
            ['id' => '3', 'images' => 'assets/img/moreimagesofproducts/fridge2.jpeg', 'product_id' => '9'],
            ['id' => '4', 'images' => 'assets/img/moreimagesofproducts/chicken2.jpeg', 'product_id' => '4'],
            ['id' => '5', 'images' => 'assets/img/moreimagesofproducts/bag22.jpeg', 'product_id' => '6'],
            ['id' => '6', 'images' => 'assets/img/moreimagesofproducts/canon2.jpeg', 'product_id' => '2'],
            ['id' => '7', 'images' => 'assets/img/moreimagesofproducts/burger2.jpeg', 'product_id' => '1'],
            ['id' => '8', 'images' => 'assets/img/moreimagesofproducts/casio2.jpeg', 'product_id' => '8'],
            ['id' => '9', 'images' => 'assets/img/moreimagesofproducts/bag12.jpeg', 'product_id' => '5'],
        ];
        $users = [
            ['id' => '1','name'=>'admin', 'email'=>'admin@gmail.com', 'password' => Hash::make(123456789), 'role' => 'admin'],
        ];

        Schema::disableForeignKeyConstraints();

        Category::truncate();
        Product::truncate();
        Review::truncate();
        ProductImages::truncate();
        User::truncate();

        Schema::enableForeignKeyConstraints();

        Category::insert($categories);
        Product::insert($products);
        Review::insert($reviews);
        ProductImages::insert($productImages);
        User::insert($users);






        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
