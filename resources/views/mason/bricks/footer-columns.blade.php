@props([
    'brand_name' => config('app.name', 'Protofoly'),
    'tagline' => 'A showcase of modern web engineering, bespoke design systems, and resilient full-stack applications. Crafted with Laravel 13, Filament v5, and Tailwind CSS.',
    'show_status_indicator' => true,
    'status_text' => 'All systems operating normally',
    'columns' => [],
])

<div class="border-t border-zinc-200/80 bg-white py-12 px-4 sm:px-6 lg:px-8 dark:border-zinc-800/80 dark:bg-zinc-950 transition-colors">
    <div class="mx-auto max-w-7xl">
        <div class="grid grid-cols-1 gap-8 md:grid-cols-4">
            <!-- Brand summary -->
            <div class="md:col-span-2 flex flex-col gap-3">
                <div class="flex items-center gap-2">
                    <span class="flex h-7 w-7 items-center justify-center rounded-lg bg-linear-to-br from-amber-500 to-orange-600 text-white text-xs font-bold">
                        {{ strtoupper(substr($brand_name, 0, 1)) }}
                    </span>
                    <span class="text-base font-bold text-zinc-900 dark:text-white">{{ $brand_name }}</span>
                </div>

                @if(filled($tagline))
                    <p class="max-w-md text-sm text-zinc-500 dark:text-zinc-400">
                        {{ $tagline }}
                    </p>
                @endif

                @if($show_status_indicator)
                    <div class="flex items-center gap-2 text-xs text-zinc-500 dark:text-zinc-400">
                        <span class="relative flex h-2 w-2">
                            <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-emerald-400 opacity-75"></span>
                            <span class="relative inline-flex h-2 w-2 rounded-full bg-emerald-500"></span>
                        </span>
                        <span>{{ $status_text }}</span>
                    </div>
                @endif
            </div>

            <!-- Dynamic Columns -->
            @foreach($columns as $col)
                <div>
                    <h3 class="text-xs font-semibold uppercase tracking-wider text-zinc-900 dark:text-white">
                        {{ $col['title'] ?? 'Links' }}
                    </h3>
                    <ul class="mt-3 flex flex-col gap-2 text-sm text-zinc-600 dark:text-zinc-400">
                        @foreach($col['links'] ?? [] as $link)
                            <li>
                                <a
                                    href="{{ $link['url'] ?? '#' }}"
                                    @if(!empty($link['is_external'])) target="_blank" rel="noopener noreferrer" @endif
                                    class="transition hover:text-amber-500 dark:hover:text-amber-400"
                                >
                                    {{ $link['label'] ?? '' }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>
    </div>
</div>
