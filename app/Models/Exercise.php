<?php

namespace App\Models;

use Database\Factories\ExerciseFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Exercise extends Model
{
    /** @use HasFactory<ExerciseFactory> */
    use HasFactory;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'workout_id',
        'name',
        'sets',
        'reps',
        'weight_kg',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'sets' => 'integer',
            'reps' => 'integer',
            'weight_kg' => 'decimal:2',
        ];
    }

    public function workout(): BelongsTo
    {
        return $this->belongsTo(Workout::class);
    }
}
