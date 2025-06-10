<?php

namespace App\Filament\Admin\Resources\LaunchCommentResource\Pages;

use App\Filament\Admin\Resources\LaunchCommentResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLaunchComment extends EditRecord
{
    protected static string $resource = LaunchCommentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
