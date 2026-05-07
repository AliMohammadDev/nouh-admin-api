<?php

namespace App\Filament\Resources\LinkTypes\Schemas;

use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class LinkTypeForm
{
  public static function configure(Schema $schema): Schema
  {
    return $schema
      ->components([
        Section::make('معلومات الروابط الأساسية')
          ->schema([
            Grid::make(2)
              ->schema([
                TextInput::make('name.ar')
                  ->label('اسم الرابط (بالعربية)')
                  ->required(),

                TextInput::make('name.en')
                  ->label('link Type Name (EN)')
                  ->required(),
              ]),

            Section::make('Media')
              ->schema([
                SpatieMediaLibraryFileUpload::make('image')
                  ->collection('link_types')
                  ->disk('public')
                  ->image()
                  ->multiple()
                  ->reorderable()
                  ->columnSpanFull(),
              ]),
          ])



      ])->columns(1);
  }
}
