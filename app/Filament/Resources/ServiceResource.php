<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServiceResource\Pages;
use App\Filament\Resources\ServiceResource\RelationManagers;
use App\Models\Service;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ServiceResource extends Resource
{
    protected static ?string $model = Service::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-library';

    protected static ?string $navigationGroup = 'Master Data';

    protected static ?string $navigationLabel = 'Pelayanan Publik';

    protected static ?string $modelLabel = 'Pelayanan Publik';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('service name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('description')
                    ->nullable()
                    ->columnSpanFull(),
                Forms\Components\CheckboxList::make('requirements')
                    ->options([
                        'ktp' => 'KTP',
                        'kk' => 'KK',
                        'sim' => 'SIM',
                        'ijazah' => 'IJAZAH',
                    ])
                    ->columns(2)
                    ->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->emptyStateIcon('heroicon-o-document')
            ->emptyStateHeading('No service yet')
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Service Name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('description')
                    ->wrap()
                    ->limit(50),
                Tables\Columns\TextColumn::make('requirements')
                    ->formatStateUsing(fn($state) => collect($state)
                        ->map(fn($doc) => strtoupper($doc))
                        ->implode(', '))
                    ->badge()
                    ->color('success'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->icon('heroicon-m-pencil-square')
                    ->iconButton(true)
                    ->tooltip('Edit data'),
                Tables\Actions\DeleteAction::make()->icon('heroicon-m-trash')
                    ->iconButton(true)
                    ->tooltip('Delete data'),
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
            'index' => Pages\ListServices::route('/'),
            'create' => Pages\CreateService::route('/create'),
            'edit' => Pages\EditService::route('/{record}/edit'),
        ];
    }
}
