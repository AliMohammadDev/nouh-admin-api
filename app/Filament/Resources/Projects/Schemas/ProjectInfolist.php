<?php

namespace App\Filament\Resources\Projects\Schemas;

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
                  ->weight(FontWeight::Bold)
                  ->color('primary')
                  ->size(TextSize::Large),

                TextEntry::make('category.name.ar')
                  ->label('الصنف')
                  ->badge(),

                TextEntry::make('project_number')
                  ->label('رقم المشروع')
                  ->copyable()
                  ->color('success'),
              ]),

            Grid::make(1)
              ->schema([
                TextEntry::make('description.ar')
                  ->label('الوصف')
                  ->prose(),
              ]),
          ]),

        Section::make('معرض الصور والروابط')
          ->schema([
            Grid::make(2)
              ->schema([
                SpatieMediaLibraryImageEntry::make('images')
                  ->label('صور المشروع')
                  ->collection('projects')
                  ->circular()
                  ->stacked()
                  ->limit(4),

                TextEntry::make('linkTypes.name.ar')
                  ->label('المنصات المتوفرة')
                  ->listWithLineBreaks()
                  ->bulleted(),
              ]),
          ]),
      ]);
  }
}
