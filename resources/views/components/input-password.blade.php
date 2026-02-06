<div class="relative rounded overflow-hidden"
    x-data="{ isOpen: false }"
>
    <x-input ::type="isOpen ? 'text' : 'password'" {{ $attributes }} class="pr-10"/>
    <button type="button" @click="isOpen = !isOpen" class="right-0 absolute inset-y-0 flex items-center px-3 cursor-pointer" aria-label="Toggle show password">
        <span class="[&_svg]:stroke-black dark:[&_svg]:stroke-white [&_svg]:w-5 [&_svg]:h-5 shrink-0">
            <svg xmlns="http://www.w3.org/2000/svg" :class="{ 'block': isOpen, 'hidden': !isOpen }" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="icons-tabler-outline icon icon-tabler icon-tabler-eye-closed"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M21 9c-2.4 2.667 -5.4 4 -9 4c-3.6 0 -6.6 -1.333 -9 -4" /><path d="M3 15l2.5 -3.8" /><path d="M21 14.976l-2.492 -3.776" /><path d="M9 17l.5 -4" /><path d="M15 17l-.5 -4" /></svg>
            <svg xmlns="http://www.w3.org/2000/svg" class="hidden" :class="{ 'hidden': isOpen, 'block': !isOpen }" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="icons-tabler-outline icon icon-tabler icon-tabler-eye"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" /></svg>
        </span>
    </button>
</div>