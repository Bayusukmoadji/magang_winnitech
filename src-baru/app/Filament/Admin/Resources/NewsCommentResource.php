<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\NewsCommentResource\Pages;
use App\Models\NewsComment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;


class NewsCommentResource extends Resource
{
    protected static ?string $model = NewsComment::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';

    protected static ?string $navigationGroup = 'NEWS';

    protected static ?int $navigationSort = 2;

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Forms\Components\Select::make('news_article_id')
                //     ->label('Article')
                //     ->relationship('article', 'title')
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

                Tables\Columns\TextColumn::make('article.title')
                    ->label('Artikel Berita')
                    ->searchable()
                    ->sortable()
                    ->wrap(),


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
            ->filters([
                //
            ])
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
            'index' => Pages\ListNewsComments::route('/'),
            'edit' => Pages\EditNewsComment::route('/{record}/edit'),
        ];
    }
}
