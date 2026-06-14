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
use Filament\Infolists\Components\IconEntry;

class ProjectInfolist
{
  public static function configure(Schema $schema): Schema
  {
    return $schema
      ->components([

        Section::make('تفاصيل المشروع')
          ->icon('heroicon-o-information-circle')
          ->schema([

            Grid::make(5)
              ->schema([

                TextEntry::make('name.ar')
                  ->label('الاسم (عربي)')
                  ->weight(FontWeight::Bold)
                  ->color('primary')
                  ->size(TextSize::Large),

                TextEntry::make('category.name.ar')
                  ->label('الصنف')
                  ->size(TextSize::Large)
                  ->badge()
                  ->color('success'),

                TextEntry::make('country.ar')
                  ->label('الدولة')
                  ->size(TextSize::Large)
                  ->icon('heroicon-m-globe-alt')
                  ->color('gray'),

                TextEntry::make('project_number')
                  ->label('رقم المشروع')
                  ->size(TextSize::Large)
                  ->copyable()
                  ->color('warning'),

                IconEntry::make('is_featured')
                  ->label('مشروع مميز؟')
                  ->boolean()
                  ->trueIcon('heroicon-s-star')
                  ->falseIcon('heroicon-o-x-circle')
                  ->trueColor('warning')
                  ->falseColor('gray'),

                TextEntry::make('likes_count')
                  ->label('عدد الاعجابات')
                  ->size(TextSize::Large),

              ]),

            Grid::make(1)
              ->schema([

                TextEntry::make('description.ar')
                  ->label('الوصف')
                  ->size(TextSize::Large)
                  ->prose(),

              ]),

          ])->columnSpanFull(),

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

          ])->columnSpanFull(),

        Section::make('الروابط والمنصات')
          ->icon('heroicon-o-link')
          ->schema([

            RepeatableEntry::make('projectLinks')
              ->label('')
              ->schema([

                Grid::make(3)
                  ->schema([

                    SpatieMediaLibraryImageEntry::make('linkType.media')
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

          ])->columnSpanFull(),

        Section::make('معرض ألبومات الصور للمشروع')
          ->icon('heroicon-o-photo')
          ->schema([

            RepeatableEntry::make('galleries')
              ->label('')
              ->schema([

                Grid::make(2)
                  ->schema([
                    TextEntry::make('section.name')
                      ->label('قسم الألبوم')
                      ->badge()
                      ->color('info')
                      ->getStateUsing(fn($record) => $record->section->name[app()->getLocale()] ?? $record->section->name['en'] ?? ''),

                    TextEntry::make('name')
                      ->label('اسم الألبوم')
                      ->weight(FontWeight::Bold)
                      ->getStateUsing(fn($record) => $record->name[app()->getLocale()] ?? $record->name['en'] ?? ''),
                  ]),

                Grid::make([
                  'default' => 2,
                  'sm' => 3,
                  'md' => 4,
                  'lg' => 6,
                ])
                  ->schema([
                    SpatieMediaLibraryImageEntry::make('photos')
                      ->hiddenLabel()
                      ->collection('photos')
                      ->size(120)
                      ->columnSpanFull(),
                  ]),
              ])

          ])->columnSpanFull(),

      ]);
  }
}
