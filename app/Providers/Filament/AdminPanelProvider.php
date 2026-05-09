<?php

namespace App\Providers\Filament;

use App\Filament\Resources\Projects\Widgets\ProjectsPerCategoryChart;
use App\Filament\Resources\Projects\Widgets\ProjectsWeeklyChart;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets\AccountWidget;
use Filament\Widgets\FilamentInfoWidget;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\PreventRequestForgery;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;


class AdminPanelProvider extends PanelProvider
{
  public function panel(Panel $panel): Panel
  {
    return $panel
      ->default()
      ->id('admin')
      ->path('admin')
      ->login()
      ->brandName('Nouh Agency')
      ->brandLogo(asset('logo-dark.png'))
      ->brandLogoHeight('4rem')
      ->darkModeBrandLogo(asset('logo.svg'))
      ->favicon(asset('logo.svg'))
      ->colors([
        'primary' => Color::Amber,
      ])
      ->font('Cairo')
      ->renderHook(
        \Filament\View\PanelsRenderHook::HEAD_END,
        fn(): \Illuminate\Support\HtmlString => new \Illuminate\Support\HtmlString('
        <style>
            html, body {
                font-size: 16px !important;
            }
            .fi-sidebar-item-label, .fi-ta-header-heading {
                font-size: 1.1rem !important;
            }
        </style>
    '),
      )
      ->globalSearch(false)
      ->discoverResources(in: app_path('Filament/Resources'), for: 'App\Filament\Resources')
      ->discoverPages(in: app_path('Filament/Pages'), for: 'App\Filament\Pages')
      ->pages([
        Dashboard::class,
      ])
      ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\Filament\Widgets')
      ->widgets([
        ProjectsPerCategoryChart::class,
        ProjectsWeeklyChart::class,
      ])
      ->middleware([
        EncryptCookies::class,
        AddQueuedCookiesToResponse::class,
        StartSession::class,
        AuthenticateSession::class,
        ShareErrorsFromSession::class,
        PreventRequestForgery::class,
        SubstituteBindings::class,
        DisableBladeIconComponents::class,
        DispatchServingFilamentEvent::class,
      ])
      ->authMiddleware([
        Authenticate::class,
      ]);
  }
}
