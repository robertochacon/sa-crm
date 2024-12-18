<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PlanResource\Pages;
use App\Filament\Resources\PlanResource\RelationManagers;
use App\Models\Frequency;
use App\Models\Plan;
use App\Models\Support;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PlanResource extends Resource
{
    protected static ?string $model = Plan::class;

    protected static ?string $navigationIcon = 'heroicon-s-gift-top';

    protected static ?string $modelLabel = 'plan';

    protected static ?string $pluralModelLabel = 'Planes';

    protected static ?string $navigationLabel = 'Planes';

    protected static ?string $navigationGroup = 'Administración';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Información general')
                ->schema([
                    Forms\Components\TextInput::make('name')
                        ->label('Nombre')
                        ->required(),
                    Forms\Components\Select::make('frequency_id')
                        ->label('Frecuencia')
                        ->options(Frequency::all()->pluck('name', 'id'))
                        ->searchable(),
                    Forms\Components\Select::make('support_id')
                        ->label('Nivel de soporte')
                        ->options(Support::all()->pluck('name', 'id'))
                        ->searchable(),
                    Forms\Components\TextInput::make('amount')
                        ->label('Monto')
                        ->required()
                        ->numeric(),
                    Forms\Components\Toggle::make('status')
                        ->label('Estado')
                        ->default(true),
                ])->columns(4)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nombre')
                    ->searchable(),
                Tables\Columns\TextColumn::make('frequency.name')
                    ->label('Frecuencia')
                    ->searchable()
                    ->badge()
                    ->default('N/A'),
                Tables\Columns\TextColumn::make('support.name')
                    ->label('Nivel de soporte')
                    ->searchable()
                    ->badge()
                    ->default('N/A'),
                Tables\Columns\TextColumn::make('amount')
                    ->label('Monto')
                    ->badge()
                    ->color('success')
                    ->separator(',')
                    ->money('DOP'),
                Tables\Columns\ToggleColumn::make('status')
                    ->label('Estado'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Creado en')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Actualizado en')
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
            'index' => Pages\ListPlans::route('/'),
            'create' => Pages\CreatePlan::route('/create'),
            'edit' => Pages\EditPlan::route('/{record}/edit'),
        ];
    }

    public static function canViewAny(): bool
    {
        $user = auth()->user();
        return $user && $user->isAdmin();
    }
}
