<?php

namespace App\Filament\Resources\Projects\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Support\Enums\TextSize;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;


class ProjectsTable
{
  public static function configure(Table $table): Table
  {
    return $table
      ->columns([
        ImageColumn::make('project_images')
          ->label('معاينة الصور')
          ->state(function ($record) {
            return $record->galleries->flatMap(function ($gallery) {
              return $gallery->getMedia('photos')->map(fn($media) => $media->getUrl('default'));
            })->take(3)->toArray();
          })
          ->limit(3)
          ->stacked()
          ->circular(),

        TextColumn::make('name.ar')
          ->label('اسم المشروع')
          ->searchable()
          ->sortable(),


        TextColumn::make('project_number')
          ->label('رقم المشروع')
          ->size(TextSize::Large)
          ->sortable()
          ->searchable(),

        TextColumn::make('likes_count')
          ->label('عدد الاعجابات')
          ->size(TextSize::Large)
          ->sortable()
          ->searchable(),


        TextColumn::make('category.name.ar')
          ->label('الصنف')
          ->sortable()
          ->badge(),

        TextColumn::make('country.ar')
          ->label('الدولة')
          ->icon('heroicon-m-globe-alt')
          ->iconColor('gray')
          ->sortable()
          ->searchable(),

        ToggleColumn::make('is_featured')
          ->label('مميز')
          ->sortable()
          ->onIcon('heroicon-m-star')
          ->offIcon('heroicon-m-x-mark')
          ->onColor('warning'),

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
