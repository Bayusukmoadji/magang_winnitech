<?php

namespace App\Filament\Admin\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\NewsArticle;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use App\Filament\Admin\Resources\NewsArticleResource\Pages;


class NewsArticleResource extends Resource
{
    protected static ?string $model = NewsArticle::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    protected static ?string $navigationGroup = 'NEWS';

    protected static ?string $recordTitleAttribute = 'news';

    protected static ?int $navigationSort = 1;

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make(3)
                    ->schema([
                        Forms\Components\Section::make('Konten Utama Artikel')
                            ->schema([
                                Forms\Components\TextInput::make('title')
                                    ->label('Judul Artikel')
                                    ->required()
                                    ->maxLength(255)
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(fn(Forms\Set $set, ?string $state) => $set('slug', Str::slug($state))),

                                Forms\Components\Hidden::make('slug')
                                    ->label('Slug (URL Friendly)')
                                    ->required()
                                    ->unique(NewsArticle::class, 'slug', ignoreRecord: true),

                                Forms\Components\Textarea::make('excerpt')
                                    ->label('Ringkasan (Excerpt)')
                                    ->rows(3)
                                    ->maxLength(65535),

                                Forms\Components\RichEditor::make('content')
                                    ->label('Isi Konten Lengkap')
                                    ->required()
                                    ->columnSpanFull(),
                            ])
                            ->columnSpan(2),

                        Forms\Components\Section::make('Meta & Publikasi')
                            ->schema([
                                Forms\Components\TextInput::make('author_name')
                                    ->label('Nama Penulis')
                                    ->required()
                                    ->default('Admin Winntech')
                                    ->maxLength(255),

                                Forms\Components\DateTimePicker::make('publication_date')
                                    ->label('Tanggal Publikasi')
                                    ->default(now())
                                    ->required(),

                                Forms\Components\FileUpload::make('image_path')
                                    ->label('Gambar Unggulan')
                                    ->image()
                                    ->nullable(),

                                Forms\Components\TextInput::make('image_caption')
                                    ->label('Keterangan Gambar')
                                    ->maxLength(255)
                                    ->nullable(),

                                Forms\Components\Toggle::make('is_featured')
                                    ->label('Jadikan Berita Unggulan?')
                                    ->default(false)
                                    ->required(),
                            ])
                            ->columnSpan(1),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image_path')
                    ->label('Gambar')

                    ->defaultImageUrl(url('/images/placeholder.jpg')),

                Tables\Columns\TextColumn::make('title')
                    ->label('Judul Artikel')
                    ->searchable()
                    ->sortable()
                    ->limit(35)
                    ->tooltip(function (NewsArticle $record): string {
                        return $record->title;
                    }),

                Tables\Columns\TextColumn::make('author_name')
                    ->label('Penulis')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('publication_date')
                    ->label('Tanggal Publikasi')
                    ->dateTime()
                    ->sortable(),

                Tables\Columns\BadgeColumn::make('is_featured')
                    ->label('Unggulan')
                    ->formatStateUsing(fn(string $state): string => $state ? 'YA' : 'TIDAK')
                    ->colors([
                        'success' => true,
                        'danger' => false,
                    ])
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat Pada')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Diperbarui Pada')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_featured')
                    ->label('Berita Unggulan'),

                Tables\Filters\SelectFilter::make('author_name')
                    ->label('Filter Penulis')
                    ->options(
                        NewsArticle::query()->distinct()->pluck('author_name', 'author_name')->all()
                    ),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
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
            // CommentsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListNewsArticles::route('/'),
            'create' => Pages\CreateNewsArticle::route('/create'),
            'edit' => Pages\EditNewsArticle::route('/{record}/edit'),
        ];
    }
}
