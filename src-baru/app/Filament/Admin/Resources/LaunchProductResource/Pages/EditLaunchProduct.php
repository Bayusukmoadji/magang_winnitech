<?php

namespace App\Filament\Admin\Resources\LaunchProductResource\Pages;

use App\Filament\Admin\Resources\LaunchProductResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLaunchProduct extends EditRecord
{
    protected static string $resource = LaunchProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
