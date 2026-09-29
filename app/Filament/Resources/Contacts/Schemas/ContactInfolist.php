<?php

namespace App\Filament\Resources\Contacts\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Enums\TextSize;

class ContactInfolist
{
  public static function configure(Schema $schema): Schema
  {
    return $schema
      ->components([
        Section::make('معلومات التواصل الأساسية')
          ->icon('heroicon-o-information-circle')
          ->schema([
            Grid::make(2)
              ->schema([
                TextEntry::make('name')
                  ->label('الاسم')
                  ->color('primary')
                  ->size(TextSize::Large),

                TextEntry::make('email')
                  ->label('البريد الإلكتروني')
                  ->size(TextSize::Large),

                TextEntry::make('phone_number')
                  ->label('رقم الهاتف')
                  ->size(TextSize::Large),

                TextEntry::make('created_at')
                  ->label('تاريخ الإضافة')
                  ->dateTime()
                  ->color('success')
                  ->size(TextSize::Large),
              ]),
          ]),

        Section::make('محتوى الرسالة')
          ->icon('heroicon-o-chat-bubble-left-right')
          ->schema([
            TextEntry::make('description')
              ->label('الرسالة')
              ->columnSpanFull(),
          ]),

        Section::make('معلومات التحديث')
          ->icon('heroicon-o-clock')
          ->schema([
            TextEntry::make('updated_at')
              ->label('آخر تحديث')
              ->dateTime()
              ->placeholder('-')
              ->size(TextSize::Large),
          ]),
      ])
      ->columns(1);
  }
}
