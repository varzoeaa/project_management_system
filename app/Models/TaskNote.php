<?php

namespace App\Models;

use Filament\Forms\Components\BelongsToSelect;
use Filament\Forms\Components\Textarea;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TaskNote extends Model
{
    use HasFactory;


    protected $casts = [
        'task_id' => 'integer',
        'user_id' => 'integer',
    ];

    // task
    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    // user who made the note 
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function getForm()
    {
        return [
            BelongsToSelect::make('task_id')
                ->label('Task Name')
                ->relationship('task', 'name')
                ->required(),
            BelongsToSelect::make('user_id')
                ->label('User Name')
                ->relationship('user', 'name')
                ->required(),
            Textarea::make('title')
                ->label('Title')
                ->required(),
            Textarea::make('text')
                ->label('Note')
                ->required(),
        ];
    }
}
