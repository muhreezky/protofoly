@props([
    'brand_name' => config('app.name', 'Protofoly'),
    'brand_badge' => 'v1.0',
    'brand_url' => '/',
    'links' => [],
    'show_theme_toggle' => true,
    'show_cta' => true,
    'cta_label' => "Let's Talk",
    'cta_url' => '/#contact',
    'is_sticky' => true,
    'is_glassmorphism' => true,
])

<!-- Customizable Header Navigation -->
<header
    id="site-header"
    @class([
        'w-full border-b border-zinc-200/80 transition-colors z-50 dark:border-zinc-800/80',
        'sticky top-0' => $is_sticky,
        'bg-zinc-50/80 backdrop-blur-md dark:bg-zinc-950/80' => $is_glassmorphism,
        'bg-zinc-50 dark:bg-zinc-950' => ! $is_glassmorphism,
    ])
>
    <div class="mx-auto flex h-16 max-w-7xl items-center justify-between px-4 sm:px-6 lg:px-8">
        <!-- Brand Logo -->
        <a id="nav-brand-link" href="{{ $brand_url }}" class="group flex items-center gap-2.5 text-lg font-semibold tracking-tight transition hover:opacity-90">
            <span class="flex h-9 w-9 items-center justify-center rounded-xl bg-linear-to-br from-amber-500 to-orange-600 text-white shadow-md shadow-amber-500/20 ring-1 ring-white/20 transition-transform group-hover:scale-105">
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <polygon points="12 2 2 7 12 12 22 7 12 2"></polygon>
                    <polyline points="2 17 12 22 22 17"></polyline>
                    <polyline points="2 12 12 17 22 12"></polyline>
                </svg>
            </span>
            <span class="flex items-center gap-1.5">
                <span class="font-bold tracking-tight text-zinc-900 dark:text-white">{{ $brand_name }}</span>
                @if(filled($brand_badge))
                    <span class="inline-flex items-center rounded-full bg-amber-500/10 px-1.5 py-0.5 text-[10px] font-medium text-amber-600 dark:bg-amber-400/10 dark:text-amber-400">{{ $brand_badge }}</span>
                @endif
            </span>
        </a>

        <!-- Desktop Navigation Links -->
        <nav id="desktop-nav" class="hidden md:flex md:items-center md:gap-7 text-sm font-medium text-zinc-600 dark:text-zinc-400">
            @foreach($links as $link)
                <a
                    href="{{ $link['url'] ?? '#' }}"
                    @if(!empty($link['is_external'])) target="_blank" rel="noopener noreferrer" @endif
                    class="transition hover:text-zinc-900 dark:hover:text-white"
                >
                    {{ $link['label'] ?? '' }}
                </a>
            @endforeach
        </nav>

        <!-- Actions / Controls -->
        <div class="flex items-center gap-3">
            @if($show_theme_toggle)
                <!-- Theme Toggle Button -->
                <button id="theme-toggle-btn" type="button" aria-label="Toggle dark mode" class="inline-flex h-9 w-9 items-center justify-center rounded-lg border border-zinc-200 text-zinc-600 transition hover:bg-zinc-100 hover:text-zinc-900 dark:border-zinc-800 dark:text-zinc-400 dark:hover:bg-zinc-900 dark:hover:text-white">
                    <svg id="theme-sun-icon" class="hidden h-4 w-4 dark:block" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="4"></circle>
                        <path d="M12 2v2"></path>
                        <path d="M12 20v2"></path>
                        <path d="m4.93 4.93 1.41 1.41"></path>
                        <path d="m17.66 17.66 1.41 1.41"></path>
                        <path d="M2 12h2"></path>
                        <path d="M20 12h2"></path>
                        <path d="m6.34 17.66-1.41 1.41"></path>
                        <path d="m19.07 4.93-1.41 1.41"></path>
                    </svg>
                    <svg id="theme-moon-icon" class="block h-4 w-4 dark:hidden" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9Z"></path>
                    </svg>
                </button>
            @endif

            @if($show_cta && filled($cta_label))
                <!-- Primary Contact CTA Button -->
                <a id="nav-cta-btn" href="{{ $cta_url }}" class="hidden md:inline-flex items-center justify-center rounded-lg bg-zinc-900 px-4 py-2 text-xs font-semibold text-white shadow-sm transition hover:bg-zinc-800 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-zinc-900 dark:bg-white dark:text-zinc-900 dark:hover:bg-zinc-100">
                    {{ $cta_label }}
                </a>
            @endif

            <!-- Mobile Menu Hamburger Button -->
            <button id="mobile-menu-btn" type="button" aria-label="Toggle navigation menu" aria-expanded="false" class="inline-flex h-9 w-9 items-center justify-center rounded-lg border border-zinc-200 text-zinc-600 transition hover:bg-zinc-100 hover:text-zinc-900 md:hidden dark:border-zinc-800 dark:text-zinc-400 dark:hover:bg-zinc-900 dark:hover:text-white">
                <svg id="mobile-menu-open-icon" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="4" x2="20" y1="12" y2="12"></line>
                    <line x1="4" x2="20" y1="6" y2="6"></line>
                    <line x1="4" x2="20" y1="18" y2="18"></line>
                </svg>
                <svg id="mobile-menu-close-icon" class="hidden h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" x2="6" y1="6" y2="18"></line>
                    <line x1="6" x2="18" y1="6" y2="18"></line>
                </svg>
            </button>
        </div>
    </div>

    <!-- Mobile Navigation Drawer -->
    <div id="mobile-menu" class="hidden border-b border-zinc-200 bg-white px-4 py-5 shadow-lg md:hidden dark:border-zinc-800 dark:bg-zinc-900">
        <nav class="flex flex-col gap-3">
            @foreach($links as $link)
                <a
                    href="{{ $link['url'] ?? '#' }}"
                    @if(!empty($link['is_external'])) target="_blank" rel="noopener noreferrer" @endif
                    class="rounded-md px-3 py-2 text-sm font-medium text-zinc-700 hover:bg-zinc-100 dark:text-zinc-300 dark:hover:bg-zinc-800"
                >
                    {{ $link['label'] ?? '' }}
                </a>
            @endforeach
            <div class="mt-2 flex flex-col gap-2 pt-2 border-t border-zinc-200 dark:border-zinc-800">
                @if($show_cta && filled($cta_label))
                    <a id="mobile-contact-cta" href="{{ $cta_url }}" class="flex items-center justify-center rounded-lg bg-amber-500 px-4 py-2.5 text-xs font-semibold text-white shadow-sm hover:bg-amber-600">
                        {{ $cta_label }}
                    </a>
                @endif
            </div>
        </nav>
    </div>
</header>
