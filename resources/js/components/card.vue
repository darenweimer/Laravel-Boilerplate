<template>
    <div :class="`rounded-lg bg-card-${color} font-default font-normal text-base text-card-${color} tracking-wide p-0 overflow-hidden`">
        <div v-if="$slots.header" class="font-black text-xl px-4 py-3">
            <slot name="header">
            </slot>
        </div>

        <div class="p-4" :class="bodyClass">
            <slot>
            </slot>
        </div>

        <div v-if="$slots.footer" class="p-4">
            <slot name="footer">
            </slot>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            color: {
                type: String,
                default: 'default',
            },
            box: {
                type: Boolean,
                default: false,
            },
            wall: {
                type: String,
                default: '4',
            },
        },
        computed: {
            bodyClass() {
                if (this.box) {
                    let bodyClass = `border-x-${this.wall} border-card-${this.color} bg-default text-default`;

                    if (!this.$slots.header) {
                        bodyClass += ` border-t-${this.wall} rounded-t-lg`;
                    }

                    if (!this.$slots.footer) {
                        bodyClass += ` border-b-${this.wall} rounded-b-lg`;
                    }

                    return bodyClass;
                }

                return 'bg-white bg-opacity-[15%]';
            },
        },
    };
</script>
