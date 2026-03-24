<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ToppingResource\Pages;
use App\Filament\Resources\ToppingResource\RelationManagers;
use App\Models\Topping;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ToppingResource extends Resource
{
    protected static ?string $model = Topping::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

   public static function form(Form $form): Form
{
    return $form
        ->schema([
            Forms\Components\TextInput::make('kode_topping')
                ->default(fn () => \App\Models\Topping::getKodeTopping())
                ->label('Kode Topping')
                ->required()
                ->readonly(),

            Forms\Components\TextInput::make('nama_topping')
                ->label('Nama Topping')
                ->required()
                ->placeholder('Masukkan nama topping'),

            Forms\Components\TextInput::make('harga_topping')
                ->label('Harga Topping')
                ->required()
                ->numeric()
                ->minValue(0)
                ->mask('999,999,999,999') // Masking format ribuan
                ->placeholder('Masukkan harga topping'),

            Forms\Components\FileUpload::make('foto')
                ->label('Foto Topping')
                ->directory('foto-topping') // Folder penyimpanan di storage/app/public
                ->image() // Memastikan yang diupload adalah gambar
                ->required(),
        ]);
}

public static function table(Table $table): Table
{
    return $table
        ->columns([
            Tables\Columns\TextColumn::make('kode_topping')
                ->label('Kode')
                ->searchable(),

            Tables\Columns\TextColumn::make('nama_topping')
                ->label('Nama Topping')
                ->searchable()
                ->sortable(),

            Tables\Columns\TextColumn::make('harga_topping')
                ->label('Harga')
                ->formatStateUsing(fn ($state) => 'Rp ' . number_format($state, 0, ',', '.'))
                ->extraAttributes(['class' => 'text-right'])
                ->sortable(),

            Tables\Columns\ImageColumn::make('foto')
                ->label('Foto'),

            Tables\Columns\TextColumn::make('created_at')
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
            Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListToppings::route('/'),
            'create' => Pages\CreateTopping::route('/create'),
            'edit' => Pages\EditTopping::route('/{record}/edit'),
        ];
    }
}
