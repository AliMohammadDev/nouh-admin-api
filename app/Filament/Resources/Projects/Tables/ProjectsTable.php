<?php

namespace App\Filament\Resources\Projects\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;


class ProjectsTable
{
  public static function configure(Table $table): Table
  {
    return $table
      ->columns([
        SpatieMediaLibraryImageColumn::make('image')
          ->label('الصورة')
          ->collection('projects')
          ->limit(1)
          ->circular(),

        TextColumn::make('name.ar')
          ->label('اسم المشروع')
          ->searchable()
          ->sortable(),

        TextColumn::make('category.name.ar')
          ->label('الصنف')
          ->sortable()
          ->badge(),

        TextColumn::make('project_number')
          ->label('رقم المشروع')
          ->searchable(),

        TextColumn::make('created_at')
          ->label('تاريخ الإنشاء')
          ->dateTime()
          ->sortable()
          ->toggleable(isToggledHiddenByDefault: true),
      ])
      ->filters([
        // يمكنك إضافة فلتر حسب الصنف هنا لاحقاً
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
      ])
      ->defaultSort('created_at', 'desc');
  }
}
