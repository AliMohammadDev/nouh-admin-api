<?php

namespace App\Filament\Resources\ProjectSections\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Repeater;
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
              ->maxLength(255),

            Repeater::make('name')
              ->label('Name (translations)')
              ->schema([
                TextInput::make('en')
                  ->label('English')
                  ->required(),

                TextInput::make('ar')
                  ->label('Arabic'),
              ])
              ->columns(2)
              ->defaultItems(1),
          ]),
      ]);
  }
}
