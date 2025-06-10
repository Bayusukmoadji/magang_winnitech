<?php

namespace App\Filament\Admin\Resources\LaunchProductResource\Pages;

use App\Filament\Admin\Resources\LaunchProductResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLaunchProducts extends ListRecords
{
    protected static string $resource = LaunchProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
