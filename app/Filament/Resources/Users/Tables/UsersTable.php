<?php

namespace App\Filament\Resources\Users\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Table;
use Filament\Actions\DeleteAction;
use Filament\Support\Enums\TextSize;
use Filament\Tables\Columns\TextColumn;

class UsersTable
{
  public static function configure(Table $table): Table
  {
    return $table
      ->columns([
        TextColumn::make('id')
          ->label('ID')
          ->sortable(),

        TextColumn::make('name')
          ->label('الاسم الكامل')
          ->searchable()
          ->sortable(),

        TextColumn::make('email')
          ->label('البريد الإلكتروني')
          ->searchable()
          ->sortable(),

        TextColumn::make('roles.name')
          ->label('الأدوار / الصلاحية')
          ->badge()
          ->size(TextSize::Large)
          ->color(fn(string $state): string => match ($state) {
            'super_admin' => 'danger',
            default => 'primary',
          })
          ->searchable(),

        TextColumn::make('created_at')
          ->label('تاريخ الإنشاء')
          ->dateTime()
          ->sortable(),
      ])
      ->filters([])
      ->recordActions([
        ViewAction::make(),
        EditAction::make(),
        DeleteAction::make(),
      ])
      ->toolbarActions([
        BulkActionGroup::make([
          DeleteBulkAction::make(),
        ]),
      ])
      ->defaultSort('created_at', 'desc');
  }
}
