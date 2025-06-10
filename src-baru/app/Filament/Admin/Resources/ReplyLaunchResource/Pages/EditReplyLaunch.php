<?php

namespace App\Filament\Admin\Resources\ReplyLaunchResource\Pages;

use App\Filament\Admin\Resources\ReplyLaunchResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditReplyLaunch extends EditRecord
{
    protected static string $resource = ReplyLaunchResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
