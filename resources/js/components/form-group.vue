<template>
    <div class="font-default font-normal text-base text-default tracking-wide" :class="{ 'contents': inline }">
        <div v-if="$slots.label" :class="{ 'h-full pt-1 border-t border-transparent': inline, 'pb-1': !inline }">
            <slot name="label">
            </slot>
        </div>

        <div>
            <div :class="{ 'mb-1': $slots.help || $slots.success || $slots.error }">
                <slot>
                </slot>
            </div>

            <div v-if="$slots.help" class="text-info text-sm">
                <slot name="help">
                </slot>
            </div>

            <div v-if="$slots.success" class="text-success text-sm">
                <slot name="success">
                </slot>
            </div>

            <div v-if="$slots.error" class="text-error text-sm">
                <slot name="error">
                </slot>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            inline: {
                type: Boolean,
                default: false,
            },
        },
    };
</script>
