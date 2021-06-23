<template>
    <div v-if="visible">
        <div class="block w-full border rounded-md font-medium text-sm px-4 py-2" :class="`border-alert-${color} bg-alert-${color} text-alert-${color}`">
            <div class="flex flex-row items-center">
                <div class="flex-grow">
                    <slot/>
                </div>

                <div v-if="closeable" class="flex-none ml-4 border-l text-lg pl-4" :class="`border-alert-${color}`">
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
                default: null,
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
