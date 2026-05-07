<?php

namespace App\Filament\Resources\LinkTypes\Pages;

use App\Filament\Resources\LinkTypes\LinkTypeResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Actions;


class CreateLinkType extends CreateRecord
{
  protected static string $resource = LinkTypeResource::class;
  protected function getHeaderActions(): array
  {
    return [
      Actions\Action::make('back')
        ->label('رجوع')
        ->color('gray')
        ->url($this->getResource()::getUrl('index')),
    ];
  }

  protected function getRedirectUrl(): string
  {
    return $this->getResource()::getUrl('index');
  }
}
