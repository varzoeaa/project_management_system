<?php

namespace App\Models;

use Filament\Forms\Components\BelongsToSelect;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Parallax\FilamentComments\Models\Traits\HasFilamentComments;

class Task extends Model
{
    use HasFactory;
    use HasFilamentComments;

    protected $casts = [
        'deadline' => 'datetime',
        'project_id' => 'integer',
        'status' => 'string',
        'priority' => 'string',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function notes()
    {
        return $this->hasMany(TaskNote::class);
    }

    public function assignees()
    {
        return $this->hasMany(TaskAssignee::class);
    }

    public function categories()
    {
        return $this->hasMany(TaskCategory::class);
    }

    public static function getForm()
    {
        return [
            TextInput::make('name')
                ->label('Title')
                ->required(),
            Textarea::make('description')
                ->label('Description')
                ->required(),
            Select::make('priority')
                ->label('Priority')
                ->options([
                    'low' => 'Low',
                    'medium' => 'Medium',
                    'high' => 'High',
                ])
                ->required(),
            DatePicker::make('deadline')
                ->label('Deadline')
                ->required(),
            Select::make('status')
                ->label('Status of the Task')
                ->options([
                    'active' => 'Active',
                    'inactive' => 'Inactive',
                    'done' => 'Done',
                    'on-hold' => 'On Hold',
                    'overdue' => 'Overdue',
                ])
                ->required(),
            BelongsToSelect::make('project_id')
                ->label('Project')
                ->relationship('project', 'name')
                ->required(),
        ];
    }
}
