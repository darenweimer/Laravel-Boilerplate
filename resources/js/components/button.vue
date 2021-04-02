<template>
    <button :type="btnType" class="border focus:outline-none font-normal px-3 py-1 transition disabled:opacity-25" :class="btnClasses">
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
            small: {
                type: Boolean,
                default: false,
            },
            round: {
                type: Boolean,
                default: false,
            },
        },

        data() {
            return {
                btnType:
                    (this.action === 'submit') ? 'submit' : 'button',
                btnClasses:
                    ' border-button-' + this.action +
                    ' bg-button-' + this.action +
                    ' hover:bg-button-' + this.action + '-hover' +
                    ' active:bg-button-' + this.action + '-active' +
                    ' text-button-' + this.action +
                    (this.small ? ' text-xs' : ' text-sm') +
                    (this.round ? ' rounded-full' : ' rounded'),
            };
        },
    };
</script>
