<?php
namespace App\Filament\Resources;
use App\Filament\Resources\MahasiswaResource\Pages;
use App\Filament\Resources\MahasiswaResource\RelationManagers;
use App\Models\Mahasiswa;
use App\Imports\MahasiswaImport;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Actions\Action;
use Maatwebsite\Excel\Facades\Excel;
use Filament\Forms\Components\FileUpload;
use Illuminate\Support\Facades\Storage;
use Filament\Notifications\Notification;
class MahasiswaResource extends Resource
{
 protected static ?string $model = Mahasiswa::class;
 protected static ?string $navigationLabel = 'Daftar Mahasiswa';
 protected static ?string $navigationIcon = 'heroicon-o-users';
 protected static ?string $navigationGroup = 'Data Mahasiswa';
 public static function form(Form $form): Form
 {
 return $form
 ->schema([
 Forms\Components\TextInput::make('studentID')
 ->label('Student ID')
 ->required()
 ->maxLength(11),
 Forms\Components\TextInput::make('nama')
 ->label('Nama Mahasiswa')
 ->required()
 ->maxLength(11),
 Forms\Components\Select::make('jurusan')
 ->options([
 'Sistem Informasi' => 'Sistem Informasi',
 'Informatika' => 'Informatika',
 'Manajemen' => 'Manajemen',
 'Hospitality' => 'Hospitality',
 'Hukum' => 'Hukum',
 'Akuntansi' => 'Akuntansi',
 ])
 ->searchable()
 ->native(false),
 Forms\Components\Select::make('tahunMasuk')
 ->options([
 '2020' => '2020',
 '2021' => '2021',
 '2022' => '2022',
 '2023' => '2023',
 '2024' => '2024'
 ])
 ->searchable()
 ->native(false),
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
 ])
 ->filters([
 //
 ])
 ->actions([
 Tables\Actions\EditAction::make()
 ])
 ->headerActions([
 Action::make('importExcel')
 ->label('Import Excel')
 ->action(function (array $data) {
 // Pastikan $data['file'] adalah jalur yang valid di storage
 $filePath = storage_path('app/public/' . $data['file']);

 // Import file menggunakan jalur absolut
Excel::import(new MahasiswaImport, $filePath);
 // Tampilkan notifikasi sukses
Notification::make()
 ->title('Data berhasil diimpor!')
 ->success()
 ->send();
 })
->form([
 FileUpload::make('file')
 ->label('Pilih File Excel')
 ->disk('public') // Pastikan disimpan di disk 'public'
 ->directory('imports')
 ->acceptedFileTypes(['application/vnd.openxmlformatsofficedocument.spreadsheetml.sheet', 'application/vnd.ms-excel'])
 ->required(),
 ])
->modalHeading('Import Data Mahasiswa')
 ->modalButton('Import')
 ->color('success'),
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