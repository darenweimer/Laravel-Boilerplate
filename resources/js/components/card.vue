<template>
    <div :class="`rounded-lg bg-card-${color} font-default font-normal text-base text-card-${color} tracking-wide p-0 overflow-hidden`">
        <div v-if="$slots.header" class="font-black text-xl px-4 py-3">
            <slot name="header">
            </slot>
        </div>

        <div class="bg-white bg-opacity-10 p-4">
            <slot>
            </slot>
        </div>

        <div v-if="$slots.footer" class="p-4">
            <slot name="footer">
            </slot>
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
