<?php

namespace App\Filament\Resources\Users;

use App\Filament\Resources\Users\Pages\CreateUser;
use App\Filament\Resources\Users\Pages\EditUser;
use App\Filament\Resources\Users\Pages\ListUsers;
use App\Filament\Resources\Users\Pages\ViewUser;
use App\Filament\Resources\Users\Schemas\UserForm;
use App\Filament\Resources\Users\Schemas\UserInfolist;
use App\Filament\Resources\Users\Tables\UsersTable;
use App\Models\User;
use BackedEnum;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use UnitEnum;


class UserResource extends Resource
{
  use HasPageShield;
  protected static ?string $model = User::class;
  protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-users';
  protected static ?string $recordTitleAttribute = 'User';
  protected static ?string $navigationLabel = 'المستخدمين';
  protected static ?string $modelLabel = 'مستخدم';
  protected static ?string $pluralModelLabel = 'المستخدمين';
  protected static string|UnitEnum|null $navigationGroup = 'إدارة الحسابات';



  public static function form(Schema $schema): Schema
  {
    return UserForm::configure($schema);
  }

  public static function infolist(Schema $schema): Schema
  {
    return UserInfolist::configure($schema);
  }

  public static function table(Table $table): Table
  {
    return UsersTable::configure($table);
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
      'index' => ListUsers::route('/'),
      'create' => CreateUser::route('/create'),
      'view' => ViewUser::route('/{record}'),
      'edit' => EditUser::route('/{record}/edit'),
    ];
  }
}
