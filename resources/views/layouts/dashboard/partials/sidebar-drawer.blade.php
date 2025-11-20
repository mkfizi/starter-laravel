{{-- Sidebar Drawer --}}
<div class="top-0 left-0 flex flex-col bg-white dark:bg-neutral-950 border-neutral-200 dark:border-neutral-800 border-r w-full sm:w-64 h-full">
    {{-- Sidebar Close --}}
    <x-button-ghost type="button" class="lg:hidden lg:invisible top-2 right-2 absolute p-2!" aria-controls="sidebar" aria-label="Close sidebar."
        x-on:click="$dispatch('close-sidebar', { id: 'sidebar' })"
        ::aria-expanded="isSidebarOpen"
    >
        <x-icon>
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M18 6l-12 12"/><path d="M6 6l12 12"/></svg>
        </x-icon>
    </x-button-ghost>
    {{-- END Sidebar Close --}}
    <div class="px-4 sm:px-8 py-4">
        <x-nav-title />
    </div>
    <ul class="space-y-1 px-4 sm:px-8 pb-4 overflow-y-auto">
        @foreach (config('routes.dashboard') as $link)
            @if (isset($link['route']) && !isset($link['links']))
                <li>
                    <x-sidebar-nav-link
                        :active="request()->routeIs($link['active'] ?? $link['route'])"
                        :icon="isset($link['icon']) ? $link['icon'] : null"
                        :title="$link['title']"
                        :route="route($link['route'])"
                    />
                </li>
            @elseif(isset($link['href']))
                <li>
                    <x-sidebar-nav-external
                        :href="$link['href']"
                        :icon="isset($link['icon']) ? $link['icon'] : null"
                        :title="$link['title']"
                    />
                </li>
            @elseif(isset($link['links']))
                <li>
                    <x-sidebar-nav-collapse
                        :icon="isset($link['icon']) ? $link['icon'] : null"
                        :links="$link['links']"
                        :title="$link['title']"
                        :route="$link['route']"
                    />
                </li>
            @else
                <li>
                    <x-sidebar-nav-title :title="$link['title']" />
                </li>
            @endif
        @endforeach
    </ul>
</div>
{{-- END Sidebar Drawer --}}