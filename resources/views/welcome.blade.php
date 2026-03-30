<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased font-sans">
        <div class="relative min-h-screen bg-gray-50 text-black/50 dark:bg-black dark:text-white/50 selection:bg-[#FF2D20] selection:text-white">
            @if (Route::has('login'))
                <div class="absolute right-0 top-0 p-6">
                    <livewire:welcome.navigation />
                </div>
            @endif

            <main class="flex min-h-screen items-center justify-center px-6">
                <div class="w-full max-w-6xl">
                    <h1 class="mb-8 text-center text-4xl font-semibold text-black dark:text-white">BadHabits</h1>
                    
                    <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
                        <div class="rounded-lg bg-white p-6 text-black shadow-sm dark:bg-gray-900 dark:text-white">
                            <p>
                                Start tracking your good progress and acknowledging your bad habits.
                            </p>
                        </div>

                        <div class="rounded-lg bg-white p-6 text-black shadow-sm dark:bg-gray-900 dark:text-white">
                            <p>
                                Everything in one app, simple, fast and reliable. Miss 2 days of checking good habits, a warning will be sent out:)
                            </p>
                        </div>

                        <div class="rounded-lg bg-white p-6 text-black shadow-sm dark:bg-gray-900 dark:text-white">
                            <p>
                                Why us?
                            </p>
                            <p>
                                Other apps are complicated, slow and overall just not rewarding. But here you see everydays progress in the calendar and you can look back at the month and admire the hard work you put in.
                            </p>
                        </div>
                    </div>

                    @guest
                        @if (Route::has('register'))
                            <div class="mt-8 flex justify-center">
                                <a
                                    href="{{ route('register') }}"
                                    class="inline-flex items-center px-6 py-3 bg-purple-500 border border-transparent rounded-md font-semibold text-sm text-white uppercase tracking-widest hover:bg-purple-600 focus:bg-purple-600 active:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 transition ease-in-out duration-150"
                                >
                                    Start tracking!
                                </a>
                            </div>
                        @endif
                    @endguest
                </div>
            </main>
        </div>
    </body>
</html>
