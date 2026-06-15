<?php

namespace Database\Seeders;

use App\Models\ProjectSection;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectSectionSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    ProjectSection::insert([
      [
        'type' => 'design',
        'name' => json_encode([
          'ar' => 'صور التصميم',
          'en' => 'Design Images',
        ]),
      ],
      [
        'type' => 'vr',
        'name' => json_encode([
          'ar' => 'صور 360 VR',
          'en' => '360 VR Images',
        ]),
      ],
      [
        'type' => 'execution',
        'name' => json_encode([
          'ar' => 'صور التنفيذ',
          'en' => 'Execution Images',
        ]),
      ],
      [
        'type' => 'drawings',
        'name' => json_encode([
          'ar' => 'صور المخططات',
          'en' => 'Drawings Images',
        ]),
      ],
    ]);
  }
}
