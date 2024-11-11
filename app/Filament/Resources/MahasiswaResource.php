<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MahasiswaResource\Pages;
use App\Filament\Resources\MahasiswaResource\RelationManagers;
use App\Models\Mahasiswa;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MahasiswaResource extends Resource
{
    protected static ?string $model = Mahasiswa::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('studentID')
                ->label('studentID')
                ->required()
                ->maxLength(11),
                Forms\Components\TextInput::make('nama')
                ->label('nama')
                ->required()
                ->maxLength(30),
                Forms\Components\TextInput::make('jurusan')
                ->label('sks')
                ->required()
                ->maxLength(8),
                Forms\Components\TextInput::make('tahunMasuk')
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
            Tables\Columns\TextColumn::make('studentID')
            ->sortable()->searchable(),
            Tables\Columns\TextColumn::make('nama')
            ->sortable()->searchable(),
            Tables\Columns\TextColumn::make('jurusan')
            ->sortable()->searchable(),
            Tables\Columns\TextColumn::make('tahunMasuk')
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
            'index' => Pages\ListMahasiswas::route('/'),
            'create' => Pages\CreateMahasiswa::route('/create'),
            'edit' => Pages\EditMahasiswa::route('/{record}/edit'),
        ];
    }
}
