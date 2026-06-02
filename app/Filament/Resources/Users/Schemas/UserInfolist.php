<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Enums\FontWeight;
use Filament\Support\Enums\TextSize;

class UserInfolist
{
  public static function configure(Schema $schema): Schema
  {
    return $schema
      ->components([
        Section::make('معلومات المستخدم')
          ->icon('heroicon-o-user')
          ->schema([
            Grid::make(4)
              ->schema([
                TextEntry::make('name')
                  ->label('الاسم كامل')
                  ->size(TextSize::Large)
                  ->weight(FontWeight::Bold)
                  ->color('primary'),

                TextEntry::make('email')
                  ->label('البريد الإلكتروني')
                  ->size(TextSize::Large)
                  ->copyable()
                  ->color('warning'),

                TextEntry::make('roles.name')
                  ->label('الصلاحية / الدور')
                  ->size(TextSize::Large)
                  ->badge()
                  ->color(fn(string $state): string => match ($state) {
                    'super_admin' => 'danger',
                    default => 'primary',
                  })

                  ->formatStateUsing(fn(string $state): string => match ($state) {
                    'super_admin' => 'مدير نظام رئيسي',
                    'panel_user' => 'مستخدم لوحة التحكم',
                    default => $state,
                  }),

                TextEntry::make('created_at')
                  ->label('تاريخ التسجيل')
                  ->dateTime()
                  ->size(TextSize::Large)
                  ->color('success'),
              ]),
          ]),
      ]);
  }
}
