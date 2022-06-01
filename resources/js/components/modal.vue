<template>
    <teleport to="body">
        <transition leave-active-class="duration-150">
            <div v-show="show" class="fixed inset-0 z-[100] px-4 py-12 sm:py-24 overflow-y-auto" scroll-region>
                <transition enter-active-class="ease-out duration-150" enter-from-class="opacity-0" enter-to-class="opacity-100" leave-active-class="ease-in duration-150" leave-from-class="opacity-100" leave-to-class="opacity-0">
                    <div v-show="show" class="fixed inset-0 transform transition-all" @click="close()">
                        <div class="absolute inset-0 bg-black opacity-75">
                        </div>
                    </div>
                </transition>

                <transition enter-active-class="ease-out duration-150" enter-from-class="opacity-0 scale-50" enter-to-class="opacity-100 scale-100" leave-active-class="ease-in duration-150" leave-from-class="opacity-100 scale-100" leave-to-class="opacity-0 scale-50">
                    <div v-show="show" class="flex flex-col max-h-full mx-auto px-5 py-4 overflow-hidden rounded-lg shadow-[0_25px_50px_rgb(0,0,0)] bg-default font-default font-normal text-base text-default tracking-wide transform transition-all" :class="`max-w-${size}`">
                        <div v-if="$slots.header" class="flex-none flex flex-row items-center mb-4 pb-4 border-b border-default text-2xl">
                            <div class="grow font-bold text-title">
                                <slot name="header">
                                </slot>
                            </div>

                            <div v-if="closeable" class="flex-none">
                                <button class="focus:outline-none" @click="close()">
                                    &times;
                                </button>
                            </div>
                        </div>

                        <div class="grow overflow-scroll">
                            <div v-if="icon" class="mb-3 text-6xl text-center">
                                <i :class="iconClass"></i>
                            </div>

                            <slot>
                            </slot>
                        </div>

                        <div v-if="$slots.footer" class="flex-none mt-4 pt-4 border-t border-default">
                            <slot name="footer">
                            </slot>
                        </div>
                    </div>
                </transition>
            </div>
        </transition>
    </teleport>
</template>

<script>
    export default {
        inheritAttrs: false,
        props: {
            show: {
                type: Boolean,
                default: false,
            },
            size: {
                type: String,
                default: 'lg',
            },
            icon: {
                type: String,
                default: null,
            },
            closeable: {
                type: Boolean,
                default: true,
            },
        },
        computed: {
            iconClass() {
                switch (this.icon) {
                    case 'info':
                        return 'fa-solid fa-circle-info text-info';
                    case 'question':
                        return 'fa-regular fa-circle-question text-info';
                    case 'loading':
                        return 'fa-solid fa-arrows-spin fa-spin text-info';
                    case 'success':
                        return 'fa-regular fa-circle-check text-success';
                    case 'warning':
                        return 'fa-solid fa-triangle-exclamation text-warning';
                    case 'error':
                        return 'fa-regular fa-circle-xmark text-error';
                    default:
                        return this.icon;
                }
            },
        },
        watch: {
            show: {
                immediate: true,
                handler: (show) => document.body.style.overflow =
                    show ? 'hidden' : null,
            },
        },
        emits: [
            'close',
        ],
        methods: {
            close() {
                if (this.closeable) {
                    this.$emit('close');
                }
            },
        },
    };
</script>
