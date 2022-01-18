<template>
    <teleport to="body">
        <transition leave-active-class="duration-200">
            <div v-show="show" class="fixed inset-0 z-50 overflow-y-auto px-4 py-12" scroll-region>
                <transition enter-active-class="ease-out duration-300" enter-from-class="opacity-0" enter-to-class="opacity-100" leave-active-class="ease-in duration-200" leave-from-class="opacity-100" leave-to-class="opacity-0">
                    <div v-show="show" class="fixed inset-0 transform transition-all" @click="close()">
                        <div class="absolute inset-0 bg-black opacity-50"></div>
                    </div>
                </transition>

                <transition enter-active-class="ease-out duration-300" enter-from-class="opacity-0 translate-y-16 scale-50" enter-to-class="opacity-100 translate-y-0 scale-100" leave-active-class="ease-in duration-200" leave-from-class="opacity-100 translate-y-0 scale-100" leave-to-class="opacity-0 translate-y-16 scale-50">
                    <div v-show="show" :class="`flex flex-col max-w-${size} max-h-full mx-auto rounded-lg shadow-xl font-normal text-base text-default p-0 overflow-hidden transform transition-all`">
                        <div v-if="$slots.header" :class="`flex-none flex flex-row border-b border-card-${color} bg-card-${color}-header font-medium text-xl text-card-${color}-header p-4 pb-3`">
                            <div class="grow">
                                <slot name="header"/>
                            </div>

                            <div v-if="closeable" class="flex-none">
                                <button class="text-4xl leading-7 focus:outline-none" @click="close()">
                                    &times;
                                </button>
                            </div>
                        </div>

                        <div :class="`grow bg-card-${color}-body text-card-${color}-body p-4 overflow-scroll`">
                            <slot/>
                        </div>

                        <div v-if="$slots.footer" :class="`flex-none border-t border-card-${color} bg-card-${color}-footer text-card-${color}-footer p-4`">
                            <slot name="footer"/>
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
