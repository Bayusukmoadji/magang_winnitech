<?php

namespace App\Filament\Admin\Resources\ReplyNewsResource\Pages;

use App\Filament\Admin\Resources\ReplyNewsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditReplyNews extends EditRecord
{
    protected static string $resource = ReplyNewsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
