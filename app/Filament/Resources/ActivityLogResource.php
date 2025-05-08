<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ActivityLogResource\Pages;
use App\Filament\Resources\ActivityLogResource\RelationManagers;
use App\Models\ActivityLog;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ActivityLogResource extends Resource
{
    protected static ?string $model = ActivityLog::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationGroup = 'إدارة الموظفين';

    protected static ?string $modelLabel = 'سجل نشاط';

    protected static ?string $pluralModelLabel = 'سجلات النشاط';

    protected static ?string $navigationLabel = 'سجلات النشاط';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('employee_id')
                    ->relationship('employee', 'name')
                    ->required()
                    ->label('الموظف'),
                Forms\Components\TextInput::make('activity')
                    ->required()
                    ->label('النشاط')
                    ->maxLength(255),
                Forms\Components\Textarea::make('details')
                    ->required()
                    ->label('التفاصيل')
                    ->maxLength(65535)
                    ->columnSpanFull(),
                Forms\Components\DatePicker::make('date')
                    ->required()
                    ->label('التاريخ'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('employee.name')
                    ->searchable()
                    ->label('الموظف'),
                Tables\Columns\TextColumn::make('activity')
                    ->searchable()
                    ->label('النشاط'),
                Tables\Columns\TextColumn::make('details')
                    ->searchable()
                    ->label('التفاصيل'),
                Tables\Columns\TextColumn::make('date')
                    ->date()
                    ->sortable()
                    ->label('التاريخ'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->label('تاريخ الإنشاء'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('employee')
                    ->relationship('employee', 'name')
                    ->label('الموظف'),
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
                    ->label('إضافة سجل نشاط جديد'),
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
            'index' => Pages\ListActivityLogs::route('/'),
            'create' => Pages\CreateActivityLog::route('/create'),
            'edit' => Pages\EditActivityLog::route('/{record}/edit'),
        ];
    }
}
