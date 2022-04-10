<template>
    <teleport to="body">
        <transition leave-active-class="duration-200">
            <div v-show="show" class="fixed inset-0 z-[100] px-4 py-12 overflow-y-auto" scroll-region>
                <transition enter-active-class="ease-out duration-300" enter-from-class="opacity-0" enter-to-class="opacity-100" leave-active-class="ease-in duration-200" leave-from-class="opacity-100" leave-to-class="opacity-0">
                    <div v-show="show" class="fixed inset-0 transform transition-all" @click="close()">
                        <div class="absolute inset-0 bg-black opacity-75">
                        </div>
                    </div>
                </transition>

                <transition enter-active-class="ease-out duration-300" enter-from-class="opacity-0 scale-50" enter-to-class="opacity-100 scale-100" leave-active-class="ease-in duration-200" leave-from-class="opacity-100 scale-100" leave-to-class="opacity-0 scale-50">
                    <div v-show="show" :class="`flex flex-col max-w-${size} max-h-full mx-auto rounded-lg shadow-xl bg-card-${color} font-default font-normal text-base text-card-${color} tracking-wide p-0 overflow-hidden transform transition-all`">
                        <div v-if="$slots.header" class="flex-none flex flex-row items-center">
                            <div class="grow font-black text-xl px-4 py-3">
                                <slot name="header">
                                </slot>
                            </div>

                            <div v-if="closeable" class="flex-none">
                                <button class="mx-2 focus:outline-none text-2xl px-2" @click="close()">
                                    &times;
                                </button>
                            </div>
                        </div>

                        <div class="grow bg-white bg-opacity-[15%] p-4 overflow-scroll">
                            <slot>
                            </slot>
                        </div>

                        <div v-if="$slots.footer" class="flex-none p-4">
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
        props: {
            show: {
                type: Boolean,
                default: false,
            },
            size: {
                type: String,
                default: 'lg',
            },
            color: {
                type: String,
                default: 'default',
            },
            closeable: {
                type: Boolean,
                default: true,
            },
        },
        watch: {
            show: {
                immediate: true,
                handler: (show) => document.body.style.overflow = show ? 'hidden' : null,
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
