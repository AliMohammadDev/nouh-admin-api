<?php

namespace Database\Seeders;

use App\Models\Major;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MajorSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    // database/seeders/MajorSeeder.php

    $majors = [
      [
        'name' => ['ar' => 'هندسة معمارية', 'en' => 'Architectural Works'],
        'description' => ['ar' => 'وصف للهندسة المعمارية', 'en' => 'Architectural description'],
      ],
      [
        'name' => ['ar' => 'تصميم جرافيك', 'en' => 'Graphic Design'],
        'description' => ['ar' => 'وصف لتصميم الجرافيك', 'en' => 'Graphic Design description'],
      ],
      [
        'name' => ['ar' => 'تطوير الويب', 'en' => 'Web Development'],
        'description' => ['ar' => 'وصف لتطوير الويب', 'en' => 'Web Development description'],
      ],
    ];

    foreach ($majors as $majorData) {
      Major::create($majorData);
    }
  }
}