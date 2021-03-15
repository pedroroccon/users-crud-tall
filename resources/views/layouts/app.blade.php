<x-base :title="$title">

    <body>
        <x-nav></x-nav>
        <x-header>{{ $title ?? config('app.name') }}</x-header>
        
        <main>
            <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
                {{ $slot }}
            </div>
        </main>
    </body>

    {{ $scripts ?? '' }}
</x-base>