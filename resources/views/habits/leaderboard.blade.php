<x-app-layout>
	<div class="p-12">
		<div class="max-w-2xl mx-auto bg-white p-6 shadow-sm rounded-lg dark:bg-gray-800">
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
						<div class="flex items-center justify-between border rounded-lg px-4 py-3 dark:border-gray-700">
							<div class="flex items-center gap-3">
								<span class="font-semibold text-gray-600 dark:text-gray-300">#{{ $index + 1 }}</span>
								<span class="text-gray-900 dark:text-white">{{ $row['user']->name }}</span>
							</div>

							<div class="text-gray-700 dark:text-gray-200">
								{{ $row['good_habit_completions'] }}
							</div>
						</div>
					@endforeach
				</div>
			@endif
		</div>
	</div>
</x-app-layout>
