<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SiteStatisticResource\Pages;
use App\Models\SiteStatistic;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class SiteStatisticResource extends Resource
{
    protected static ?string $model = SiteStatistic::class;
    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';
    protected static ?string $navigationGroup = 'Settings';
    protected static ?int $navigationSort = 3;
    protected static ?string $navigationLabel = 'Statistics';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('label')->required(),
            Forms\Components\TextInput::make('value')->required(),
            Forms\Components\TextInput::make('suffix')->default('+'),
            Forms\Components\TextInput::make('icon')->placeholder('fas fa-briefcase'),
            Forms\Components\TextInput::make('sort_order')->numeric()->default(0),
            Forms\Components\Toggle::make('is_active')->default(true),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('label'),
                Tables\Columns\TextColumn::make('value'),
                Tables\Columns\TextColumn::make('suffix'),
                Tables\Columns\IconColumn::make('is_active')->boolean(),
            ])
            ->reorderable('sort_order')
            ->actions([Tables\Actions\EditAction::make(), Tables\Actions\DeleteAction::make()])
            ->bulkActions([Tables\Actions\BulkActionGroup::make([Tables\Actions\DeleteBulkAction::make()])]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListSiteStatistics::route('/'),
            'create' => Pages\CreateSiteStatistic::route('/create'),
            'edit'   => Pages\EditSiteStatistic::route('/{record}/edit'),
        ];
    }
}
