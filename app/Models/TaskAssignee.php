<?php

namespace App\Models;

use Filament\Forms\Components\BelongsToSelect;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskAssignee extends Model
{
    use HasFactory;
    
    protected $casts = [
        'task_id' => 'integer',
        'assignee_id' => 'integer',
    ];

    // task
    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    // task assignees
    public function assignees()
    {
        return $this->belongsTo(TaskAssignee::class);
    }

    public static function getForm() 
    {
        return [
            BelongsToSelect::make('task_id')
                ->label('Task Name')
                ->relationship('task', 'name')
                ->required(),
            TextColumn::make('name')
                ->label('Assignee Name')
                ->required(),
        ];
    }
}
