<template>
    <div v-if="visible">
        <div :class="`block w-full border border-alert-${color} rounded-md bg-alert-${color} font-medium text-sm text-alert-${color} px-4 py-2`">
            <div class="flex flex-row items-center">
                <div class="grow">
                    <slot/>
                </div>

                <div v-if="closeable" :class="`flex-none ml-4 border-l border-alert-${color} text-lg pl-4`">
                    <button type="button" class="focus:outline-none" @click="visible = false">
                        &times;
                    </button>
                </div>
            </div>
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
            closeable: {
                type: Boolean,
                default: true,
            },
            expiration: {
                type: Number,
                default: 0,
            },
        },
        data() {
            return {
                visible: true,
            };
        },
        mounted() {
            if (this.expiration > 0) {
                setTimeout(() => this.visible = false, this.expiration);
            }
        },
    };
</script>
