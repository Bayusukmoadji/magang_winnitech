<?php

namespace App\Filament\Admin\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use App\Models\LaunchProduct;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Admin\Resources\LaunchProductResource\Pages;
use App\Filament\Admin\Resources\LaunchProductResource\RelationManagers;

class LaunchProductResource extends Resource
{
    protected static ?string $model = LaunchProduct::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    protected static ?string $navigationGroup = 'LAUNCH';

    protected static ?int $navigationSort = 4;

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
                        // Grup kolom kiri (2/3 dari lebar)
                        Forms\Components\Section::make('Detail Produk')
                            ->schema([
                                Forms\Components\TextInput::make('title')
                                    ->label('Nama Produk')
                                    ->required()
                                    ->maxLength(255)
                                    // Membuat slug otomatis saat pengguna selesai mengisi judul
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(fn(Forms\Set $set, ?string $state) => $set('slug', Str::slug($state))),

                                Forms\Components\TextInput::make('slug')
                                    ->label('Slug (untuk URL)')
                                    ->required()
                                    ->maxLength(255)
                                    // Memastikan slug unik, mengabaikan record saat ini (untuk edit)
                                    ->unique(LaunchProduct::class, 'slug', ignoreRecord: true),

                                Forms\Components\TextInput::make('company_name')
                                    ->label('Nama Perusahaan')
                                    ->required()
                                    ->maxLength(255),

                                Forms\Components\DatePicker::make('launch_date')
                                    ->label('Tanggal Peluncuran')
                                    ->required(),

                                Forms\Components\Textarea::make('short_description')
                                    ->label('Deskripsi Singkat')
                                    ->rows(3)
                                    ->nullable(),

                                Forms\Components\RichEditor::make('long_description')
                                    ->label('Deskripsi Lengkap')
                                    ->columnSpanFull() // Menggunakan lebar penuh section
                                    ->nullable(),

                                // Input untuk 'key_features' (array)
                                Forms\Components\TagsInput::make('key_features')
                                    ->label('Fitur Utama')
                                    ->helperText('Ketik fitur lalu tekan enter untuk menambahkannya.')
                                    ->placeholder('Fitur baru')
                                    ->nullable(),

                                // Input untuk 'technical_specifications' (key-value array)
                                Forms\Components\KeyValue::make('technical_specifications')
                                    ->label('Spesifikasi Teknis')
                                    ->keyLabel('Nama Spesifikasi')
                                    ->valueLabel('Nilai Spesifikasi')
                                    ->addActionLabel('Tambah Spesifikasi')
                                    ->columnSpanFull()
                                    ->nullable(),
                            ])
                            ->columnSpan(2),

                        // Grup kolom kanan (1/3 dari lebar)
                        Forms\Components\Section::make('Media & Tautan')
                            ->schema([
                                Forms\Components\FileUpload::make('image_path')
                                    ->label('Gambar Produk')
                                    ->image()
                                    // Anda mungkin perlu mengatur disk penyimpanan: ->disk('public')
                                    ->directory('launch-product-images')
                                    ->nullable(),

                                Forms\Components\TextInput::make('official_site_url')
                                    ->label('URL Situs Resmi')
                                    ->url() // Validasi sebagai URL
                                    ->maxLength(2048)
                                    ->nullable(),
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
                    ->label('Gambar'),

                Tables\Columns\TextColumn::make('title')
                    ->label('Nama Produk')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('company_name')
                    ->label('Perusahaan')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('launch_date')
                    ->label('Tanggal Peluncuran')
                    ->date('d M Y') // Format tanggal
                    ->sortable(),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Terakhir Diperbarui')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\Filter::make('launch_date')
                    ->form([
                        Forms\Components\DatePicker::make('launched_after')->label('Diluncurkan Setelah'),
                        Forms\Components\DatePicker::make('launched_before')->label('Diluncurkan Sebelum'),
                    ])
                    ->query(function ($query, array $data) {
                        return $query
                            ->when(
                                $data['launched_after'],
                                fn($query, $date) => $query->whereDate('launch_date', '>=', $date),
                            )
                            ->when(
                                $data['launched_before'],
                                fn($query, $date) => $query->whereDate('launch_date', '<=', $date),
                            );
                    })
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
            'index' => Pages\ListLaunchProducts::route('/'),
            'create' => Pages\CreateLaunchProduct::route('/create'),
            'edit' => Pages\EditLaunchProduct::route('/{record}/edit'),
        ];
    }
}
