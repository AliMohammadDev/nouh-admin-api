<?php

namespace App\Filament\Resources\LinkTypes\Schemas;

use Filament\Infolists\Components\SpatieMediaLibraryImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Enums\TextSize;

class LinkTypeInfolist
{
  public static function configure(Schema $schema): Schema
  {
    return $schema
      ->components([
        Section::make('معلومات الروابط الأساسية')
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

        Section::make('صور القسم')
          ->icon('heroicon-o-photo')
          ->schema([
            SpatieMediaLibraryImageEntry::make('image')
              ->collection('link_types')
              ->hiddenLabel()
              ->circular()
              ->stacked()
              ->limit(5)
              ->columnSpanFull()
              ->extraImgAttributes([
                'alt' => 'صورة القسم',
                'class' => 'shadow-lg object-cover mx-auto',
                'style' => 'width: 100px; height: 100px;',
              ]),
          ]),
      ])->columns(1);
  }
}
