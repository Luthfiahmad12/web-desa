<?php

namespace App\Filament\Widgets;

use App\Models\Resident;
use Filament\Widgets\ChartWidget;

class ResidentByHamletChart extends ChartWidget
{
    protected static ?string $heading = 'Jumlah Penduduk';

    protected static ?string $maxHeight = '300px';

    public $data = [];

    protected function getData(): array
    {
        $labels = ['Getas', 'Xurip', 'Kasiyan'];

        $data = [
            Resident::where('hamlet', 'getas')->count(),
            Resident::where('hamlet', 'xurip')->count(),
            Resident::where('hamlet', 'kasiyan')->count(),
        ];

        $colors = [
            'rgba(255, 99, 132, 0.7)',
            'rgba(54, 162, 235, 0.7)',
            'rgba(255, 206, 86, 0.7)',
        ];

        return [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Jumlah Penduduk',
                    'data' => $data,
                    'backgroundColor' => $colors,  // Menggunakan warna custom
                    'hoverOffset' => 4
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }
}
