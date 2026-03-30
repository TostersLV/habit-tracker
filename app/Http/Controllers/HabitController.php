<?php

namespace App\Http\Controllers;

use App\Models\Habit;
use App\Models\Mood;
use App\Models\HabitLog;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class HabitController extends Controller
{
    public function index(Request $request)
{
    $userId = $request->user()->id;
    $goodHabits = Habit::where('user_id', $userId)->where('type', 'good')->get();
    $badHabits = Habit::where('user_id', $userId)->where('type', 'bad')->get();
    
    
    $moods = Mood::all(); 

    return view('habits.index', compact('goodHabits', 'badHabits', 'moods'));
}

public function setCompletedToday(Request $request, $habitId)
{
    $currentDay = Carbon::today();
    $habit = Habit::findOrFail($habitId);

    if ($request->completed == "1") {
        
        HabitLog::updateOrCreate(
            ['habit_id' => $habit->id, 'completed_at' => $currentDay],
            ['mood_id' => $request->mood_id]
        );
    } else {
        HabitLog::where('habit_id', $habit->id)->whereDate('completed_at', $currentDay)->delete();
    }

    return redirect()->back();
}
// izveido ieradumu
    public function create(){
        return view("habits.create");
    }

    public function store(Request $request)
    {
        
        $request->validate([
            'name' => ['required', 'string', 'min:4', 'max:70'],
            'type' => ['required', 'in:good,bad'],
        ]);

       
        $habit = new Habit();
        $habit->user_id = $request->user()->id;
        $habit->name = $request->name;
        $habit->type = $request->type;
        $habit->save();

        return redirect()->route('index');
    }

   
// parada visu nepieciesamo informaciju kalendara
public function calendar(Request $request)
{
    $userId = $request->user()->id;
    $userHabitIds = Habit::where('user_id', $userId)->pluck('id');
    $allLogs = HabitLog::whereIn('habit_id', $userHabitIds)->with(['habit', 'mood'])->get();

    $logsByDate = [];

    foreach ($allLogs as $log) {
        $dateKey = Carbon::parse($log->completed_at)->format('Y-m-d');
        $logsByDate[$dateKey][] = $log;
    }

    $logsByDate = collect($logsByDate);

    $dates = [];
    for ($i = 0; $i < 28; $i++) {
    $days = now()->subDays($i)->format('Y-m-d');

    $dailyLogs = $logsByDate->get($days, collect());

    $goodCount = 0;
    $badCount = 0;
    $details = [];

    foreach ($dailyLogs as $log) {
        if ($log->habit->type == 'good') {
            $goodCount++;
        } else {
            $badCount++;
        }

        $details[] = [
            'habit_name' => $log->habit->name,
            'type'       => $log->habit->type,
            'mood'       => $log->mood->name
        ];
    }

    $dates[$days] = [
        'good_count' => $goodCount,
        'bad_count'  => $badCount,
        'details'    => $details
    ];
}

    return view('habits.calendar', compact('dates'));
}
// izdzes ieradumu
public function destroy(Request $request, Habit $habit)
{
    if ($habit->user_id !== $request->user()->id) {
        abort(403);
    }

    $habit->delete();

    return redirect()->back();
}
//leaderboard
public function leaderboard(){
    $rows = User::with(['habit.habitLogs'])
        ->get()
        ->map(function ($user) {
            $goodHabitCompletions = $user->habit
                ->where('type', 'good')
                ->sum(function ($habit) {
                    return $habit->habitLogs->count();
                });

            return [
                'user' => $user,
                'good_habit_completions' => $goodHabitCompletions,
            ];
        })->sortByDesc('good_habit_completions')->values();

    return view('habits.leaderboard', compact('rows'));
}
// stastistika
public function statitics(Request $request)
{
    $userId = $request->user()->id;
    $userHabitIds = Habit::where('user_id', $userId)->pluck('id');

    $logs = HabitLog::whereIn('habit_id', $userHabitIds)
        ->with('habit')
        ->whereBetween('completed_at', [now()->subDays(29)->startOfDay(), now()->endOfDay()])
        ->get();

    $goodSeries = [];
    $badSeries  = [];

    for ($i = 29; $i >= 0; $i--) {
        $date      = now()->subDays($i)->format('Y-m-d');
        $timestamp = now()->subDays($i)->startOfDay()->timestamp * 1000;

        $dayLogs = $logs->filter(fn($log) =>
            Carbon::parse($log->completed_at)->format('Y-m-d') === $date
        );

        $goodSeries[] = [$timestamp, $dayLogs->filter(fn($l) => $l->habit->type === 'good')->count()];
        $badSeries[]  = [$timestamp, $dayLogs->filter(fn($l) => $l->habit->type === 'bad')->count()];
    }

    
    $thisWeekLogs = $logs->filter(function ($log) {
    return Carbon::parse($log->completed_at)->between(
        now()->startOfWeek(),
        now()->endOfWeek()
    );
});

$total = $thisWeekLogs->count();
$goodCount = $thisWeekLogs->filter(fn($l) => $l->habit->type === 'good')->count();
$badCount  = $thisWeekLogs->filter(fn($l) => $l->habit->type === 'bad')->count();

$weeklyStats = [
    'good_percent' => $total > 0 ? round(($goodCount / $total) * 100) : 0,
    'bad_percent'  => $total > 0 ? round(($badCount  / $total) * 100) : 0,
];

return view('habits.chart', compact('goodSeries', 'badSeries', 'weeklyStats'));
}

}