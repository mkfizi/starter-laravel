@props([
    'text' => __('This is a tooltip example.'),
])

<div class="relative w-fit"
    x-data="{
        open: false,
        placement: 'top',
        arrowLeft: '50%',
        scrollHandler: null,
        resizeHandler: null,
        updatePlacement() {
            setTimeout(() => {
                const anchor = $refs.anchor.getBoundingClientRect();
                const tooltip = $refs.tooltip.getBoundingClientRect();
                this.placement = (tooltip.top < anchor.top) ? 'top' : 'bottom';
                
                // Calculate arrow position to point at anchor center
                const anchorCenter = anchor.left + (anchor.width / 2);
                const tooltipLeft = tooltip.left;
                const arrowPosition = anchorCenter - tooltipLeft;
                this.arrowLeft = arrowPosition + 'px';
            }, 10);
        },
        mouseEnter() {
            this.open = true; 
            this.$nextTick(() => this.updatePlacement());
            window.addEventListener('scroll', this.scrollHandler); 
            window.addEventListener('resize', this.resizeHandler);
        },
        mouseLeave() {
            this.open = false; 
            window.removeEventListener('scroll', this.scrollHandler); 
            window.removeEventListener('resize', this.resizeHandler);
        },
        init() {
            this.scrollHandler = () => this.updatePlacement();
            this.resizeHandler = () => this.updatePlacement();
        }
    }"
    x-on:mouseenter="mouseEnter()"
    x-on:mouseleave="mouseLeave()"
>
    <span x-ref="anchor">
        {{ $slot }}
    </span>
    <div 
        x-ref="tooltip"
        class="left-1/2 z-10 absolute bg-black dark:bg-white shadow-lg px-2 py-1 rounded"
        x-show="open" 
        x-cloak
        x-anchor.top.offset.8="$refs.anchor"
    >
        <span class="left-1/2 absolute bg-black dark:bg-white border-transparent w-2 h-2 rotate-45 -translate-x-1/2"
            :style="`left: ${arrowLeft}`"
            :class="{
                    '-bottom-1 border-b border-l': placement === 'top',
                '-top-1 border-t border-r': placement === 'bottom'
            }"
        ></span>
        <span class="text-white dark:text-black text-xs whitespace-nowrap">{{ $text }}</span>
    </div>
</div>