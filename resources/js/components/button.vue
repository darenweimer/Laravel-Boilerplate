<template>
    <button class="border rounded font-normal text-sm px-3 py-1 transition focus:outline-none disabled:opacity-25" :class="getExtClasses(action)">
        <slot/>
    </button>
</template>

<script>
    export default {
        props: {
            action: {
                type: String,
                default: 'submit',
            },
        },

        methods: {
            getExtClasses: (action) =>
                ' border-button-' + action +
                ' bg-button-' + action +
                ' hover:bg-button-' + action + '-hover' +
                ' active:bg-button-' + action + '-active' +
                ' text-button-' + action,
        },
    };
</script>
