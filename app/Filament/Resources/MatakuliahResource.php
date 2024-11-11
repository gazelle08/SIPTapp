<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MatakuliahResource\Pages;
use App\Filament\Resources\MatakuliahResource\RelationManagers;
use App\Models\Matakuliah;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MatakuliahResource extends Resource
{
    protected static ?string $model = Matakuliah::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('kodeMatakuliah')
                ->label('kode Matakuliah')
                ->required()
                ->maxLength(8),
                Forms\Components\TextInput::make('namaMatakuliah')
                ->label('nama Matakuliah')
                ->required()
                ->maxLength(30),
                Forms\Components\TextInput::make('sks')
                ->label('sks')
                ->required()
                ->maxLength(8),
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('kodeMatakuliah')
                ->sortable()->searchable(),
                Tables\Columns\TextColumn::make('namaMatakuliah')
                ->sortable()->searchable(),
                Tables\Columns\TextColumn::make('sks')
                ->sortable()->searchable(),
                //
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
            'index' => Pages\ListMatakuliahs::route('/'),
            'create' => Pages\CreateMatakuliah::route('/create'),
            'edit' => Pages\EditMatakuliah::route('/{record}/edit'),
        ];
    }
}
