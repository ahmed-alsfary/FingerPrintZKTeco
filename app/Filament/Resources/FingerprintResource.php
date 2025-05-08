<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FingerprintResource\Pages;
use App\Filament\Resources\FingerprintResource\RelationManagers;
use App\Models\Fingerprint;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FingerprintResource extends Resource
{
    protected static ?string $model = Fingerprint::class;

    protected static ?string $navigationIcon = 'heroicon-o-finger-print';

    protected static ?string $navigationGroup = 'إدارة الموظفين';

    protected static ?string $modelLabel = 'بصمة';

    protected static ?string $pluralModelLabel = 'البصمات';

    protected static ?string $navigationLabel = 'البصمات';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('employee_id')
                    ->relationship('employee', 'name')
                    ->required()
                    ->label('الموظف'),
                Forms\Components\Textarea::make('fingerprint_data')
                    ->required()
                    ->label('بيانات البصمة')
                    ->maxLength(65535)
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('fingerprint_number')
                    ->required()
                    ->numeric()
                    ->label('رقم البصمة'),
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
                Tables\Columns\TextColumn::make('employee.name')
                    ->searchable()
                    ->label('الموظف'),
                Tables\Columns\TextColumn::make('fingerprint_number')
                    ->numeric()
                    ->sortable()
                    ->label('رقم البصمة'),
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
                Tables\Actions\DeleteAction::make()
                    ->label('حذف'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->label('حذف المحدد'),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make()
                    ->label('إضافة بصمة جديدة'),
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
            'index' => Pages\ListFingerprints::route('/'),
            'create' => Pages\CreateFingerprint::route('/create'),
            'edit' => Pages\EditFingerprint::route('/{record}/edit'),
        ];
    }
}
