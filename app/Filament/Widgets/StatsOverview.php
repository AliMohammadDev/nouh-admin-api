<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\Categories\CategoryResource;
use App\Filament\Resources\LinkTypes\LinkTypeResource;
use App\Filament\Resources\Majors\MajorResource;
use App\Filament\Resources\Projects\ProjectResource;
use App\Filament\Resources\Tags\TagResource;
use App\Models\Category;
use App\Models\LinkType;
use App\Models\Major;
use App\Models\Project;
use App\Models\ProjectLink;
use App\Models\Tag;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends StatsOverviewWidget
{
  protected function getStats(): array
  {
    return [
      Stat::make('إجمالي الأقسام', Major::count())
        ->description('عدد الأقسام الرئيسية')
        ->descriptionIcon('heroicon-m-squares-2x2')
        ->color('primary')
        ->url(MajorResource::getUrl('index')),

      Stat::make('إجمالي الأصناف', Category::count())
        ->description('عدد أصناف المشاريع')
        ->descriptionIcon('heroicon-m-rectangle-group')
        ->color('success')
        ->url(CategoryResource::getUrl('index')),


      Stat::make('إجمالي المشاريع', Project::count())
        ->description('كل المشاريع الموجودة')
        ->descriptionIcon('heroicon-m-folder')
        ->color('warning')
        ->url(ProjectResource::getUrl('index')),

      Stat::make('روابط المشاريع', ProjectLink::count())
        ->description('روابط المنصات والمواقع')
        ->descriptionIcon('heroicon-m-link')
        ->color('danger'),


      Stat::make('التاغات', Tag::count())
        ->description('عدد التاغات')
        ->descriptionIcon('heroicon-m-tag')
        ->color('info')
        ->url(TagResource::getUrl('index')),


      Stat::make('أنواع الروابط', LinkType::count())
        ->description('Facebook / Instagram / etc')
        ->descriptionIcon('heroicon-m-globe-alt')
        ->color('gray')
        ->url(LinkTypeResource::getUrl('index')),


    ];
  }
}
