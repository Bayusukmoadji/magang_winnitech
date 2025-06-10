<?php

namespace App\Filament\Admin\Resources\ReplyNewsResource\Pages;

use App\Filament\Admin\Resources\ReplyNewsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListReplyNews extends ListRecords
{
    protected static string $resource = ReplyNewsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
