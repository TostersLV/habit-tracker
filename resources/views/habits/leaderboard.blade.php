<x-app-layout>
    <div class="p-4 sm:p-12">
        <div class="max-w-2xl mx-auto bg-white p-4 sm:p-6 shadow-sm rounded-lg dark:bg-gray-800">
            <div class="flex items-center justify-between mb-4">
                <h3 class="flex-1 text-center font-bold text-lg">Leaderboard</h3>
                <div class="w-[60px]"></div>
            </div>
            <p class="text-sm mb-6">
                Ranked by completed good habits.
            </p>
            @if(($rows ?? collect())->isEmpty())
                <p class="text-gray-600 dark:text-gray-200">No users yet.</p>
            @else
                <div class="space-y-3">
                    @foreach($rows as $index => $row)
                        <div class="flex items-center justify-between border rounded-lg px-3 sm:px-4 py-3 dark:border-gray-700">
                            <div class="flex items-center gap-2 sm:gap-3 min-w-0">
                                <span class="font-semibold text-gray-600 dark:text-gray-300 shrink-0">#{{ $index + 1 }}</span>
                                <span class="text-gray-900 dark:text-white truncate">{{ $row['user']->name }}</span>
                            </div>
                            <div class="text-gray-700 dark:text-gray-200 shrink-0 ml-2">
                                {{ $row['good_habit_completions'] }}
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>