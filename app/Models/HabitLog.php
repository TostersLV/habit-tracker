<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class HabitLog extends Model
{
    

    protected $fillable = ['habit_id', 'mood_id', 'completed_at'];

    protected $casts = [
        'completed_at' => 'date:Y-m-d',
    ];

      public function habit(): BelongsTo
    {
        return $this->belongsTo(Habit::class);
    }
    public function mood()
    {
        return $this->belongsTo(Mood::class, 'mood_id');
    }
}
