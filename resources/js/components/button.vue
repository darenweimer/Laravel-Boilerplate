<template>
    <button :type="type" :class="`border border-btn-${color} rounded bg-btn-${color}-normal hover:bg-btn-${color}-hover active:bg-btn-${color}-active font-default font-medium text-sm text-btn-${color} tracking-wide uppercase px-2.5 py-1.5 transition focus:outline-none focus:ring focus:ring-button disabled:opacity-30`">
        <slot>
        </slot>
    </button>
</template>

<script>
    export default {
        props: {
            type: {
                type: String,
                default: 'button',
            },
            color: {
                type: String,
                default: 'default',
            },
        },
    };
</script>
