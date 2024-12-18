<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrdersResource\Pages;
use App\Models\Category;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class OrdersResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $modelLabel = 'Orden';

    protected static ?string $pluralModelLabel = 'Ordenes';

    protected static ?string $navigationLabel = 'Ordenes';

    protected static ?string $navigationGroup = 'Administración';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Repeater::make('products')
                    ->label('Otros Productos')
                    ->schema([
                        Forms\Components\Select::make('category_id')
                            ->label('Categoría')
                            ->options(Category::all()->pluck('name', 'id'))
                            ->required(),
                        Forms\Components\TextInput::make('name')
                            ->label('Nombre')
                            ->required(),
                        Forms\Components\TextInput::make('price')
                            ->label('Precio')
                            ->numeric()
                            ->nullable(),
                        Forms\Components\TextInput::make('amount')
                            ->label('Cantidad')
                            ->numeric()
                            ->nullable(),
                        Forms\Components\TextInput::make('total')
                            ->label('Total')
                            ->numeric()
                            ->nullable(),
                    ])
                    ->columns(5)
                    ->cloneable()
                    ->collapsible()
                    ->reorderableWithDragAndDrop(true)
                    ->columnSpanFull(),
                Forms\Components\Section::make('Detalles de la Orden')
                    ->schema([
                        Forms\Components\Textarea::make('note')
                            ->label('Nota')
                            ->required(),
                        Forms\Components\Textarea::make('extra')
                            ->label('Extra'),
                        Forms\Components\Select::make('status')
                            ->label('Estado')
                            ->options([
                                'Recibida' => 'Recibida',
                                'Preparando' => 'Preparando',
                                'Completada' => 'Completada',
                                'Facturada' => 'Facturada',
                                'Cancelada' => 'Cancelada',
                            ])
                            ->default('Recibida')
                            ->required(),
                        Forms\Components\TextInput::make('table')
                            ->label('Mesa')
                            ->numeric()
                            ->nullable(),
                        Forms\Components\TextInput::make('subtotal')
                            ->label('Subtotal')
                            ->numeric()
                            ->nullable(),
                        Forms\Components\TextInput::make('total')
                            ->label('Total')
                            ->numeric()
                            ->nullable(),
                        Forms\Components\TextInput::make('itbis')
                            ->label('ITBIS')
                            ->numeric()
                            ->nullable(),
                        Forms\Components\Toggle::make('in_restaurant')
                            ->label('En Restaurante')
                            ->default(true),
                    ])->columns(3)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('Code')
                    ->sortable()
                    ->default('N/A'),
                Tables\Columns\TextColumn::make('table')
                    ->label('Mesa')
                    ->default('N/A'),
                Tables\Columns\TextColumn::make('status')
                    ->label('Estado')
                    ->default('N/A'),
                Tables\Columns\TextColumn::make('subtotal')
                    ->label('Subtotal')
                    ->money('DOP')
                    ->default('N/A'),
                Tables\Columns\TextColumn::make('total')
                    ->label('Total')
                    ->money('DOP')
                    ->default('N/A'),
                Tables\Columns\TextColumn::make('itbis')
                    ->label('ITBIS')
                    ->money('DOP')
                    ->default('N/A'),
                Tables\Columns\TextColumn::make('user.name'.' '.'user.last_name')
                    ->label('Usuario')
                    ->default('N/A'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Fecha Creación')
                    ->dateTime(),
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrders::route('/create'),
            'edit' => Pages\EditOrders::route('/{record}/edit'),
        ];
    }

    public static function canViewAny(): bool
    {
        $user = auth()->user();
        return $user && $user->isSubscriber();
    }
}
