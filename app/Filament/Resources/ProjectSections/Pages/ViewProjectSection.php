<?php

namespace App\Filament\Resources\ProjectSections\Pages;

use App\Filament\Resources\ProjectSections\ProjectSectionResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use Filament\Actions;


class ViewProjectSection extends ViewRecord
{
  protected static string $resource = ProjectSectionResource::class;

  protected function getHeaderActions(): array
  {
    return [
      Actions\Action::make('back')
        ->label('رجوع')
        ->color('gray')
        ->url($this->getResource()::getUrl('index')),
      EditAction::make(),
    ];
  }
}
