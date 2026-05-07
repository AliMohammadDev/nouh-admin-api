<?php

namespace App\Filament\Resources\Projects\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Enums\TextSize;
use Filament\Tables\Grouping\Group;

class ProjectInfolist
{
  public static function configure(Schema $schema): Schema
  {
    return $schema
      ->components([
        Grid::make(2)
          ->schema([
            Group::make()
              ->schema([
                Section::make('معلومات المشروع الأساسية')
                  ->icon('heroicon-o-information-circle')
                  ->schema([
                    Grid::make(2)
                      // name
                      ->schema([
                        TextEntry::make('name.ar')
                          ->label('الاسم (العربية)')
                          ->weight('bold')
                          ->color('primary')
                          ->size(TextSize::Large),

                        TextEntry::make('name.en')
                          ->label('Name (English)')
                          ->weight('bold')
                          ->size(TextSize::Large),
                      ]),

                    Grid::make(1)
                      // description
                      ->schema([
                        TextEntry::make('description.ar')
                          ->label('المشروع بالعربية')
                          ->color('primary')
                          ->placeholder('لا يوجد مشروع متاح باللغة العربية.')
                          ->size(TextSize::Large),

                        TextEntry::make('description.en')
                          ->label('Description (EN)')
                          ->placeholder('No English description available.')
                          ->size(TextSize::Large),
                      ]),
                  ]),
              ])->columnSpan(2),
          ]),

      ]);
  }
}
