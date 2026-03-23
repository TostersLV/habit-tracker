<x-app-layout>
    <x-slot name="header">
        
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 bg-white shadow sm:p-8  sm:rounded-lg dark:bg-gray-800">
                <h2 class="text-lg font-medium">FAQ</h2>

                <div class="mt-6 divide-y divide-gray-200 dark:divide-gray-700">
                    <div class="py-4" data-accordion-item>
                        <button type="button" class="w-full flex cursor-pointer items-center justify-between text-left font-medium" data-accordion-trigger aria-expanded="false" aria-controls="accordion-panel-1">
                            <span>How does this app work?</span>
                            <div data-accordion-icon>+</div>
                        </button>
                        <div id="accordion-panel-1" class="mt-3 text-sm hidden" data-accordion-panel>
                            Create a habit, then start doing them daily, mark them complete and in the future you can look back how far you've come!
                        </div>
                    </div>

                    <div class="py-4" data-accordion-item>
                        <button type="button" class="w-full flex cursor-pointer items-center justify-between text-left font-medium" data-accordion-trigger aria-expanded="false" aria-controls="accordion-panel-2">
                            <span>Will it help me do my habits more often?</span>
                            <div data-accordion-icon>+</div>
                        </button>
                        <div id="accordion-panel-2" class="mt-3 text-sm hidden" data-accordion-panel>
                            It will definitely, seeing your progress everyday and stastitics you'll be more motivated to the good habits!
                        </div>
                    </div>

                    <div class="py-4" data-accordion-item>
                        <button type="button" class="w-full flex cursor-pointer items-center justify-between text-left font-medium text-gray-900 dark:text-gray-100" data-accordion-trigger aria-expanded="false" aria-controls="accordion-panel-3">
                            <span>What happens if I miss days?</span>
                            <div data-accordion-icon>+</div>
                        </button>
                        <div id="accordion-panel-3" class="mt-3 text-sm hidden" data-accordion-panel>
                            If you miss a good habit for 2 days in a row youll get an email notification.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        (function () {
            const triggers = document.querySelectorAll('[data-accordion-trigger]');

            triggers.forEach((trigger) => {
                trigger.addEventListener('click', () => {
                    const item = trigger.closest('[data-accordion-item]');
                    const panel = item?.querySelector('[data-accordion-panel]');
                    const icon = item?.querySelector('[data-accordion-icon]');

                    if (!panel) return;

                    const isOpen = !panel.classList.contains('hidden');
                    panel.classList.toggle('hidden', isOpen);
                    trigger.setAttribute('aria-expanded', String(!isOpen));
                    if (icon) icon.textContent = isOpen ? '+' : '-';
                });
            });
        })();
    </script>
</x-app-layout>
