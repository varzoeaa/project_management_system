<?php

namespace App\Models;

use Filament\Forms\Components\BelongsToSelect;
use Filament\Forms\Components\Textarea;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProjectNote extends Model
{
    use HasFactory;

    protected $casts = [
        'project_id' => 'integer',
        'user_id' => 'integer',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getForm()
    {
        return [
            BelongsToSelect::make('project_id')
                ->label('Project Name')
                ->relationship('project', 'name')
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
