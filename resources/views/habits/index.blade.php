<x-app-layout>
    <div class="p-4 sm:p-12">
        <div class="flex flex-col sm:flex-row gap-6 sm:gap-10">
            <div class="w-full sm:w-1/2 bg-white p-4 sm:p-6 shadow-sm rounded-lg dark:bg-gray-800">
                <h3 class="font-bold text-lg mb-4">Good Habits</h3>
                @forelse($goodHabits as $habit)
                    @php $isCompleted = $habit->habitLogs()->whereDate('completed_at', now())->exists(); @endphp
                    
                    <div class="mb-2 flex items-center gap-2">
                        @if($isCompleted)
                            <form method="POST" action="/habits/{{ $habit->id }}/completed">
                                @csrf
                                <input type="hidden" name="completed" value="0">
                                <input type="checkbox" checked onchange="this.form.submit()" class="w-5 h-5 cursor-pointer">
                            </form>
                        @else
                            <input type="checkbox" class="js-open-mood w-5 h-5 cursor-pointer" data-habit-id="{{ $habit->id }}">
                        @endif
                        <span class="flex-1 text-sm sm:text-base">{{ $habit->name }}</span>
 
                        <form method="POST" action="{{ route('habits.destroy', $habit) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-2 text-lg leading-none text-gray-400 hover:text-red-600 focus:outline-none" aria-label="Delete habit" title="Delete">
                                &times;
                            </button>
                        </form>
                    </div>
                @empty
                    <p class="text-sm">No good habits added</p>
                @endforelse
            </div>
 
            <div class="w-full sm:w-1/2 bg-white p-4 sm:p-6 shadow-sm rounded-lg dark:bg-gray-800">
                <h3 class="font-bold text-lg mb-4">Bad Habits</h3>
                @forelse($badHabits as $habit)
                    @php $isCompleted = $habit->habitLogs()->whereDate('completed_at', now())->exists(); @endphp
                    <div class="mb-2 flex items-center gap-2">
                        @if($isCompleted)
                            <form method="POST" action="/habits/{{ $habit->id }}/completed">
                                @csrf
                                <input type="hidden" name="completed" value="0">
                                <input type="checkbox" checked onchange="this.form.submit()" class="w-5 h-5 cursor-pointer">
                            </form>
                        @else
                            <input type="checkbox" class="js-open-mood w-5 h-5 cursor-pointer" data-habit-id="{{ $habit->id }}">
                        @endif
                        <span class="flex-1 text-sm sm:text-base text-gray-700 dark:text-gray-200">{{ $habit->name }}</span>
 
                        <form method="POST" action="{{ route('habits.destroy', $habit) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-2 text-lg leading-none text-gray-400 hover:text-red-600 focus:outline-none" aria-label="Delete habit" title="Delete">
                                &times;
                            </button>
                        </form>
                    </div>
                @empty
                    <p class="text-sm">No bad habits added</p>
                @endforelse
            </div>
        </div>
 
        <div id="moodModal" class="hidden fixed inset-0 bg-gray-900/50 flex items-center justify-center z-50 p-4">
            <div class="bg-white p-6 sm:p-8 rounded-xl shadow-xl w-full max-w-sm dark:bg-gray-800">
                <h4 class="text-xl font-bold mb-4">How did you feel?</h4>
                
                <form id="moodForm" method="POST">
                    @csrf
                    <input type="hidden" name="completed" value="1">
                    
                    <div class="grid grid-cols-1 gap-3 mb-6">
                        @foreach($moods as $mood)
                            <label class="flex items-center p-3 border rounded-lg cursor-pointer dark:border-gray-700">
                                <input type="radio" name="mood_id" value="{{ $mood->id }}" class="mr-3 w-4 h-4" required>
                                <span class="text-sm sm:text-base">{{ $mood->name }}</span>
                            </label>
                        @endforeach
                    </div>
 
                    <div class="flex justify-end gap-2">
                        <button type="button" onclick="closeMoodPicker()" class="px-4 py-2 text-sm sm:text-base text-gray-500 dark:text-gray-300">Cancel</button>
                        <button type="submit" class="px-6 py-2 bg-zinc-600 text-white rounded-lg font-bold text-sm sm:text-base">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
 
    <script>
        function openMoodPicker(habitId) {
            document.getElementById('moodForm').action = '/habits/' + habitId + '/completed';
            document.getElementById('moodModal').classList.remove('hidden');
        }
 
        function closeMoodPicker() {
            document.getElementById('moodModal').classList.add('hidden');
        }
 
        document.getElementById('moodModal').addEventListener('click', function(e) {
            if (e.target === this) closeMoodPicker();
        });
 
        document.querySelectorAll('.js-open-mood').forEach((checkbox) => {
            checkbox.addEventListener('click', (e) => {
                e.preventDefault();
                const habitId = checkbox.getAttribute('data-habit-id');
                openMoodPicker(habitId);
            });
        });
    </script>
</x-app-layout>