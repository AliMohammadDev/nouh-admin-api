<?php

namespace App\Filament\Resources\ProjectSections\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ProjectSectionForm
{
  public static function configure(Schema $schema): Schema
  {
    return $schema
      ->components([
        Section::make('Project Section')
          ->schema([
            TextInput::make('type')
              ->required()
              ->maxLength(255)
              ->columnSpanFull(),

            Grid::make(2)
              ->schema([
                TextInput::make('name.ar')
                  ->label('الاسم (بالعربية)')
                  ->required(),

                TextInput::make('name.en')
                  ->label('Name (English)')
                  ->required(),
              ]),
          ])->columnSpanFull(),
      ]);
  }
}
