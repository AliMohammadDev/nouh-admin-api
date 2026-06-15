<?php

namespace App\Filament\Resources\ProjectSections\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Support\Enums\TextSize;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ProjectSectionsTable
{
  public static function configure(Table $table): Table
  {
    return $table
      ->columns([
        TextColumn::make('name.ar')
          ->size(TextSize::Large)
          ->searchable()
          ->sortable(),
        TextColumn::make('name.en')
          ->label('Name (EN)')
          ->size(TextSize::Large)
          ->searchable()
          ->sortable(),

        BadgeColumn::make('type')
          ->label('نوع القسم')
          ->size(TextSize::Large)
          ->colors([
            'primary',
            'success' => 'main',
            'danger' => 'secondary',
          ])
          ->searchable(),

        TextColumn::make('galleries_count')
          ->counts('galleries')
          ->label('Galleries'),
      ])
      ->filters([
        //
      ])
      ->recordActions([
        ViewAction::make(),
        EditAction::make(),
      ])
      ->toolbarActions([
        BulkActionGroup::make([
          DeleteBulkAction::make(),
        ]),
      ]);
  }
}
