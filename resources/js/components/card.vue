<template>
    <div class="border border-card rounded-lg p-0 overflow-hidden">
        <div v-if="$slots.header" class="border-b border-card bg-card-header font-normal text-lg px-4 py-3">
            <slot name="header"/>
        </div>
        <div class="bg-card-body px-4 py-3">
            <slot/>
        </div>
        <div v-if="$slots.footer" class="border-t border-card bg-card-footer px-4 py-3">
            <slot name="footer"/>
        </div>
    </div>
</template>
