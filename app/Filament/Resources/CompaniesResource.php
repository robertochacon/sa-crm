<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CompaniesResource\Pages;
use App\Filament\Resources\CompaniesResource\RelationManagers;
use App\Models\Company;
use App\Models\Plan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CompaniesResource extends Resource
{
    protected static ?string $model = Company::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';

    protected static ?string $modelLabel = 'empresa';

    protected static ?string $pluralModelLabel = 'Empresas';

    protected static ?string $navigationLabel = 'Empresas';

    protected static ?string $navigationGroup = 'Administración';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Información general')
                ->schema([
                    Forms\Components\TextInput::make('full_name')
                        ->label('Nombre completo')
                        ->maxLength(150)
                        ->default(null),
                    Forms\Components\TextInput::make('short_name')
                        ->label('Nombre corto')
                        ->maxLength(60)
                        ->default(null),
                    Forms\Components\TextInput::make('rnc')
                        ->label('RNC')
                        ->maxLength(11)
                        ->default(null),
                    Forms\Components\TextInput::make('website')
                        ->label('Sitio web')
                        ->maxLength(50)
                        ->default(null),
                    Forms\Components\TextInput::make('phone')
                        ->label('Teléfono')
                        ->tel()
                        ->maxLength(50)
                        ->default(null),
                    Forms\Components\ColorPicker::make('color')
                        ->label('Color')
                        ->default('Blue'),
                    Forms\Components\Textarea::make('address')
                        ->label('Dirección')
                        ->maxLength(150)
                        ->minLength(2)
                        ->rows(5),
                    Forms\Components\FileUpload::make('logo')
                        ->label('Logo de la empresa')
                        ->image()
                        ->imageEditor()
                        ->circleCropper()
                        ->disk('public')
                        ->directory('companies-images')
                        ->circleCropper()
                        ->downloadable()
                        ->optimize('jpg'),
                    Forms\Components\Select::make('plan_id')
                        ->label('Plan')
                        ->options(Plan::all()->pluck('name', 'id'))
                        ->searchable(),
                    Forms\Components\TextInput::make('tables')
                        ->label('Cantidad de mesas')
                        ->numeric()
                        ->maxLength(2)
                        ->default(10),
                    Forms\Components\Toggle::make('status')
                        ->label('Estado')
                        ->default(true),
                ])->columns(3)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('logo')
                ->label('')
                ->defaultImageUrl(url('storage/companies-images/default.png'))
                ->disk('public')
                ->circular(),
                Tables\Columns\TextColumn::make('full_name')
                    ->label('Nombre completo')
                    ->searchable()
                    ->default('N/A'),
                Tables\Columns\TextColumn::make('short_name')
                    ->label('Nombre corto')
                    ->searchable()
                    ->default('N/A'),
                Tables\Columns\TextColumn::make('rnc')
                    ->label('RNC')
                    ->searchable()
                    ->default('N/A'),
                Tables\Columns\TextColumn::make('phone')
                    ->label('Teléfono')
                    ->searchable()
                    ->default('N/A'),
                Tables\Columns\TextColumn::make('plan.name')
                    ->label('Plan')
                    ->searchable()
                    ->badge()
                    ->default('N/A'),
                Tables\Columns\ToggleColumn::make('status')
                ->label('Estado'),
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
            RelationManagers\UsersRelationManager::class,
            RelationManagers\CategoriesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCompanies::route('/'),
            'create' => Pages\CreateCompanies::route('/create'),
            'edit' => Pages\EditCompanies::route('/{record}/edit'),
        ];
    }

    public static function canViewAny(): bool
    {
        $user = auth()->user();
        return $user && $user->isAdmin();
    }
}
