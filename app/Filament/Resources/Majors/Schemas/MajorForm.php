<?php

namespace App\Filament\Resources\Majors\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;

class MajorForm
{
  public static function configure(Schema $schema): Schema
  {
    return $schema
      ->components([
        Section::make('معلومات القسم الأساسية')
          ->schema([
            Grid::make(2)
              ->schema([
                TextInput::make('name.ar')
                  ->label('اسم القسم (بالعربية)')
                  ->required(),

                TextInput::make('name.en')
                  ->label('Category Name (EN)')
                  ->required(),
              ]),

            Textarea::make('description.ar')
              ->label('وصف القسم (بالعربية)')
              ->columnSpanFull(),

            Textarea::make('description.en')
              ->label('Category Description (EN)')
              ->columnSpanFull(),
          ])

      ])->columns(1);
  }
}