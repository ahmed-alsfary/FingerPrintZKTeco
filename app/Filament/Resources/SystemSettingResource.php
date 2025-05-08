<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SystemSettingResource\Pages;
use App\Filament\Resources\SystemSettingResource\RelationManagers;
use App\Models\SystemSetting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SystemSettingResource extends Resource
{
    protected static ?string $model = SystemSetting::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog';

    protected static ?string $navigationGroup = 'الإعدادات';

    protected static ?string $modelLabel = 'إعداد';

    protected static ?string $pluralModelLabel = 'إعدادات النظام';

    protected static ?string $navigationLabel = 'إعدادات النظام';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('fingerprint_ip')
                    ->required()
                    ->label('عنوان IP للبصمة')
                    ->ip()
                    ->maxLength(255),
                Forms\Components\TextInput::make('fingerprint_port')
                    ->required()
                    ->numeric()
                    ->label('منفذ البصمة')
                    ->maxLength(255),
                Forms\Components\TimePicker::make('system_time')
                    ->required()
                    ->label('وقت النظام'),
                Forms\Components\Select::make('timezone')
                    ->options([
                        'Asia/Riyadh' => 'توقيت الرياض',
                        'Asia/Dubai' => 'توقيت دبي',
                        'Asia/Baghdad' => 'توقيت بغداد',
                    ])
                    ->required()
                    ->label('المنطقة الزمنية'),
                Forms\Components\Select::make('status')
                    ->options([
                        'active' => 'نشط',
                        'inactive' => 'غير نشط',
                    ])
                    ->required()
                    ->label('الحالة'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('fingerprint_ip')
                    ->searchable()
                    ->label('عنوان IP للبصمة'),
                Tables\Columns\TextColumn::make('fingerprint_port')
                    ->numeric()
                    ->sortable()
                    ->label('منفذ البصمة'),
                Tables\Columns\TextColumn::make('system_time')
                    ->time()
                    ->sortable()
                    ->label('وقت النظام'),
                Tables\Columns\TextColumn::make('timezone')
                    ->searchable()
                    ->label('المنطقة الزمنية'),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'active' => 'success',
                        'inactive' => 'danger',
                    })
                    ->label('الحالة'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->label('تاريخ الإنشاء'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'active' => 'نشط',
                        'inactive' => 'غير نشط',
                    ])
                    ->label('الحالة'),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->label('تعديل'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make()
                    ->label('إضافة إعداد جديد'),
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
            'index' => Pages\ListSystemSettings::route('/'),
            'create' => Pages\CreateSystemSetting::route('/create'),
            'edit' => Pages\EditSystemSetting::route('/{record}/edit'),
        ];
    }
}
