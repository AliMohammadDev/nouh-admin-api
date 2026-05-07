<?php

namespace App\Filament\Resources\Tags\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class TagForm
{
  public static function configure(Schema $schema): Schema
  {
    return $schema
      ->components([
        Section::make('معلومات التاغات الأساسية')
          ->schema([
            Grid::make(2)
              ->schema([
                TextInput::make('name.ar')
                  ->label('اسم التاغ (بالعربية)')
                  ->required(),

                TextInput::make('name.en')
                  ->label('link Type Name (EN)')
                  ->required(),
              ]),
          ])

      ])->columns(1);
  }
}
