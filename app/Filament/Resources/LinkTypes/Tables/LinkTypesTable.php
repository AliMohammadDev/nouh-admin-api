<?php

namespace App\Filament\Resources\LinkTypes\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Support\Enums\TextSize;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;

class LinkTypesTable
{
  public static function configure(Table $table): Table
  {
    return $table
      ->columns([

        SpatieMediaLibraryImageColumn::make('image')
          ->collection('link_types')
          ->label('Icon')
          ->circular(),

        TextColumn::make('name.ar')
          ->size(TextSize::Large)
          ->searchable()
          ->sortable(),

        TextColumn::make('name.en')
          ->label('Name (EN)')
          ->size(TextSize::Large)
          ->searchable()
          ->sortable(),
        TextColumn::make('created_at')
          ->size(TextSize::Large)
          ->dateTime()
          ->sortable(),
      ])
      ->filters([
        //
      ])
      ->recordActions([
        ViewAction::make(),
        EditAction::make(),
        DeleteAction::make(),
      ])
      ->toolbarActions([
        BulkActionGroup::make([
          DeleteBulkAction::make(),
        ]),
      ]);
  }
}
