<?php

namespace Database\Seeders;

use App\Models\LinkType;
use Illuminate\Database\Seeder;

class LinkTypeSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $linkTypes = [
      [
        'name' => ['ar' => 'فيسبوك', 'en' => 'Facebook'],
      ],
      [
        'name' => ['ar' => 'إنستغرام', 'en' => 'Instagram'],
      ],
      [
        'name' => ['ar' => 'بيهانس', 'en' => 'Behance'],
      ],
      [
        'name' => ['ar' => 'يوتيوب', 'en' => 'YouTube'],
      ],
      [
        'name' => ['ar' => 'إكس (تويتر)', 'en' => 'X (Twitter)'],
      ],
      [
        'name' => ['ar' => 'لينكد إن', 'en' => 'LinkedIn'],
      ],
      [
        'name' => ['ar' => 'جولة افتراضية 360', 'en' => 'Virtual Tour 360'],
      ],
    ];
    foreach ($linkTypes as $data) {
      $linkType = LinkType::create([
        'name' => $data['name'],
      ]);
    }
  }
}
