<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\ReplyNewsResource\Pages;
use App\Filament\Admin\Resources\ReplyNewsResource\RelationManagers;
use App\Models\ReplyNews;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ReplyNewsResource extends Resource
{
    protected static ?string $model = ReplyNews::class;

    protected static ?string $navigationIcon = 'heroicon-s-arrow-uturn-left';

    protected static ?string $navigationGroup = 'NEWS';

    protected static ?int $navigationSort = 3;

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('news_comment_id')
                    ->label('Commentnews')
                    ->relationship('commentnews', 'name') // relasi 'article' sesuai method di model NewsComment
                    ->required(),
                Forms\Components\TextInput::make('name')
                    ->required(),
                Forms\Components\Textarea::make('comment')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('commentnews.comment')
                    ->label('Commentnews')
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListReplyNews::route('/'),
            'create' => Pages\CreateReplyNews::route('/create'),
            'edit' => Pages\EditReplyNews::route('/{record}/edit'),
        ];
    }
}
