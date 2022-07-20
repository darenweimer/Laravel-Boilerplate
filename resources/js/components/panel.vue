<template>
    <div class="w-full px-5 py-4 overflow-hidden rounded-lg bg-default font-default font-normal text-base text-default tracking-wide">
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
</template>
