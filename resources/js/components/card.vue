<template>
    <div :class="`border border-card-${color} rounded-lg font-default font-normal text-base p-0 overflow-hidden`">
        <div v-if="$slots.header" :class="`border-b border-card-${color} bg-card-${color}-header font-title font-medium text-xl text-card-${color}-header px-4 py-3`">
            <slot name="header"/>
        </div>

        <div :class="`bg-card-${color}-body text-card-${color}-body p-4`">
            <slot/>
        </div>

        <div v-if="$slots.footer" :class="`border-t border-card-${color} bg-card-${color}-footer text-card-${color}-footer p-4`">
            <slot name="footer"/>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            color: {
                type: String,
                default: 'default',
            },
        },
    };
</script>
