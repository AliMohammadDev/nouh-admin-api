<?php

namespace App\Filament\Resources\ProjectSections;

use App\Filament\Resources\ProjectSections\Pages\CreateProjectSection;
use App\Filament\Resources\ProjectSections\Pages\EditProjectSection;
use App\Filament\Resources\ProjectSections\Pages\ListProjectSections;
use App\Filament\Resources\ProjectSections\Pages\ViewProjectSection;
use App\Filament\Resources\ProjectSections\Schemas\ProjectSectionForm;
use App\Filament\Resources\ProjectSections\Schemas\ProjectSectionInfolist;
use App\Filament\Resources\ProjectSections\Tables\ProjectSectionsTable;
use App\Models\ProjectSection;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class ProjectSectionResource extends Resource
{
  protected static ?string $model = ProjectSection::class;

  protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
  protected static ?string $navigationLabel = 'اقسام المشاريع';
  protected static ?string $pluralModelLabel = 'أقسام المشاريع';
  protected static ?string $modelLabel = 'قسم المشروع';
  protected static string|UnitEnum|null $navigationGroup = 'إدارة المشاريع';
  protected static ?int $navigationSort = 3;

  protected static ?string $recordTitleAttribute = 'ProjectSection';

  public static function form(Schema $schema): Schema
  {
    return ProjectSectionForm::configure($schema);
  }

  public static function infolist(Schema $schema): Schema
  {
    return ProjectSectionInfolist::configure($schema);
  }

  public static function table(Table $table): Table
  {
    return ProjectSectionsTable::configure($table);
  }

  public static function getRelations(): array
  {
    return [
      //
    ];
  }

  public static function getPages(): array
  {
    return [
      'index' => ListProjectSections::route('/'),
      'create' => CreateProjectSection::route('/create'),
      'view' => ViewProjectSection::route('/{record}'),
      'edit' => EditProjectSection::route('/{record}/edit'),
    ];
  }
}