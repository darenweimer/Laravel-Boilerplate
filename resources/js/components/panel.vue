<template>
    <div class="w-full">
        <div class="rounded-lg shadow-[0_7px_15px_rgb(0,0,0,0.25)] bg-default font-default font-normal text-base text-default tracking-wide px-5 py-4 overflow-hidden" :class="panelClass">
            <div v-if="$slots.header" class="mb-4 border-b border-default font-bold text-2xl text-title pb-4">
                <slot name="header">
                </slot>
            </div>

            <slot>
            </slot>

            <div v-if="$slots.footer" class="mt-4 border-t border-default pt-4">
                <slot name="footer">
                </slot>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            borderColor: {
                type: String,
                default: null,
            },
        },
        computed: {
            panelClass() {
                return this.borderColor
                    ? `border-4 border-${this.borderColor}`
                    : null;
            },
        },
    };
</script>
