<?php

namespace App\Models;

use GuzzleHttp\Psr7\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReminderMail;

class Habit extends Model
{
    /** @use HasFactory<\Database\Factories\HabitFactory> */
    use HasFactory;

    protected $fillable = ['user_id', 'name', 'type'];

      public function habitLogs(): HasMany
    {
        return $this->hasMany(HabitLog::class)->chaperone();
    }
      public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    // izsuta e-pastu ja 2 dienu laika nav bijis atzimets kads labs ieradums
    public static function checkGoodHabit(): void{

      $Habits = Habit::all();
      

      foreach($Habits as $habit){

          if($habit->type == "good"){
              if($habit->habitLogs()->where('completed_at', '>', Carbon::now()->subDays(2))->doesntExist() ){
                
                Mail::to($habit->user->email)->send(new ReminderMail($habit));
              }
            
          }

      }
      

    }
    
}
