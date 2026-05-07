<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Container\Attributes\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  use WithoutModelEvents;

  /**
   * Seed the application's database.
   */
  public function run(): void
  {
    $this->call([
      AdminSeeder::class,
      MajorSeeder::class,
      CategorySeeder::class,

      TagSeeder::class,
      LinkTypeSeeder::class,
    ]);
  }
}
