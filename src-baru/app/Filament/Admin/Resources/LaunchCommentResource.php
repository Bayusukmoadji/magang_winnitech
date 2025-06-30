<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\LaunchCommentResource\Pages;
use App\Filament\Admin\Resources\LaunchCommentResource\RelationManagers;
use App\Models\LaunchComment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LaunchCommentResource extends Resource
{
    protected static ?string $model = LaunchComment::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';

    protected static ?string $navigationGroup = 'LAUNCH';

    protected static ?int $navigationSort = 5;

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Forms\Components\Select::make('launch_product_id')
                //     ->label('Launch')
                //     ->relationship('launch', 'title')
                //     ->required(),
                // Forms\Components\TextInput::make('name')
                //     ->required(),
                // Forms\Components\Textarea::make('comment')
                //     ->required()
                //     ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('product.title')
                    ->label('Launch Product')
                    ->searchable()
                    ->sortable()
                    ->wrap()
                    ->limit(40)
                    ->url(fn(LaunchComment $record): string => LaunchProductResource::getUrl('edit', ['record' => $record->product])),

                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Pengomentar')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('comment')
                    ->label('Isi Komentar')
                    ->limit(50)
                    ->wrap(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal')
                    ->dateTime('d M Y, H:i')
                    ->sortable(),

                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime('d M Y, H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLaunchComments::route('/'),
            'create' => Pages\CreateLaunchComment::route('/create'),
            'edit' => Pages\EditLaunchComment::route('/{record}/edit'),
        ];
    }
}
