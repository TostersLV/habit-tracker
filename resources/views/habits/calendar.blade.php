<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold mb-6 text-gray-800 dark:text-gray-100">Habit History (Last 28 Days)</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                
                @foreach($dates as $date => $data)
                    <div class="bg-white rounded-xl p-4 shadow-sm flex flex-col dark:bg-gray-800">
                        
                        <div class="pb-2 mb-3">
                            <span class="text-lg font-bold ">
                                {{ \Carbon\Carbon::parse($date)->format('D, M d') }}
                            </span>
                        </div>

                        <div class="flex gap-4 mb-4">
                            <span class="text-xs font-bold text-green-600 uppercase tracking-wider">
                                {{ $data['good_count'] }} Good
                            </span>
                            <span class="text-xs font-bold text-red-600 uppercase tracking-wider">
                                {{ $data['bad_count'] }} Bad
                            </span>
                        </div>

                        <div class="space-y-3">
                            @if(count($data['details']) > 0)
                                @foreach($data['details'] as $log)
                                    <div class="p-2 rounded {{ $log['type'] == 'good' ? 'bg-green-50 dark:bg-green-900' : 'bg-red-50 dark:bg-red-900' }}">
                                        <p class="text-sm font-bold text-gray-800 dark:text-gray-100">{{ $log['habit_name'] }}</p>
                                        <p class="text-xs text-gray-600 dark:text-gray-300">Feeling: {{ $log['mood'] }}</p>
                                    </div>
                                @endforeach
                            @else
                                <p class="text-xs">No habits done</p>
                            @endif
                        </div>

                    </div>
                @endforeach

            </div>
        </div>
    </div>
</x-app-layout>