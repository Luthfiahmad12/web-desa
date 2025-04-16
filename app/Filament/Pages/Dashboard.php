<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\ResidentByHamletChart;
use Filament\Pages\Page;

class Dashboard extends \Filament\Pages\Dashboard
{
    protected static ?string $navigationIcon = 'heroicon-o-home';

    protected static ?string $title = 'Dashboard ';

    public function getColumns(): int | string | array
    {
        return 3;
    }

    protected static string $view = 'filament.pages.dashboard';

    protected function getHeaderWidgets(): array
    {
        return [
            ResidentByHamletChart::class,
            ResidentByHamletChart::class,
        ];
    }
}
