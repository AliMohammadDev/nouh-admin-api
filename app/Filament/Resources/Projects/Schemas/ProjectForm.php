<?php

namespace App\Filament\Resources\Projects\Schemas;

use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Toggle;

class ProjectForm
{
  public static function configure(Schema $schema): Schema
  {
    return $schema
      ->components([
        Section::make('معلومات المشروع الأساسية')
          ->schema([
            Grid::make(3)
              ->schema([

                Select::make('category_id')
                  ->label('الصنف')
                  ->relationship(
                    name: 'category',
                    titleAttribute: 'name',
                    modifyQueryUsing: fn($query) => $query->select('id', 'name')
                  )
                  ->getOptionLabelFromRecordUsing(fn($record) => $record->name['ar'] ?? $record->name['en'])
                  ->required()
                  ->searchable()
                  ->preload(),

                TextInput::make('project_number')
                  ->label('رقم المشروع')
                  ->required(),

                Toggle::make('is_featured')
                  ->label('مشروع مميز؟')
                  ->inline(false)
                  ->onIcon('heroicon-m-star')
                  ->offIcon('heroicon-m-x-mark')
                  ->onColor('warning')
                  ->default(false),


                TextInput::make('name.ar')
                  ->label('اسم المشروع (بالعربية)')
                  ->required(),

                TextInput::make('name.en')
                  ->label('Project Name (EN)')
                  ->required(),
              ]),


            Grid::make(2)
              ->schema([
                TextInput::make('country.ar')
                  ->label('الدولة (بالعربية)')
                  ->required(),

                TextInput::make('country.en')
                  ->label('Country (EN)')
                  ->required(),
              ]),

            Select::make('tags')
              ->label('الوسوم')
              ->relationship(
                name: 'tags',
                titleAttribute: 'name'
              )
              ->getOptionLabelFromRecordUsing(fn($record) => $record->name['ar'] ?? $record->name['en'])
              ->multiple()
              ->preload(),

            Textarea::make('description.ar')
              ->label('وصف المشروع (بالعربية)')
              ->rows(3)
              ->columnSpanFull(),

            Textarea::make('description.en')
              ->label('Project Description (EN)')
              ->rows(3)
              ->columnSpanFull(),
          ]),

        Section::make('روابط المشروع')
          ->schema([
            Repeater::make('projectLinks')
              ->relationship()
              ->schema([

                Select::make('link_type_id')
                  ->label('نوع المنصة')
                  ->relationship(
                    name: 'linkType',
                    titleAttribute: 'name'
                  )
                  ->getOptionLabelFromRecordUsing(
                    fn($record) => $record->name['ar'] ?? $record->name['en']
                  )
                  ->required()
                  ->searchable()
                  ->preload(),

                TextInput::make('url')
                  ->label('الرابط')
                  ->url()
                  ->required(),

              ])
              ->columns(2)
              ->reorderable(false),
          ]),





        Tabs::make('معرض الصور')
          ->columnSpanFull()
          ->tabs([

            Tabs\Tab::make('الصور التصميمية')
              ->icon('heroicon-m-paint-brush')
              ->schema([
                Repeater::make('design_sub_collections')
                  ->label('أقسام التصميم')
                  ->schema([
                    Grid::make(2)->schema([
                      TextInput::make('sub_collection_ar')
                        ->label('اسم القسم (عربي)')
                        ->required(),

                      TextInput::make('sub_collection_en')
                        ->label('Name (EN)')
                        ->required(),
                    ]),

                    SpatieMediaLibraryFileUpload::make('images')
                      ->label('صور القسم')
                      ->collection('design_images')
                      ->multiple()
                      ->reorderable()
                      ->image()
                      ->dehydrated(false)
                      ->filterMediaUsing(function ($component, $get) {
                        return $component->getRecord()?->getMedia('design_images')
                          ->filter(fn($media) => $media->getCustomProperty('section_ar') === $get('sub_collection_ar'));
                      })
                      ->customProperties(fn($get) => [
                        'section_ar' => $get('sub_collection_ar'),
                        'section_en' => $get('sub_collection_en'),
                      ]),
                  ])
              ]),

            Tabs\Tab::make('صور VR')
              ->icon('heroicon-m-cube')
              ->schema([
                Repeater::make('vr_sub_collections')
                  ->label('أقسام VR')
                  ->schema([
                    Grid::make(2)->schema([
                      TextInput::make('sub_collection_ar')
                        ->label('اسم القسم (عربي)')
                        ->required(),

                      TextInput::make('sub_collection_en')
                        ->label('Name (EN)')
                        ->required(),
                    ]),

                    SpatieMediaLibraryFileUpload::make('images')
                      ->label('صور VR')
                      ->collection('vr_images')
                      ->multiple()
                      ->reorderable()
                      ->image()
                      ->dehydrated(false)
                      ->filterMediaUsing(function ($component, $get) {
                        return $component->getRecord()?->getMedia('vr_images')
                          ->filter(fn($media) => $media->getCustomProperty('section_ar') === $get('sub_collection_ar'));
                      })
                      ->customProperties(fn($get) => [
                        'section_ar' => $get('sub_collection_ar'),
                        'section_en' => $get('sub_collection_en'),
                      ]),
                  ])
              ]),

            Tabs\Tab::make('الصور التنفيذية')
              ->icon('heroicon-m-camera')
              ->schema([
                Repeater::make('real_sub_collections')
                  ->label('أقسام التنفيذ')
                  ->schema([
                    Grid::make(2)->schema([
                      TextInput::make('sub_collection_ar')
                        ->label('اسم القسم (عربي)')
                        ->required(),

                      TextInput::make('sub_collection_en')
                        ->label('Name (EN)')
                        ->required(),
                    ]),

                    SpatieMediaLibraryFileUpload::make('images')
                      ->label('صور التنفيذ')
                      ->collection('real_images')
                      ->multiple()
                      ->reorderable()
                      ->image()
                      ->dehydrated(false)
                      ->filterMediaUsing(function ($component, $get) {
                        return $component->getRecord()?->getMedia('real_images')
                          ->filter(fn($media) => $media->getCustomProperty('section_ar') === $get('sub_collection_ar'));
                      })
                      ->customProperties(fn($get) => [
                        'section_ar' => $get('sub_collection_ar'),
                        'section_en' => $get('sub_collection_en'),
                      ]),
                  ])
              ]),

          ]),

      ])->columns(1);
  }
}
