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
        SpatieMediaLibraryImageColumn::make('projects')
          ->label('الصور')
          ->collection('projects')
          ->limit(4)
          ->stacked()
          ->circular(),

        SpatieMediaLibraryImageColumn::make('vr_images')
          ->label('VR')
          ->collection('vr_images')
          ->limit(4)
          ->stacked()
          ->circular(),

        TextColumn::make('name.ar')
          ->label('اسم المشروع')
          ->searchable()
          ->sortable(),


        TextColumn::make('project_number')
          ->label('رقم المشروع')
          ->searchable(),

        TextColumn::make('category.name.ar')
          ->label('الصنف')
          ->sortable()
          ->badge(),


        TextColumn::make('created_at')
          ->label('تاريخ الإنشاء')
          ->dateTime()
          ->sortable()
          ->toggleable(isToggledHiddenByDefault: true),
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
