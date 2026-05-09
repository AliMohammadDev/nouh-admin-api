<?php

namespace App\Filament\Resources\Projects\Widgets;

use App\Models\Project;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;

class ProjectsWeeklyChart extends ChartWidget
{
  protected ?string $heading = 'المشاريع المضافة أسبوعياً';

  protected function getData(): array
  {
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
    ];

    for ($i = 6; $i >= 0; $i--) {

      $date = Carbon::now()->subDays($i);

      $labels[] = $date->format('D');

      $data[] = Project::whereDate('created_at', $date->format('Y-m-d'))->count();

      $colors[] = $palette[6 - $i];
    }

    return [
      'datasets' => [
        [
          'label' => 'المشاريع',
          'data' => $data,

          'backgroundColor' => $colors,

          'borderColor' => '#ffffff',
          'borderWidth' => 2,

          'hoverOffset' => 10,
        ],
      ],

      'labels' => $labels,
    ];
  }

  protected function getType(): string
  {
    return 'pie';
  }
}
