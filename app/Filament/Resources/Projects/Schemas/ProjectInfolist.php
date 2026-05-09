<?php

namespace App\Filament\Resources\Projects\Schemas;

use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\SpatieMediaLibraryImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Enums\FontWeight;
use Filament\Support\Enums\TextSize;
use Filament\Tables\Grouping\Group;

class ProjectInfolist
{
  public static function configure(Schema $schema): Schema
  {
    return $schema
      ->components([

        Section::make('تفاصيل المشروع')
          ->icon('heroicon-o-information-circle')
          ->schema([

            Grid::make(3)
              ->schema([

                TextEntry::make('name.ar')
                  ->label('الاسم (عربي)')
                  ->size(TextSize::Large)
                  ->weight(FontWeight::Bold)
                  ->color('primary')
                  ->size(TextSize::Large),

                TextEntry::make('category.name.ar')
                  ->label('الصنف')
                  ->size(TextSize::Large)
                  ->badge()
                  ->color('success'),

                TextEntry::make('project_number')
                  ->label('رقم المشروع')
                  ->size(TextSize::Large)
                  ->copyable()
                  ->color('warning'),

              ]),

            Grid::make(1)
              ->schema([

                TextEntry::make('description.ar')
                  ->label('الوصف')
                  ->size(TextSize::Large)
                  ->prose(),

              ]),

          ]),
        Section::make('التاغات')
          ->icon('heroicon-o-tag')
          ->schema([

            TextEntry::make('tags')
              ->label('التاغات')
              ->badge()
              ->size(TextSize::Large)
              ->wrap()
              ->getStateUsing(function ($record) {
                return $record->tags
                  ->map(fn($tag) => $tag->name['ar'] ?? $tag->name['en'])
                  ->toArray();
              }),

          ]),


        Section::make('الروابط والمنصات')
          ->icon('heroicon-o-link')
          ->schema([

            RepeatableEntry::make('projectLinks')
              ->label('')
              ->schema([

                Grid::make(2)
                  ->schema([

                    SpatieMediaLibraryImageEntry::make('linkType.image')
                      ->label('الأيقونة')
                      ->collection('link_types')
                      ->circular()
                      ->size(40),

                    TextEntry::make('linkType.name.ar')
                      ->label('المنصة')
                      ->badge()
                      ->size(TextSize::Large)
                      ->color('primary'),

                    TextEntry::make('url')
                      ->label('الرابط')
                      ->url(fn($state) => $state)
                      ->openUrlInNewTab()
                      ->size(TextSize::Large)
                      ->copyable()
                      ->color('success'),

                  ]),

              ]),

          ]),
        Section::make('معرض الصور')
          ->icon('heroicon-o-photo')
          ->schema([

            SpatieMediaLibraryImageEntry::make('images')
              ->label('')
              ->collection('projects')
              ->circular()
              ->stacked()
              ->limit(5),

          ]),

      ]);
  }
}
