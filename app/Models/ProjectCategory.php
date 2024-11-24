<?php

namespace App\Models;

use Filament\Forms\Components\BelongsToSelect;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProjectCategory extends Model
{
    use HasFactory;

    protected $casts = [
        'project_id' => 'integer',
    ];


    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function getForm()
    {
        return [
            BelongsToSelect::make('project_id')
                ->label('Project Name')
                ->relationship('project', 'name')
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
