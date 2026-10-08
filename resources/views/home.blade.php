<x-layouts.app :title="$title ?? config('app.name', 'Protofoly')">
    @if(isset($blocks) && !empty($blocks))
        @mason($blocks)
    @elseif(isset($content) && !empty($content))
        @mason($content)
    @else
        <!-- Starter Canvas (Placeholder until Mason blocks are added) -->
        <section class="relative overflow-hidden py-24 sm:py-32">
            <!-- Subtle Ambient Background Glow -->
            <div class="pointer-events-none absolute inset-0 -z-10 flex items-center justify-center">
                <div class="h-96 w-96 rounded-full bg-linear-to-tr from-amber-500/15 to-orange-500/10 blur-3xl dark:from-amber-600/10 dark:to-orange-600/5"></div>
            </div>

            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="mx-auto max-w-2xl text-center">
                    <div class="inline-flex items-center gap-2 rounded-full border border-amber-500/30 bg-amber-50/80 px-3.5 py-1 text-xs font-medium text-amber-800 shadow-sm backdrop-blur-sm dark:border-amber-400/20 dark:bg-amber-950/40 dark:text-amber-300">
                        <span class="relative flex h-2 w-2">
                            <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-amber-400 opacity-75"></span>
                            <span class="relative inline-flex h-2 w-2 rounded-full bg-amber-500"></span>
                        </span>
                        <span>Mason Page Builder Ready</span>
                    </div>

                    <h1 class="mt-6 text-4xl font-extrabold tracking-tight text-zinc-900 sm:text-5xl dark:text-white">
                        {{ config('app.name', 'Protofoly') }}
                    </h1>

                    <p class="mt-4 text-base leading-relaxed text-zinc-600 dark:text-zinc-400">
                        This homepage is ready to be customized using Mason blocks. Once blocks are configured and saved, they will render directly on this page.
                    </p>

                    <div class="mt-8 flex items-center justify-center gap-4">
                        <a href="{{ url('/dashboard') }}" class="inline-flex items-center gap-2 rounded-xl bg-zinc-900 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-zinc-800 dark:bg-white dark:text-zinc-900 dark:hover:bg-zinc-100">
                            <svg class="h-4 w-4 text-amber-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect width="7" height="9" x="3" y="3" rx="1"></rect>
                                <rect width="7" height="5" x="14" y="3" rx="1"></rect>
                                <rect width="7" height="9" x="14" y="12" rx="1"></rect>
                                <rect width="7" height="5" x="3" y="16" rx="1"></rect>
                            </svg>
                            <span>Open Dashboard</span>
                        </a>
                    </div>
                </div>
            </div>
        </section>
    @endif
</x-layouts.app>
