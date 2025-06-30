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
                // Forms\Components\Select::make('news_comment_id')
                //     ->label('Commentnews')
                //     ->relationship('commentnews', 'name') // relasi 'article' sesuai method di model NewsComment
                //     ->required(),
                // Forms\Components\TextInput::make('name')
                //     ->required(),
                // Forms\Components\Textarea::make('comment')
                //     ->required()
                //     ->columnSpanFull(),
            ]);
    }

    // app/Filament/Admin/Resources/ReplyNewsResource.php

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // === KOLOM BARU YANG DITAMBAHKAN ===
                // Menampilkan judul artikel berita melalui relasi bertingkat:
                // ReplyNews -> NewsComment -> NewsArticle
                Tables\Columns\TextColumn::make('commentnews.article.title')
                    ->label('Artikel Berita')
                    ->sortable()
                    ->searchable()
                    ->limit(30)
                    ->wrap(),

                // Menampilkan isi komentar yang dibalas (induknya)
                Tables\Columns\TextColumn::make('commentnews.comment')
                    ->label('Membalas Komentar')
                    ->limit(40)
                    ->wrap(),

                // Menampilkan nama pengirim balasan ini
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Pembalas')
                    ->searchable()
                    ->sortable(), // <-- Penambahan sortable untuk konsistensi

                // Menampilkan isi balasan ini sendiri
                Tables\Columns\TextColumn::make('comment')
                    ->label('Isi Balasan')
                    ->limit(50)
                    ->wrap()
                    ->searchable(), // <-- Penambahan searchable untuk konsistensi

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
                // Di sini kita bisa menambahkan filter nanti
            ])
            ->actions([
                // Menambahkan ViewAction untuk konsistensi
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
            'index' => Pages\ListReplyNews::route('/'),
            'edit' => Pages\EditReplyNews::route('/{record}/edit'),
        ];
    }
}
