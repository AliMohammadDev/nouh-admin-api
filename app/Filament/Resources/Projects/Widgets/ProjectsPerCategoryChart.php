<?php

namespace App\Filament\Resources\Projects\Widgets;

use App\Models\Category;
use Filament\Widgets\ChartWidget;

class ProjectsPerCategoryChart extends ChartWidget
{
  protected ?string $heading = 'المشاريع حسب القسم';

  protected function getData(): array
  {
    $categories = Category::withCount('projects')->get();

    $labels = [];
    $data = [];
    $colors = [];

    $palette = [
      '#3B82F6', // blue
      '#10B981', // green
      '#F59E0B', // yellow
      '#EF4444', // red
      '#8B5CF6', // purple
      '#06B6D4', // cyan
      '#F97316', // orange
      '#14B8A6', // teal
    ];

    foreach ($categories as $index => $category) {

      $labels[] = $category->name['ar'] ?? $category->name['en'];

      $data[] = $category->projects_count;

      $colors[] = $palette[$index % count($palette)];
    }

    return [
      'datasets' => [
        [
          'label' => 'عدد المشاريع',

          'data' => $data,

          'backgroundColor' => $colors,

          'borderRadius' => 8,

          'borderSkipped' => false,

          'hoverBackgroundColor' => $colors,
        ],
      ],

      'labels' => $labels,
    ];
  }

  protected function getType(): string
  {
    return 'bar';
  }
}
