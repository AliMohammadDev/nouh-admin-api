<?php

namespace App\Filament\Resources\Projects\Widgets;

use App\Models\Project;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;

class ProjectsMonthlyChart extends ChartWidget
{
  protected ?string $heading = 'المشاريع حسب الأشهر';

  protected function getData(): array
  {
    $labels = [];
    $data = [];
    $colors = [];

    $palette = [
      '#3B82F6',
      '#10B981',
      '#F59E0B',
      '#EF4444',
      '#8B5CF6',
      '#06B6D4',
      '#F97316',
    ];

    for ($i = 5; $i >= 0; $i--) {

      $date = Carbon::now()->subMonths($i);

      $labels[] = $date->format('M Y');

      $data[] = Project::whereYear('created_at', $date->year)
        ->whereMonth('created_at', $date->month)
        ->count();

      $colors[] = $palette[5 - $i];
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
    return 'polarArea';
  }
}
