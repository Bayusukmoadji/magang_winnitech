<?php

namespace App\Filament\Admin\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\NewsArticle;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Admin\Resources\NewsArticleResource\Pages;
use App\Filament\Admin\Resources\NewsArticleResource\RelationManagers;

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
                        // Kolom 1 & 2 (Span 2 kolom)
                        Forms\Components\Section::make('Konten Utama Artikel')
                            ->schema([
                                Forms\Components\TextInput::make('title')
                                    ->label('Judul Artikel')
                                    ->required()
                                    ->maxLength(255)
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(fn(Forms\Set $set, ?string $state) => $set('slug', Str::slug($state))),

                                Forms\Components\TextInput::make('slug')
                                    ->label('Slug (URL Friendly)')
                                    ->required()
                                    ->maxLength(255)
                                    ->unique(NewsArticle::class, 'slug', ignoreRecord: true), // Validasi unik, abaikan record saat ini (untuk edit)

                                Forms\Components\Textarea::make('excerpt')
                                    ->label('Ringkasan (Excerpt)')
                                    ->rows(3)
                                    ->maxLength(65535),

                                Forms\Components\RichEditor::make('content') // Menggunakan Rich Editor untuk konten
                                    ->label('Isi Konten Lengkap')
                                    ->required()
                                    ->columnSpanFull(), // Menggunakan lebar penuh di dalam section ini
                            ])
                            ->columnSpan(2),

                        // Kolom 3 (Span 1 kolom)
                        Forms\Components\Section::make('Meta & Publikasi')
                            ->schema([
                                Forms\Components\TextInput::make('author_name')
                                    ->label('Nama Penulis')
                                    ->required()
                                    ->default('Admin Winntech')
                                    ->maxLength(255),

                                Forms\Components\DateTimePicker::make('publication_date')
                                    ->label('Tanggal Publikasi')
                                    ->default(now()) // Default ke waktu sekarang
                                    ->required(),

                                Forms\Components\FileUpload::make('image_path')
                                    ->label('Gambar Unggulan')
                                    ->image() // Memastikan file adalah gambar
                                    // ->disk('public') // Tentukan disk penyimpanan (misalnya 'public')
                                    // ->directory('news_images') // Tentukan direktori penyimpanan
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
                    // ->disk('public') // Sesuaikan dengan disk penyimpanan Anda
                    ->defaultImageUrl(url('/images/placeholder.jpg')), // Ganti dengan URL gambar placeholder Anda jika ada

                Tables\Columns\TextColumn::make('title')
                    ->label('Judul Artikel')
                    ->searchable() // Memungkinkan pencarian berdasarkan judul
                    ->sortable(), // Memungkinkan pengurutan berdasarkan judul

                Tables\Columns\TextColumn::make('author_name')
                    ->label('Penulis')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('publication_date')
                    ->label('Tanggal Publikasi')
                    ->dateTime()
                    ->sortable(),

                Tables\Columns\IconColumn::make('is_featured')
                    ->label('Unggulan')
                    ->boolean()
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat Pada')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true), // Kolom bisa disembunyikan/ditampilkan

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Diperbarui Pada')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_featured')
                    ->label('Berita Unggulan'),
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
            //
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
