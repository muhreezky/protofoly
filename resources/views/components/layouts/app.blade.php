<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ isset($title) ? $title : config('app.name', 'Protofoly') . ' - Digital Portfolio & Showcase' }}</title>
        <meta name="description" content="{{ $metaDescription ?? 'Protofoly is an independent portfolio and creative showcase platform featuring high-impact web design, engineering, and digital prototypes.' }}">

        <!-- Open Graph / Meta -->
        <meta property="og:type" content="website">
        <meta property="og:title" content="{{ isset($title) ? $title : config('app.name', 'Protofoly') . ' - Digital Portfolio & Showcase' }}">
        <meta property="og:description" content="{{ $metaDescription ?? 'Protofoly is an independent portfolio and creative showcase platform featuring high-impact web design, engineering, and digital prototypes.' }}">
        <meta property="og:url" content="{{ url()->current() }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

        <!-- Script to initialize dark mode before render to avoid FOUC -->
        <script>
            if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        </script>

        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Mason Styles -->
        @masonStyles

        @stack('styles')
    </head>
    <body class="min-h-screen bg-zinc-50 text-zinc-900 antialiased selection:bg-amber-500 selection:text-white dark:bg-zinc-950 dark:text-zinc-100 transition-colors duration-200">
        <!-- Site Header / Navbar -->
        <x-layouts.header />

        <!-- Main Content Area -->
        <main id="main-content" class="relative overflow-hidden">
            {{ $slot ?? '' }}
            @yield('content')
        </main>

        <!-- Site Footer -->
        <x-layouts.footer />

        @stack('scripts')
    </body>
</html>
