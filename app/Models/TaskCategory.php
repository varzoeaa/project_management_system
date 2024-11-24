<?php

namespace App\Models;

use Filament\Forms\Components\BelongsToSelect;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TaskCategory extends Model
{
    use HasFactory;

    protected $casts = [
        'task_id' => 'integer',
    ];

    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class);
    }

    public static function getForm() 
    {
        return [
            BelongsToSelect::make('task_id')
                ->label('Task Name')
                ->relationship('task', 'name')
                ->required(),
            TextInput::make('name')
                ->label('Category Name')
                ->required(),
            Textarea::make('description')
                ->label('Description')
                ->required(),
        ];
    }
}
