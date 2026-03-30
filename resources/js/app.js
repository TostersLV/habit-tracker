import './bootstrap';
import renderHabitsChart from './chart';
import { Livewire, Alpine } from '../../vendor/livewire/livewire/dist/livewire.esm';

const chartElement = document.getElementById('chart');
if (chartElement) {
    const goodSeries = JSON.parse(chartElement.dataset.good ?? '[]');
    const badSeries = JSON.parse(chartElement.dataset.bad ?? '[]');
    renderHabitsChart(goodSeries, badSeries);
}

window.Alpine = Alpine;
Livewire.start();

function getPreferredTheme() {
    const stored = localStorage.getItem('color-theme');
    if (stored === 'dark' || stored === 'light') return stored;

    if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
        return 'dark';
    }

    return 'light';
}

function applyTheme(theme) {
    if (theme === 'dark') {
        document.documentElement.classList.add('dark');
    } else {
        document.documentElement.classList.remove('dark');
    }
}

function updateThemeToggleIcons() {
    const isDark = document.documentElement.classList.contains('dark');

    const darkIcons = document.querySelectorAll('[id^="theme-toggle-dark-icon"]');
    const lightIcons = document.querySelectorAll('[id^="theme-toggle-light-icon"]');

    darkIcons.forEach(icon => icon.classList.toggle('hidden', isDark));
    lightIcons.forEach(icon => icon.classList.toggle('hidden', !isDark));
}

function initTheme() {
    const preferred = getPreferredTheme();
    applyTheme(preferred);
    updateThemeToggleIcons();
}


initTheme();

document.addEventListener('click', (event) => {
   
    const toggleButton = event.target.closest('[id^="theme-toggle"]');
    if (!toggleButton) return;

    const isCurrentlyDark = document.documentElement.classList.contains('dark');
    const nextTheme = isCurrentlyDark ? 'light' : 'dark';

    applyTheme(nextTheme);
    localStorage.setItem('color-theme', nextTheme);
    updateThemeToggleIcons();
});

document.addEventListener('livewire:navigated', () => {
    initTheme(); 
});