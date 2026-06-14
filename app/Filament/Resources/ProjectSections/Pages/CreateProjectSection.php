<?php

namespace App\Filament\Resources\ProjectSections\Pages;

use App\Filament\Resources\ProjectSections\ProjectSectionResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Actions;


class CreateProjectSection extends CreateRecord
{
  protected static string $resource = ProjectSectionResource::class;

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
