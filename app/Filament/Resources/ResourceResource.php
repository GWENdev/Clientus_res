<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ResourceResource\Pages;
use App\Filament\Resources\ResourceResource\RelationManagers;
use App\Models\Resource as ResourceModel;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ResourceResource extends Resource
{
    protected static ?string $model = ResourceModel::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('client_id')->required(),
                Forms\Components\TextInput::make('name')->required(),
                Forms\Components\TextInput::make('dueDate')->required(),
                Forms\Components\TextInput::make('paid_for')->integer()->required(),
                Forms\Components\TextInput::make('subDays')->integer()->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('client_id'),
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\TextColumn::make('dueDate'),
                Tables\Columns\TextColumn::make('paid_for'),
                Tables\Columns\TextColumn::make('subDays'),
                TextColumn::make('name')->label('Хостинг'),
                TextColumn::make('dueDate')->label('Дата оплаты'),
                TextColumn::make('paid_for')->label('Месяцев оплачено'),
                TextColumn::make('subDays')->label('За сколько дней предупредить'),
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
            'index' => Pages\ListResources::route('/'),
            'create' => Pages\CreateResource::route('/create'),
            'edit' => Pages\EditResource::route('/{record}/edit'),
            'view' => Pages\ViewResource::route('/{record}/'),
        ];
    }    
}
