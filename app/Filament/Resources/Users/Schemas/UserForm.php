<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Hash;

class UserForm
{
  public static function configure(Schema $schema): Schema
  {
    return $schema
      ->components([
        Section::make('بيانات الحساب الشخصية')
          ->schema([
            Grid::make(2)
              ->schema([
                TextInput::make('name')
                  ->label('الاسم الكامل')
                  ->required()
                  ->maxLength(255),

                TextInput::make('email')
                  ->label('البريد الإلكتروني')
                  ->email()
                  ->required()
                  ->unique(ignoreRecord: true)
                  ->maxLength(255),

                Select::make('roles')
                  ->label('الصلاحية / الدور')
                  ->relationship(
                    name: 'roles',
                    titleAttribute: 'name'
                  )
                  ->multiple()
                  ->preload()
                  ->searchable()
                  ->required(),

                TextInput::make('password')
                  ->label('كلمة المرور')
                  ->password()
                  ->required(fn($livewire) => $livewire instanceof \Filament\Resources\Pages\CreateRecord)
                  ->maxLength(255)
                  ->dehydrateStateUsing(fn($state) => filled($state) ? Hash::make($state) : null)
                  ->dehydrated(fn($state) => filled($state)),
              ]),
          ]),
      ])->columns(1);
  }
}
