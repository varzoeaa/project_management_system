<?php

namespace App\Models;

use Filament\Forms\Components\BelongsToSelect;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProjectAssignee extends Model
{
    use HasFactory;

    protected $casts = [
        'project_id' => 'integer',
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public static function getForm()
    {
        return [
            BelongsToSelect::make('project_id')
                ->label('Project Name')
                ->relationship('project', 'name')
                ->required(),
            TextInput::make('name')
                ->label('Assignee Name')
                ->required(),
        ];
    }
}
