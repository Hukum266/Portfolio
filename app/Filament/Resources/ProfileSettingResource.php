<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProfileSettingResource\Pages;
use App\Models\ProfileSetting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ProfileSettingResource extends Resource
{
    protected static ?string $model = ProfileSetting::class;
    protected static ?string $navigationIcon = 'heroicon-o-user-circle';
    protected static ?string $navigationGroup = 'Settings';
    protected static ?string $navigationLabel = 'Profile';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Identity')->schema([
                Forms\Components\TextInput::make('full_name')->required()->maxLength(255),
                Forms\Components\TextInput::make('professional_title')->required()->maxLength(255),
                Forms\Components\FileUpload::make('profile_image')
                    ->image()->disk('public')->directory('profile')->imageEditor(),
                Forms\Components\FileUpload::make('hero_image')
                    ->image()->disk('public')->directory('profile')->imageEditor(),
            ])->columns(2),

            Forms\Components\Section::make('Bio')->schema([
                Forms\Components\Textarea::make('short_bio')->rows(3)->maxLength(300),
                Forms\Components\RichEditor::make('biography')->columnSpanFull(),
            ]),

            Forms\Components\Section::make('Contact Info')->schema([
                Forms\Components\TextInput::make('email')->email(),
                Forms\Components\TextInput::make('phone'),
                Forms\Components\TextInput::make('location'),
                Forms\Components\TextInput::make('website')->url(),
                Forms\Components\FileUpload::make('cv_file')
                    ->acceptedFileTypes(['application/pdf'])
                    ->disk('public')
                    ->directory('cv'),
            ])->columns(2),

            Forms\Components\Section::make('Hero Section')->schema([
                Forms\Components\TextInput::make('hero_intro')->maxLength(100),
                Forms\Components\TextInput::make('hero_heading')->maxLength(100),
                Forms\Components\Textarea::make('hero_description')->rows(3),
            ]),

            Forms\Components\Section::make('Site Settings')->schema([
                Forms\Components\TextInput::make('site_title')->maxLength(255),
                Forms\Components\Textarea::make('meta_description')->rows(3),
                Forms\Components\ColorPicker::make('accent_color'),
                Forms\Components\FileUpload::make('logo')->image()->disk('public')->directory('site'),
                Forms\Components\FileUpload::make('favicon')->image()->disk('public')->directory('site'),
            ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('profile_image')->circular(),
                Tables\Columns\TextColumn::make('full_name'),
                Tables\Columns\TextColumn::make('professional_title'),
                Tables\Columns\TextColumn::make('email'),
            ])
            ->actions([Tables\Actions\EditAction::make()]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListProfileSettings::route('/'),
            'create' => Pages\CreateProfileSetting::route('/create'),
            'edit'   => Pages\EditProfileSetting::route('/{record}/edit'),
        ];
    }
}
