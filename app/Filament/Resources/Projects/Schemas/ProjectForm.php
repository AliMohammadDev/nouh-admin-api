<?php

namespace App\Filament\Resources\Projects\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ProjectForm
{
  public static function configure(Schema $schema): Schema
  {
    return $schema
      ->components([
        Section::make('معلومات المشروع الأساسية')
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
                  ->label('اسم المشروع (بالعربية)')
                  ->required(),

                TextInput::make('name.en')
                  ->label('Category Name (EN)')
                  ->required(),
              ]),

            Textarea::make('body.ar')
              ->label('وصف المشروع (بالعربية)')
              ->columnSpanFull(),

            Textarea::make('body.en')
              ->label('Category Description (EN)')
              ->columnSpanFull(),
          ])

      ])->columns(1);
  }
}
