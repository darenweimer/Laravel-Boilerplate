<template>
    <button :type="type" :class="`border border-btn-${color} rounded bg-btn-${color}-normal hover:bg-btn-${color}-hover active:bg-btn-${color}-active font-medium text-base text-btn-${color} tracking-wide px-2.5 py-1 transition focus:outline-none focus:ring focus:ring-button disabled:opacity-30`">
        <slot/>
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
