<template>
    <div v-if="visible">
        <div class="block w-full border rounded-md font-medium text-sm text-center px-4 py-2" :class="classColor">
            <div class="flex flex-row items-center">
                <div class="flex-grow">
                    <slot/>
                </div>
                <div v-if="closebutton" class="flex-none ml-4 border-l text-lg pl-4" :class="'border-alert-' + color">
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
                default: 'primary',
            },
            closebutton: {
                type: Boolean,
                default: true,
            },
            lifetime: {
                type: Number,
                default: null,
            },
        },
        data() {
            return {
                visible: true,
            };
        },
        computed: {
            classColor() {
                return 'border-alert-' + this.color +
                    ' bg-alert-' + this.color +
                    ' text-alert-' + this.color;
            },
        },
        mounted() {
            if (this.lifetime > 0) {
                setTimeout(() => this.visible = false, this.lifetime);
            }
        },
    };
</script>
