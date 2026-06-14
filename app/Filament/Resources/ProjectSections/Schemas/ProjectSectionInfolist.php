<?php

namespace App\Filament\Resources\ProjectSections\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Enums\TextSize;

class ProjectSectionInfolist
{
  public static function configure(Schema $schema): Schema
  {
    return $schema
      ->components([
        Grid::make(2)
          ->schema([
            Group::make()
              ->schema([
                Section::make('معلومات قسم المشروع')
                  ->icon('heroicon-o-rectangle-stack')
                  ->schema([
                    Grid::make(2)
                      ->schema([
                        TextEntry::make('type')
                          ->label('نوع القسم')
                          ->weight('bold')
                          ->color('primary')
                          ->size(TextSize::Large),
                      ]),

                    Grid::make(2)
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
                      ->schema([
                        TextEntry::make('galleries_count')
                          ->label('عدد المعرض')
                          ->weight('bold')
                          ->color('success')
                          ->size(TextSize::Large)
                          ->state(fn($record) => $record->galleries()->count()),
                      ]),
                  ]),
              ])
              ->columnSpanFull(),
          ])->columnSpanFull(),
      ]);
  }
}
