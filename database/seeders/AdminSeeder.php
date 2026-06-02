<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use BezhanSalleh\FilamentShield\Support\Utils;

class AdminSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $admin = User::updateOrCreate(
      ['email' => 'admin@gmail.com'],
      [
        'name' => 'مهندس نوح',
        'password' => Hash::make('password'),
      ]
    );
    Role::firstOrCreate(['name' => 'user', 'guard_name' => 'web']);

    $superAdminRole = Role::firstOrCreate([
      'name' => Utils::getSuperAdminName(),
      'guard_name' => 'web'
    ]);

    $shieldPermissions = \Spatie\Permission\Models\Permission::all();
    if ($shieldPermissions->isNotEmpty()) {
      $superAdminRole->syncPermissions($shieldPermissions);
    }

    $admin->assignRole($superAdminRole);
  }
}
