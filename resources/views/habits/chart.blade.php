<x-app-layout>
    <div id="wrapper" class="flex flex-col items-center pt-10">
        <h2 class="text-2xl font-semibold mb-6">Habit Statistics</h2>
        <div id="chart" class="w-full max-w-4xl"
             data-good='@json($goodSeries)'
             data-bad='@json($badSeries)'>
        </div>
    </div>
</x-app-layout>