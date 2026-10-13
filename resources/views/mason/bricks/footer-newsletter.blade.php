@props([
    'heading' => 'Subscribe to our newsletter',
    'subheading' => 'Receive monthly drops featuring cutting-edge prototypes, UI systems, and engineering insights.',
    'button_label' => 'Subscribe',
    'placeholder' => 'you@example.com',
])

<div class="border-t border-zinc-200/80 bg-zinc-50 py-12 px-4 sm:px-6 lg:px-8 dark:border-zinc-800/80 dark:bg-zinc-900/50 transition-colors">
    <div class="mx-auto max-w-7xl">
        <div class="relative overflow-hidden rounded-2xl bg-linear-to-br from-zinc-900 to-zinc-950 p-8 sm:p-12 text-white shadow-xl dark:from-zinc-900/90 dark:to-black">
            <!-- Subtle glow decoration -->
            <div class="pointer-events-none absolute -top-24 -right-24 h-64 w-64 rounded-full bg-amber-500/20 blur-3xl"></div>

            <div class="relative z-10 grid grid-cols-1 gap-8 lg:grid-cols-2 lg:items-center">
                <div>
                    <h3 class="text-2xl font-bold tracking-tight text-white sm:text-3xl">
                        {{ $heading }}
                    </h3>
                    @if(filled($subheading))
                        <p class="mt-2 max-w-xl text-sm text-zinc-400">
                            {{ $subheading }}
                        </p>
                    @endif
                </div>

                <form onsubmit="event.preventDefault(); alert('Thank you for subscribing!');" class="flex flex-col gap-3 sm:flex-row">
                    <input
                        type="email"
                        required
                        placeholder="{{ $placeholder }}"
                        class="w-full rounded-xl border border-zinc-700 bg-zinc-800/80 px-4 py-3 text-sm text-white placeholder-zinc-500 shadow-inner focus:border-amber-500 focus:outline-none focus:ring-2 focus:ring-amber-500/20"
                    />
                    <button
                        type="submit"
                        class="inline-flex shrink-0 items-center justify-center rounded-xl bg-linear-to-r from-amber-500 to-orange-600 px-6 py-3 text-sm font-semibold text-white shadow-md shadow-amber-500/20 transition hover:from-amber-600 hover:to-orange-700 focus:outline-none"
                    >
                        {{ $button_label }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
