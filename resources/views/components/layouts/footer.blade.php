<!-- Site Footer -->
<footer id="site-footer" class="border-t border-zinc-200/80 bg-white dark:border-zinc-800/80 dark:bg-zinc-950 transition-colors">
    <div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 gap-8 md:grid-cols-4">
            <!-- Brand summary -->
            <div class="md:col-span-2 flex flex-col gap-3">
                <div class="flex items-center gap-2">
                    <span class="flex h-7 w-7 items-center justify-center rounded-lg bg-linear-to-br from-amber-500 to-orange-600 text-white text-xs font-bold">P</span>
                    <span class="text-base font-bold text-zinc-900 dark:text-white">{{ config('app.name', 'Protofoly') }}</span>
                </div>
                <p class="max-w-md text-sm text-zinc-500 dark:text-zinc-400">
                    A showcase of modern web engineering, bespoke design systems, and resilient full-stack applications. Crafted with Laravel 13, Filament v5, and Tailwind CSS.
                </p>
                <div class="flex items-center gap-2 text-xs text-zinc-500 dark:text-zinc-400">
                    <span class="relative flex h-2 w-2">
                        <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-emerald-400 opacity-75"></span>
                        <span class="relative inline-flex h-2 w-2 rounded-full bg-emerald-500"></span>
                    </span>
                    <span>All systems operating normally</span>
                </div>
            </div>

            <!-- Navigation column -->
            <div>
                <h2 class="text-xs font-semibold uppercase tracking-wider text-zinc-900 dark:text-white">Navigation</h2>
                <ul class="mt-3 flex flex-col gap-2 text-sm text-zinc-600 dark:text-zinc-400">
                    <li><a href="{{ url('/#work') }}" class="transition hover:text-amber-500">Work</a></li>
                    <li><a href="{{ url('/#about') }}" class="transition hover:text-amber-500">About</a></li>
                    <li><a href="{{ url('/#contact') }}" class="transition hover:text-amber-500">Contact</a></li>
                </ul>
            </div>

            <!-- Workspace / Admin -->
            <div>
                <h2 class="text-xs font-semibold uppercase tracking-wider text-zinc-900 dark:text-white">Workspace</h2>
                <ul class="mt-3 flex flex-col gap-2 text-sm text-zinc-600 dark:text-zinc-400">
                    <li><a href="{{ url('/dashboard') }}" class="transition hover:text-amber-500">Filament Dashboard</a></li>
                    <li><a href="https://laravel.com" target="_blank" rel="noreferrer" class="transition hover:text-amber-500">Laravel 13 Ecosystem</a></li>
                    <li><a href="https://filamentphp.com" target="_blank" rel="noreferrer" class="transition hover:text-amber-500">Filament v5</a></li>
                    <li><a href="https://tailwindcss.com" target="_blank" rel="noreferrer" class="transition hover:text-amber-500">Tailwind CSS v4</a></li>
                </ul>
            </div>
        </div>

        <div class="mt-10 flex flex-col items-center justify-between gap-4 border-t border-zinc-200/80 pt-8 sm:flex-row dark:border-zinc-800/80">
            <p class="text-xs text-zinc-500 dark:text-zinc-400">
                &copy; {{ date('Y') }} {{ config('app.name', 'Protofoly') }}. All rights reserved.
            </p>
            <div class="flex items-center gap-5 text-zinc-400 dark:text-zinc-500">
                <a id="footer-github-link" href="https://github.com" target="_blank" rel="noreferrer" aria-label="GitHub profile" class="transition hover:text-zinc-900 dark:hover:text-white">
                    <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" clip-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.53 1.032 1.53 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"/></svg>
                </a>
                <a id="footer-twitter-link" href="https://twitter.com" target="_blank" rel="noreferrer" aria-label="Twitter X profile" class="transition hover:text-zinc-900 dark:hover:text-white">
                    <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                </a>
                <a id="footer-linkedin-link" href="https://linkedin.com" target="_blank" rel="noreferrer" aria-label="LinkedIn profile" class="transition hover:text-zinc-900 dark:hover:text-white">
                    <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" clip-rule="evenodd" d="M19 3a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h14m-.5 15.5v-5.3a3.26 3.26 0 0 0-3.26-3.26c-.85 0-1.84.52-2.28 1.3v-1.11h-2.79v8.37h2.79v-4.93c0-.77.62-1.4 1.39-1.4a1.4 1.4 0 0 1 1.4 1.4v4.93h2.75M6.88 8.56a1.68 1.68 0 0 0 1.68-1.68c0-.93-.75-1.69-1.68-1.69a1.69 1.69 0 0 0-1.69 1.69c0 .93.76 1.68 1.69 1.68m1.39 9.94v-8.37H5.5v8.37h2.77z"/></svg>
                </a>
            </div>
        </div>
    </div>
</footer>
