<?php

namespace App\Filament\Resources\Projects\Schemas;

use App\Models\ProjectSection;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;



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





        // معرض الصور

        // Section::make('معرض الصور والألبومات')
        //   ->description('يمكنك إضافة عدة ألبومات وتوزيعها حسب أقسام المشروع (تصميم، تنفيذ، VR)')
        //   ->schema([
        //     Repeater::make('galleries')
        //       ->relationship('galleries') // يربط التكرار بعلاقة الألبومات في المشروع
        //       ->label('الألبومات')
        //       ->schema([
        //         Grid::make(3)
        //           ->schema([
        //             Select::make('project_section_id')
        //               ->label('قسم الصور')
        //               ->options(fn() => \App\Models\ProjectSection::all()->pluck('name', 'id')->map(fn($name) => $name[app()->getLocale()] ?? $name['en'] ?? ''))
        //               ->required()
        //               ->preload(),

        //             TextInput::make('name.ar')
        //               ->label('اسم الألبوم (بالعربية)')
        //               ->placeholder('مثال: غرف النوم')
        //               ->required(),

        //             TextInput::make('name.en')
        //               ->label('Album Name (EN)')
        //               ->placeholder('e.g., Bedrooms')
        //               ->required(),
        //           ]),

        //         // حقل رفع الصور المتعددة التابع لـ Spatie Media Library داخل الألبوم
        //         SpatieMediaLibraryFileUpload::make('photos')
        //           ->label('صور الألبوم')
        //           ->collection('photos') // هامة جداً ليرتبط بالموديل الصحيح داخل الريبيتر
        //           ->multiple()
        //           ->required(),
        //       ])
        //       ->createItemButtonLabel('إضافة ألبوم جديد')
        //       ->columns(1)
        //       ->grid(1) // لجعل كل ألبوم يظهر كبطاقة منفصلة مريحة للعين
        //   ]),



        Tabs::make('معرض ألبومات الصور للمشروع')
          ->tabs([
            Tabs\Tab::make('تصميم')
              ->icon('heroicon-o-pencil-square')
              ->schema([
                Repeater::make('design_galleries')
                  ->relationship(
                    name: 'galleries',
                    modifyQueryUsing: fn($query) => $query->where('project_section_id', 1)
                  )
                  ->label('ألبومات التصميم')
                  ->schema([
                    Grid::make(2)
                      ->schema([
                        TextInput::make('name.ar')
                          ->label('اسم الألبوم (بالعربية)')
                          ->placeholder('مثال: غرف النوم')
                          ->required(),

                        TextInput::make('name.en')
                          ->label('Album Name (EN)')
                          ->placeholder('e.g., Bedrooms')
                          ->required(),
                      ]),

                    SpatieMediaLibraryFileUpload::make('photos')
                      ->label('صور الألبوم')
                      ->collection('photos')
                      ->multiple()
                      ->required(),
                  ])
                  ->mutateRelationshipDataBeforeCreateUsing(function (array $data): array {
                    $data['project_section_id'] = 1;
                    return $data;
                  })
                  ->createItemButtonLabel('إضافة ألبوم تصميم جديد')
                  ->grid(1)
              ]),

            // ----------------------------------------------------
            // 2. تبويب صور VR / 360
            // ----------------------------------------------------
            Tabs\Tab::make('صور 360 VR')
              ->icon('heroicon-o-eye')
              ->schema([
                Repeater::make('vr_galleries')
                  ->relationship(
                    name: 'galleries',
                    modifyQueryUsing: fn($query) => $query->where('project_section_id', 2)
                  )
                  ->label('ألبومات 360 VR')
                  ->schema([
                    Grid::make(2)
                      ->schema([
                        TextInput::make('name.ar')
                          ->label('اسم الألبوم (بالعربية)')
                          ->placeholder('مثال: صالون VR')
                          ->required(),

                        TextInput::make('name.en')
                          ->label('Album Name (EN)')
                          ->placeholder('e.g., Living Room VR')
                          ->required(),
                      ]),

                    SpatieMediaLibraryFileUpload::make('photos')
                      ->label('صور الألبوم')
                      ->collection('photos')
                      ->multiple()
                      ->required(),
                  ])
                  ->mutateRelationshipDataBeforeCreateUsing(function (array $data): array {
                    $data['project_section_id'] = 2;
                    return $data;
                  })
                  ->createItemButtonLabel('إضافة ألبوم VR جديد')
                  ->grid(1)
              ]),

            // ----------------------------------------------------
            // 3. تبويب صور التنفيذ
            // ----------------------------------------------------
            Tabs\Tab::make('التنفيذ الواقعي')
              ->icon('heroicon-o-briefcase')
              ->schema([
                Repeater::make('execution_galleries')
                  ->relationship(
                    name: 'galleries',
                    modifyQueryUsing: fn($query) => $query->where('project_section_id', 3)
                  )
                  ->label('ألبومات التنفيذ على أرض الواقع')
                  ->schema([
                    Grid::make(2)
                      ->schema([
                        TextInput::make('name.ar')
                          ->label('اسم الألبوم (بالعربية)')
                          ->placeholder('مثال: الصور النهائية بعد الفرش')
                          ->required(),

                        TextInput::make('name.en')
                          ->label('Album Name (EN)')
                          ->placeholder('e.g., Final Execution')
                          ->required(),
                      ]),

                    SpatieMediaLibraryFileUpload::make('photos')
                      ->label('صور الألبوم')
                      ->collection('photos')
                      ->multiple()
                      ->required(),
                  ])
                  ->mutateRelationshipDataBeforeCreateUsing(function (array $data): array {
                    $data['project_section_id'] = 3;
                    return $data;
                  })
                  ->createItemButtonLabel('إضافة ألبوم تنفيذ جديد')
                  ->grid(1)
              ]),

          ])->columnSpanFull(),


      ])->columns(1);
  }
}
