<template>
    <button :type="type" class="border rounded font-medium text-sm tracking-wide px-3 py-1 transition focus:outline-none focus:ring focus:ring-button disabled:opacity-25" :class="classAction">
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
        computed: {
            classAction() {
                return 'border-btn-' + this.action +
                    ' bg-btn-' + this.action +
                    ' hover:bg-btn-' + this.action + '-hover' +
                    ' active:bg-btn-' + this.action + '-active' +
                    ' text-btn-' + this.action;
            },
        },
    };
</script>
