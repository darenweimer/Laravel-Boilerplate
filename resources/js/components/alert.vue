<template>
    <transition leave-active-class="ease-in duration-300" leave-from-class="translate-x-0 opacity-100" leave-to-class="-translate-x-full opacity-0">
        <div v-if="show" :class="`block w-full rounded-md bg-alert-${color} font-default font-medium text-sm text-alert-${color} tracking-wide overflow-hidden`">
            <div class="flex flex-row items-stretch">
                <div v-if="iconClass" class="flex-none w-12 bg-black bg-opacity-10 backdrop-saturate-[1.25]">
                    <button type="button" class="w-full h-full text-lg" disabled>
                        <i :class="`${iconClass} fa-lg`"></i>
                    </button>
                </div>

                <div class="grow px-4 py-3">
                    <slot>
                    </slot>
                </div>

                <div v-if="closeable" class="flex-none w-10 bg-black bg-opacity-10 backdrop-saturate-[1.25]">
                    <button type="button" class="w-full h-full focus:outline-none text-xl" @click="show = false">
                        &times;
                    </button>
                </div>
            </div>
        </div>
    </transition>
</template>

<script>
    export default {
        props: {
            color: {
                type: String,
                default: 'default',
            },
            icon: {
                type: [Boolean, String],
                default: true,
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
        computed: {
            iconClass() {
                if (this.icon === false) {
                    return false;
                }

                if (this.icon === true) {
                    switch (this.color) {
                        case 'info':
                            return 'fa-solid fa-circle-info';
                        case 'success':
                            return 'fa-solid fa-circle-check';
                        case 'error':
                            return 'fa-solid fa-circle-exclamation';
                        default:
                            return 'fa-solid fa-bell';
                    }
                }

                return this.icon;
            },
        },
        data() {
            return {
                show: true,
            };
        },
        mounted() {
            if (this.expiration > 0) {
                setTimeout(
                    () => this.show = false, this.expiration
                );
            }
        },
    };
</script>
