<?php

namespace App\Filament\Resources\Majors;

use App\Filament\Resources\Majors\Pages\CreateMajor;
use App\Filament\Resources\Majors\Pages\EditMajor;
use App\Filament\Resources\Majors\Pages\ListMajors;
use App\Filament\Resources\Majors\Pages\ViewMajor;
use App\Filament\Resources\Majors\Schemas\MajorForm;
use App\Filament\Resources\Majors\Schemas\MajorInfolist;
use App\Filament\Resources\Majors\Tables\MajorsTable;
use App\Models\Major;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use UnitEnum;


class MajorResource extends Resource
{
  protected static ?string $model = Major::class;
  protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-rectangle-stack';
  protected static ?string $navigationLabel = 'الأقسام';
  protected static ?string $pluralModelLabel = 'الأقسام';
  protected static ?string $modelLabel = 'قسم';
  protected static string|UnitEnum|null $navigationGroup = 'إدارة المشاريع';
  protected static ?int $navigationSort = 1;
  // protected static ?string $recordTitleAttribute = 'name';


  public static function form(Schema $schema): Schema
  {
    return MajorForm::configure($schema);
  }

  public static function infolist(Schema $schema): Schema
  {
    return MajorInfolist::configure($schema);
  }

  public static function table(Table $table): Table
  {
    return MajorsTable::configure($table);
  }

  public static function getRelations(): array
  {
    return [
      //
    ];
  }
  public static function getRecordTitle(?\Illuminate\Database\Eloquent\Model $record): string|null
  {
    return $record?->name['ar'] ?? $record?->name['en'];
  }

  public static function getPages(): array
  {
    return [
      'index' => ListMajors::route('/'),
      'create' => CreateMajor::route('/create'),
      'view' => ViewMajor::route('/{record}'),
      'edit' => EditMajor::route('/{record}/edit'),
    ];
  }
}
