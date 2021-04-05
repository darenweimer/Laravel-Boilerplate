<template>
    <div class="border border-card rounded-lg font-normal text-base p-0 overflow-hidden">
        <div v-if="$slots.header" class="border-b border-card bg-card-header font-medium text-lg text-card-header px-4 py-3">
            <slot name="header"/>
        </div>
        <div class="bg-card-body text-card-body px-4 py-3">
            <slot/>
        </div>
        <div v-if="$slots.footer" class="border-t border-card bg-card-footer text-card-footer px-4 py-3">
            <slot name="footer"/>
        </div>
    </div>
</template>
