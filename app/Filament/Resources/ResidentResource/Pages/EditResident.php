<?php

namespace App\Filament\Resources\ResidentResource\Pages;

use App\Filament\Resources\ResidentResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditResident extends EditRecord
{
    protected static string $resource = ResidentResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
