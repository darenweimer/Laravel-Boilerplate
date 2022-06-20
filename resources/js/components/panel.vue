<template>
    <div class="w-full overflow-hidden rounded-lg shadow-[0_7px_15px_rgb(0,0,0,0.25)] bg-canvas font-default font-normal text-base text-default tracking-wide">
        <div class="px-5 py-4 bg-white/[5%]">
            <div v-if="$slots.header" class="mb-4 pb-4 border-b border-default font-bold text-2xl text-title">
                <slot name="header">
                </slot>
            </div>

            <slot>
            </slot>

            <div v-if="$slots.footer" class="mt-4 pt-4 border-t border-default">
                <slot name="footer">
                </slot>
            </div>
        </div>
    </div>
</template>
