<template>
    <transition leave-active-class="ease-in duration-200" leave-from-class="translate-x-0 opacity-100" leave-to-class="-translate-x-full opacity-0">
        <div v-if="show" class="w-full overflow-hidden rounded-md font-default font-medium text-sm tracking-wide" :class="`bg-alert-${color} text-alert-${color}`">
            <div class="flex flex-row">
                <div v-if="icon" class="flex-none w-12 brightness-[0.93] saturate-[1.25]" :class="`bg-alert-${color}`">
                    <button type="button" class="w-full h-full text-lg" disabled>
                        <i class="fa-lg" :class="iconClass"></i>
                    </button>
                </div>

                <div class="grow px-4 py-3">
                    <slot>
                    </slot>
                </div>

                <div v-if="closeable" class="flex-none w-10 brightness-[0.93] saturate-[1.25]" :class="`bg-alert-${color}`">
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
                    return null;
                }

                if (this.icon === true) {
                    switch (this.color) {
                        case 'info':
                            return 'fa-solid fa-circle-info';
                        case 'success':
                            return 'fa-regular fa-circle-check';
                        case 'warning':
                            return 'fa-solid fa-triangle-exclamation';
                        case 'error':
                            return 'fa-regular fa-circle-xmark';
                        default:
                            return 'fa-regular fa-bell';
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
