<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Major;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $architecturalId = Major::where('name->en', 'Architectural Works')->first()?->id;
    $graphicDesignId = Major::where('name->en', 'Graphic Design')->first()?->id;
    $webDevId = Major::where('name->en', 'Web Development')->first()?->id;

    $categories = [
      [
        'major_id' => $architecturalId,
        'name' => ['ar' => 'تصميم داخلي', 'en' => 'Interior'],
        'description' => ['ar' => 'وصف التصميم الداخلي', 'en' => 'Interior design description'],
      ],
      [
        'major_id' => $architecturalId,
        'name' => ['ar' => 'تصميم خارجي', 'en' => 'Exterior'],
        'description' => ['ar' => 'وصف التصميم الخارجي', 'en' => 'Exterior design description'],
      ],
      [
        'major_id' => $architecturalId,
        'name' => ['ar' => 'تحريك ثلاثي الأبعاد', 'en' => '3D Animation'],
        'description' => ['ar' => 'وصف التحريك ثلاثي الأبعاد', 'en' => '3D Animation description'],
      ],
      [
        'major_id' => $architecturalId,
        'name' => ['ar' => 'تنسيق حدائق', 'en' => 'Land Escape'],
        'description' => ['ar' => 'وصف تنسيق الحدائق', 'en' => 'Land Escape description'],
      ],
      [
        'major_id' => $architecturalId,
        'name' => ['ar' => 'رسومات تنفيذية', 'en' => 'Shop Drawing'],
        'description' => ['ar' => 'وصف الرسومات التنفيذية', 'en' => 'Shop Drawing description'],
      ],

      // Graphic Design Categories
      [
        'major_id' => $graphicDesignId,
        'name' => ['ar' => 'تصميم جرافيك', 'en' => 'Graphic Design'],
        'description' => ['ar' => 'وصف تصميم الجرافيك', 'en' => 'Graphic Design description'],
      ],
      [
        'major_id' => $graphicDesignId,
        'name' => ['ar' => 'موشن جرافيك', 'en' => 'Motion Design'],
        'description' => ['ar' => 'وصف الموشن جرافيك', 'en' => 'Motion Design description'],
      ],

      // Web Development Categories
      [
        'major_id' => $webDevId,
        'name' => ['ar' => 'تصميم واجهة وتجربة المستخدم', 'en' => 'UI/UX Design'],
        'description' => ['ar' => 'وصف UI/UX', 'en' => 'UI/UX Design description'],
      ],
    ];

    foreach ($categories as $categoryData) {
      Category::create($categoryData);
    }
  }
}
