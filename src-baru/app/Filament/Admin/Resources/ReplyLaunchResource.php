<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\ReplyLaunchResource\Pages;
use App\Filament\Admin\Resources\ReplyLaunchResource\RelationManagers;
use App\Models\ReplyLaunch;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ReplyLaunchResource extends Resource
{
    protected static ?string $model = ReplyLaunch::class;

    protected static ?string $navigationIcon = 'heroicon-o-arrow-uturn-left';

    protected static ?string $navigationGroup = 'LAUNCH';

    protected static ?int $navigationSort = 6;

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Forms\Components\Select::make('launches_comment_id')
                //     ->label('Commentlaunch')
                //     ->relationship('commentlaunch', 'name') // relasi 'article' sesuai method di model NewsComment
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

                Tables\Columns\TextColumn::make('commentlaunch.product.title')
                    ->label('Launch Product')
                    ->sortable()
                    ->searchable()
                    ->limit(30)
                    ->wrap(),

                // Menampilkan isi komentar yang dibalas (induknya)
                Tables\Columns\TextColumn::make('commentlaunch.comment')
                    ->label('Membalas Komentar')
                    ->limit(40)
                    ->wrap(),

                // Menampilkan nama pengirim balasan ini
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Pembalas')
                    ->searchable()
                    ->sortable(),

                // Menampilkan isi balasan ini sendiri
                Tables\Columns\TextColumn::make('comment')
                    ->label('Isi Balasan')
                    ->limit(50)
                    ->wrap()
                    ->searchable(),

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
            'index' => Pages\ListReplyLaunches::route('/'),
            'create' => Pages\CreateReplyLaunch::route('/create'),
            'edit' => Pages\EditReplyLaunch::route('/{record}/edit'),
        ];
    }
}
