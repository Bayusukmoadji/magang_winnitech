<?php

namespace App\Filament\Admin\Resources\LaunchCommentResource\Pages;

use App\Filament\Admin\Resources\LaunchCommentResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLaunchComments extends ListRecords
{
    protected static string $resource = LaunchCommentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
