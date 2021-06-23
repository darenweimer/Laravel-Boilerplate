<template>
    <button :type="type" class="border rounded font-medium text-sm tracking-wide px-2 py-1 transition focus:outline-none focus:ring focus:ring-button disabled:opacity-25" :class="`border-btn-${color} bg-btn-${color}-normal hover:bg-btn-${color}-hover active:bg-btn-${color}-active text-btn-${color}`">
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
