<?php

namespace App\Filament\Resources\Projects\Schemas;

use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
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
            Grid::make(2)
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
                  ->required()
                  ->unique(ignoreRecord: true),

                TextInput::make('name.ar')
                  ->label('اسم المشروع (بالعربية)')
                  ->required(),

                TextInput::make('name.en')
                  ->label('Project Name (EN)')
                  ->required(),
              ]),

            // إضافة الـ Tags هنا (لأن علاقتك Many-to-Many)
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
        Section::make('معرض الصور')
          ->schema([
            SpatieMediaLibraryFileUpload::make('image')
              ->label('صور المشروع')
              ->collection('projects')
              ->disk('public')
              ->multiple()
              ->reorderable()
              ->image()
              ->columnSpanFull(),
          ]),
      ])->columns(1);
  }
}
