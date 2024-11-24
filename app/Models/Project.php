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

class Project extends Model
{
    use HasFactory;
    use HasFilamentComments;

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'client_id' => 'integer',
    ];

    // client
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    // project notes
    public function notes()
    {
        return $this->hasMany(ProjectNote::class);
    }

    // project tasks
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    // project categories
    public function categories()
    {
        return $this->hasMany(ProjectCategory::class);
    }

    // projecc assignees
    public function assignees()
    {
        return $this->hasMany(ProjectAssignee::class);
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
            DatePicker::make('start_date')
                ->label('Start Date')
                ->required(),
            DatePicker::make('end_date')
                ->label('End Date')
                ->required(),
            Select::make('status')
                ->label('Status of The Project')
                ->options([
                    'active' => 'Active',
                    'inactive' => 'Inactive',
                    'done' => 'Done',
                    'on_hold' => 'On Hold',
                    'overdue' => 'Overdue',
                ])
                ->required(),
            BelongsToSelect::make('client_id')
                ->label('Client Name')
                ->relationship('client', 'name')
                ->required(),
        ];
    }
}
