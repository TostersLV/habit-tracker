<x-app-layout>
    <div class="p-12">
        <div class="flex gap-10">
            <div class="w-1/2 bg-white p-6 shadow-sm rounded-lg dark:bg-gray-800">
                <h3 class="font-bold text-lg mb-4">Good Habits</h3>
                @forelse($goodHabits as $habit)
                    @php $isCompleted = $habit->habitLogs()->whereDate('completed_at', now())->exists(); @endphp
                    
                    <div class="mb-2 flex items-center gap-2">
                        @if($isCompleted)
                            <form method="POST" action="/habits/{{ $habit->id }}/completed">
                                @csrf
                                <input type="hidden" name="completed" value="0">
                                <input type="checkbox" checked onchange="this.form.submit()">
                            </form>
                        @else
                            <input type="checkbox" class="js-open-mood" data-habit-id="{{ $habit->id }}">
                        @endif
                        <span class="flex-1">{{ $habit->name }}</span>

                        <form method="POST" action="{{ route('habits.destroy', $habit) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-2 text-lg leading-none text-gray-400 hover:text-red-600 focus:outline-none" aria-label="Delete habit" title="Delete">
                                &times;
                            </button>
                        </form>
                    </div>
                @empty
                    <p class="text-sm ">No good habits added</p>
                @endforelse
            </div>

            <div class="w-1/2 bg-white p-6 shadow-sm rounded-lg dark:bg-gray-800">
                <h3 class="font-bold text-lg mb-4">Bad Habits</h3>
                @forelse($badHabits as $habit)
                    @php $isCompleted = $habit->habitLogs()->whereDate('completed_at', now())->exists(); @endphp
                    <div class="mb-2 flex items-center gap-2">
                        @if($isCompleted)
                            <form method="POST" action="/habits/{{ $habit->id }}/completed">
                                @csrf
                                <input type="hidden" name="completed" value="0">
                                <input type="checkbox" checked onchange="this.form.submit()">
                            </form>
                        @else
                            <input type="checkbox" class="js-open-mood" data-habit-id="{{ $habit->id }}">
                        @endif
                        <span class="flex-1 text-gray-700 dark:text-gray-200">{{ $habit->name }}</span>

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

        <div id="moodModal" class="hidden fixed inset-0 bg-gray-900/50 flex items-center justify-center z-50">
            <div class="bg-white p-8 rounded-xl shadow-xl max-w-sm w-full dark:bg-gray-800">
                <h4 class="text-xl font-bold mb-4">How did you feel?</h4>
                
                <form id="moodForm" method="POST">
                    @csrf
                    <input type="hidden" name="completed" value="1">
                    
                    <div class="grid grid-cols-1 gap-3 mb-6">
                        @foreach($moods as $mood)
                            <label class="flex items-center p-3 border rounded-lg cursor-pointer dark:border-gray-700">
                                <input type="radio" name="mood_id" value="{{ $mood->id }}" class="mr-3" required>
                                <span>{{ $mood->name }}</span>
                            </label>
                        @endforeach
                    </div>

                    <div class="flex justify-end gap-2">
                        <button type="button" onclick="closeMoodPicker()" class="px-4 py-2 text-gray-500 dark:text-gray-300">Cancel</button>
                        <button type="submit" class="px-6 py-2 bg-zinc-600 text-white rounded-lg font-bold">Save</button>
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