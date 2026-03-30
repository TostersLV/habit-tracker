<x-app-layout>
    <div id="wrapper" class="flex flex-col items-center px-4 sm:px-6 pt-6 sm:pt-10">
        <h2 class="text-xl sm:text-2xl font-semibold mb-4 sm:mb-6">Habit Statistics</h2>
        <div class="flex flex-col sm:flex-row gap-4 sm:gap-6 justify-center mb-6 sm:mb-10 w-full sm:w-auto">
            <div class="bg-white rounded-2xl p-5 sm:p-8 text-center w-full sm:w-auto dark:bg-gray-800">
                <p class="text-sm text-gray-500 mb-1">Good Habits This Week</p>
                <p class="text-3xl sm:text-4xl font-bold text-green-500">{{ $weeklyStats['good_percent'] }}%</p>
            </div>
            <div class="bg-white rounded-2xl p-5 sm:p-8 text-center w-full sm:w-auto dark:bg-gray-800">
                <p class="text-sm text-gray-500 mb-1">Bad Habits This Week</p>
                <p class="text-3xl sm:text-4xl font-bold text-red-500">{{ $weeklyStats['bad_percent'] }}%</p>
            </div>
        </div>
        <div id="chart" class="w-full max-w-4xl overflow-x-auto"
             data-good='@json($goodSeries)'
             data-bad='@json($badSeries)'>
        </div>
    </div>
</x-app-layout>