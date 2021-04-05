<template>
    <button :type="type" class="border rounded font-medium text-sm px-3 py-1 transition focus:outline-none disabled:opacity-25" :class="getExtClasses(action)">
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
            action: {
                type: String,
                default: 'primary',
            },
        },
        methods: {
            getExtClasses: (action) =>
                ' border-btn-' + action +
                ' bg-btn-' + action +
                ' hover:bg-btn-' + action + '-hover' +
                ' active:bg-btn-' + action + '-active' +
                ' text-btn-' + action,
        },
    };
</script>
