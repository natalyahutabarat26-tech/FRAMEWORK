<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProdukResource\Pages;
use App\Models\Produk;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ProdukResource extends Resource
{
    protected static ?string $model = Produk::class;

    protected static ?string $navigationIcon = 'heroicon-o-beaker'; // Icon minuman

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Produk')
                    ->schema([
                        // Input ID Kategori secara manual (karena belum relasi)
                        Forms\Components\TextInput::make('id_kategori')
                            ->numeric()
                            ->label('ID Kategori'),

                        Forms\Components\TextInput::make('nama_produk')
                            ->required()
                            ->label('Nama Minuman'),

                        Forms\Components\TextInput::make('harga')
                            ->numeric()
                            ->prefix('Rp')
                            ->required()
                            ->label('Harga'),

                        Forms\Components\Select::make('status_produk')
                            ->options([
                                'tersedia' => 'Tersedia',
                                'tidak' => 'Tidak Tersedia',
                            ])
                            ->default('tersedia')
                            ->required()
                            ->label('Status'),

                        // Komponen Upload Foto
                        Forms\Components\FileUpload::make('foto_produk')
                            ->image() // Hanya menerima file gambar
                            ->directory('produk-minuman') // Folder di storage/app/public
                            ->label('Unggah Foto Produk')
                            ->columnSpanFull(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Menampilkan Foto di Tabel
                Tables\Columns\ImageColumn::make('foto_produk')
                    ->label('Foto')
                    ->circular(), // Bentuk bulat agar rapi

                Tables\Columns\TextColumn::make('nama_produk')
                    ->searchable()
                    ->sortable()
                    ->label('Nama Minuman'),

                Tables\Columns\TextColumn::make('harga')
                    ->money('idr')
                    ->sortable(),

                Tables\Columns\BadgeColumn::make('status_produk')
                    ->colors([
                        'success' => 'tersedia',
                        'danger' => 'tidak',
                    ])
                    ->label('Status'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status_produk')
                    ->options([
                        'tersedia' => 'Tersedia',
                        'tidak' => 'Tidak Tersedia',
                    ])
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProduks::route('/'),
            'create' => Pages\CreateProduk::route('/create'),
            'edit' => Pages\EditProduk::route('/{record}/edit'),
        ];
    }
}