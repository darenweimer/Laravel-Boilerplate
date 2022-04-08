<template>
    <label v-if="enabled" class="block w-full font-default font-medium tracking-wide" :class="{ 'mb-1 text-base': !footnote, 'mt-1 text-sm': footnote, 'text-default': (!footnote) && (valid === null), 'text-info': footnote && (valid === null), 'text-success': valid === true, 'text-error': valid === false }">
        <slot>
        </slot>
    </label>
</template>

<script>
    export default {
        props: {
            enabled: {
                type: Boolean,
                default: true,
            },
            footnote: {
                type: Boolean,
                default: false,
            },
            valid: {
                type: Boolean,
                default: null,
            },
        },
    };
</script>
