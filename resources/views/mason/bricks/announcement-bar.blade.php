@props([
    'badge' => 'NEW',
    'message' => 'Protofoly v1.0 is officially released! Explore creative digital prototypes.',
    'link_label' => 'Learn more →',
    'link_url' => '/#work',
    'theme' => 'amber',
    'is_dismissible' => false,
])

@php
    $themeClasses = match($theme) {
        'emerald' => 'bg-emerald-600 text-white dark:bg-emerald-700',
        'indigo' => 'bg-indigo-600 text-white dark:bg-indigo-700',
        'dark' => 'bg-zinc-900 text-zinc-100 border-b border-zinc-800 dark:bg-zinc-950',
        default => 'bg-linear-to-r from-amber-500 via-orange-500 to-amber-600 text-white shadow-xs',
    };

    $badgeClasses = match($theme) {
        'emerald' => 'bg-white/20 text-white',
        'indigo' => 'bg-white/20 text-white',
        'dark' => 'bg-amber-500/20 text-amber-400',
        default => 'bg-white/25 text-white',
    };
@endphp

<div
    @if($is_dismissible) x-data="{ open: true }" x-show="open" x-cloak @endif
    class="relative z-40 w-full py-2.5 px-4 text-xs font-medium {{ $themeClasses }}"
>
    <div class="mx-auto flex max-w-7xl items-center justify-center gap-2 sm:gap-3 text-center">
        @if(filled($badge))
            <span class="inline-flex items-center rounded-full px-2 py-0.5 text-[10px] font-bold uppercase tracking-wider {{ $badgeClasses }}">
                {{ $badge }}
            </span>
        @endif

        <span class="truncate sm:overflow-visible sm:whitespace-normal">
            {{ $message }}
        </span>

        @if(filled($link_label) && filled($link_url))
            <a href="{{ $link_url }}" class="inline-flex items-center gap-1 font-semibold underline underline-offset-2 hover:opacity-85 transition">
                <span>{{ $link_label }}</span>
            </a>
        @endif

        @if($is_dismissible)
            <button
                type="button"
                @click="open = false"
                class="absolute right-3 top-1/2 -translate-y-1/2 p-1 text-white/80 hover:text-white transition"
                aria-label="Dismiss banner"
            >
                <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
        @endif
    </div>
</div>
