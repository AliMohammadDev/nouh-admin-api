<?php

namespace App\Filament\Resources\Categories\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class CategoryForm
{
  public static function configure(Schema $schema): Schema
  {
    return $schema
      ->components([
        Section::make('معلومات الصنف الأساسية')
          ->schema([
            Select::make('major_id')
              ->label('القسم')
              ->relationship('major', 'name->ar')
              ->required()
              ->searchable()
              ->preload()
              ->columnSpanFull(),

            Grid::make(2)
              ->schema([
                TextInput::make('name.ar')
                  ->label('اسم الصنف (بالعربية)')
                  ->required(),

                TextInput::make('name.en')
                  ->label('Category Name (EN)')
                  ->required(),
              ]),

            Textarea::make('description.ar')
              ->label('وصف الصنف (بالعربية)')
              ->columnSpanFull(),

            Textarea::make('description.en')
              ->label('Category Description (EN)')
              ->columnSpanFull(),
          ])

      ])->columns(1);
  }
}
