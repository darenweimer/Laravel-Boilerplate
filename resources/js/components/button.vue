<template>
    <button :type="type" :class="`focus:outline-none focus:ring focus:ring-input rounded bg-btn-${color}-normal hover:bg-btn-${color}-hover active:bg-btn-${color}-active font-default font-bold text-sm text-btn-${color} tracking-wide uppercase px-2.5 py-1.5 disabled:opacity-40 transition`">
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
