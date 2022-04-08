<template>
    <div class="rounded-lg font-default font-normal text-base text-default tracking-wide p-0 overflow-hidden">
        <div v-if="$slots.header" class="bg-white bg-opacity-10 font-black text-xl text-title px-4 py-3">
            <slot name="header">
            </slot>
        </div>

        <div class="border-l-4 border-r-4 border-b-4 border-white border-opacity-10 rounded-b-lg bg-default p-4">
            <slot>
            </slot>
        </div>
    </div>
</template>
