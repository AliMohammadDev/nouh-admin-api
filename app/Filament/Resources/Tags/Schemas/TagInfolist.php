<?php

namespace App\Filament\Resources\Tags\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Enums\TextSize;

class TagInfolist
{
  public static function configure(Schema $schema): Schema
  {
    return $schema
      ->components([
        Section::make('معلومات التاغ الأساسية')
          ->icon('heroicon-o-information-circle')
          ->schema([
            Grid::make(2)
              ->schema([
                TextEntry::make('name.ar')
                  ->label('الاسم (العربية)')
                  ->color('primary')
                  ->size(TextSize::Large),

                TextEntry::make('name.en')
                  ->label('Name (English)')
                  ->size(TextSize::Large),

                TextEntry::make('created_at')
                  ->label('تاريخ الإضافة')
                  ->dateTime()
                  ->color('success')
                  ->size(TextSize::Large),
              ]),
          ]),
      ])->columns(1);
  }
}
