<?php

namespace App\Filament\Resources\LinkTypes;

use App\Filament\Resources\LinkTypes\Pages\CreateLinkType;
use App\Filament\Resources\LinkTypes\Pages\EditLinkType;
use App\Filament\Resources\LinkTypes\Pages\ListLinkTypes;
use App\Filament\Resources\LinkTypes\Pages\ViewLinkType;
use App\Filament\Resources\LinkTypes\Schemas\LinkTypeForm;
use App\Filament\Resources\LinkTypes\Schemas\LinkTypeInfolist;
use App\Filament\Resources\LinkTypes\Tables\LinkTypesTable;
use App\Models\LinkType;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;


class LinkTypeResource extends Resource
{
  protected static ?string $model = LinkType::class;


  protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-link';
  protected static ?string $navigationLabel = 'أنواع الروابط';
  protected static ?string $pluralModelLabel = 'أنواع الروابط';
  protected static ?string $modelLabel = 'نوع رابط';

  protected static string|UnitEnum|null $navigationGroup = 'إدارة الروابط';
  protected static ?int $navigationSort = 3;


  public static function form(Schema $schema): Schema
  {
    return LinkTypeForm::configure($schema);
  }

  public static function infolist(Schema $schema): Schema
  {
    return LinkTypeInfolist::configure($schema);
  }

  public static function table(Table $table): Table
  {
    return LinkTypesTable::configure($table);
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
      'index' => ListLinkTypes::route('/'),
      'create' => CreateLinkType::route('/create'),
      'view' => ViewLinkType::route('/{record}'),
      'edit' => EditLinkType::route('/{record}/edit'),
    ];
  }
}
