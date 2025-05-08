<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TaskResource\Pages;
use App\Filament\Resources\TaskResource\RelationManagers;
use App\Models\Task;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TaskResource extends Resource
{
    protected static ?string $model = Task::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';

    protected static ?string $navigationGroup = 'إدارة المهام';

    protected static ?string $modelLabel = 'مهمة';

    protected static ?string $pluralModelLabel = 'المهام';

    protected static ?string $navigationLabel = 'المهام';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('employee_id')
                    ->relationship('employee', 'name')
                    ->required()
                    ->label('الموظف'),
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->label('عنوان المهمة')
                    ->maxLength(255),
                Forms\Components\Textarea::make('description')
                    ->required()
                    ->label('وصف المهمة')
                    ->maxLength(65535)
                    ->columnSpanFull(),
                Forms\Components\Select::make('status')
                    ->options([
                        'pending' => 'معلق',
                        'in_progress' => 'قيد التنفيذ',
                        'completed' => 'مكتمل',
                    ])
                    ->required()
                    ->label('الحالة'),
                Forms\Components\DateTimePicker::make('due_date')
                    ->required()
                    ->label('تاريخ الاستحقاق'),
                Forms\Components\DateTimePicker::make('completed_at')
                    ->label('تاريخ الإكمال')
                    ->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('employee.name')
                    ->searchable()
                    ->label('الموظف'),
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->label('عنوان المهمة'),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'in_progress' => 'info',
                        'completed' => 'success',
                    })
                    ->label('الحالة'),
                Tables\Columns\TextColumn::make('due_date')
                    ->dateTime()
                    ->sortable()
                    ->label('تاريخ الاستحقاق'),
                Tables\Columns\TextColumn::make('completed_at')
                    ->dateTime()
                    ->sortable()
                    ->label('تاريخ الإكمال'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->label('تاريخ الإنشاء'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'pending' => 'معلق',
                        'in_progress' => 'قيد التنفيذ',
                        'completed' => 'مكتمل',
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
                    ->label('إضافة مهمة جديدة'),
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
            'index' => Pages\ListTasks::route('/'),
            'create' => Pages\CreateTask::route('/create'),
            'edit' => Pages\EditTask::route('/{record}/edit'),
        ];
    }
}
