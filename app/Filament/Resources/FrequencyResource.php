<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FrequencyResource\Pages;
use App\Filament\Resources\FrequencyResource\RelationManagers;
use App\Models\Frequency;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FrequencyResource extends Resource
{
    protected static ?string $model = Frequency::class;

    protected static ?string $navigationIcon = 'heroicon-c-list-bullet';

    protected static ?string $modelLabel = 'frecuencia de pago';

    protected static ?string $pluralModelLabel = 'Frecuencias de pago';

    protected static ?string $navigationLabel = 'Frecuencias de pago';

    protected static ?string $navigationGroup = 'Mantenimiento';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                ->label('Nombre'),
                Forms\Components\Toggle::make('status')
                ->label('Estado')
                ->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nombre')
                    ->searchable(),
                Tables\Columns\IconColumn::make('status')
                    ->label('Estado')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Fecha de creación')
                    ->dateTime()
                    ->sortable()
                    ->default('N/A'),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Fecha de actualización')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->default('N/A'),
            ])
            ->filters([
                //
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
            'index' => Pages\ManageFrequencies::route('/'),
        ];
    }
}
