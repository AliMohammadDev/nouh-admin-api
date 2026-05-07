<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $tags = [
      [
        'name' => ['ar' => 'مودرن', 'en' => 'Modern'],
      ],
      [
        'name' => ['ar' => 'نيوكلاسيك', 'en' => 'Neoclassic'],
      ],
      [
        'name' => ['ar' => 'استدامة', 'en' => 'Sustainable'],
      ],

      [
        'name' => ['ar' => 'هوية بصرية', 'en' => 'Branding'],
      ],
      [
        'name' => ['ar' => 'الحد الأدنى', 'en' => 'Minimalist'],
      ],
      [
        'name' => ['ar' => 'تغليف منتجات', 'en' => 'Packaging'],
      ],

      [
        'name' => ['ar' => 'تطبيق جوال', 'en' => 'Mobile App'],
      ],
      [
        'name' => ['ar' => 'متجر إلكتروني', 'en' => 'E-commerce'],
      ],
      [
        'name' => ['ar' => 'لوحة تحكم', 'en' => 'Dashboard'],
      ],
      [
        'name' => ['ar' => 'سرعة الأداء', 'en' => 'High Performance'],
      ],
    ];

    foreach ($tags as $tagData) {
      Tag::create($tagData);
    }
  }
}
