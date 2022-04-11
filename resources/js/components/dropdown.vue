<template>
    <div class="relative inline">
        <button type="button" class="inline focus:outline-none" @click="show = !show" @blur="show = false">
            <slot>
            </slot>
        </button>

        <transition :class="origin" enter-active-class="transition ease-out duration-150" enter-from-class="scale-0" enter-to-class="scale-100" leave-active-class="transition ease-in duration-150" leave-from-class="scale-100" leave-to-class="scale-0">
            <div v-show="show" :class="`absolute inline z-[100] ${position} rounded shadow-md bg-dropdown-normal font-default font-normal text-base text-dropdown-normal tracking-wide text-left py-1 whitespace-nowrap`">
                <ul>
                    <inertia-link v-for="(option, index) in options" :key="index" :href="option.href">
                        <li class="hover:bg-dropdown-highlight hover:text-dropdown-highlight py-1.5">
                            <i v-if="option.icon" :class="`${option.icon} fa-fw mx-3 text-xl align-middle`"></i>

                            <span class="mr-5 align-middle">
                                {{ option.name }}
                            </span>
                        </li>
                    </inertia-link>
                </ul>
            </div>
        </transition>
    </div>
</template>

<script>
    export default {
        props: {
            options: {
                type: Array,
                required: true,
            },
            anchor: {
                type: String,
                default: 'topleft',
            },
            offset: {
                type: String,
                default: null,
            },
        },
        computed: {
            origin() {
                return 'origin-'
                    + (this.anchor.includes('bottom') ? 'bottom' : 'top')
                    + '-'
                    + (this.anchor.includes('right') ? 'right' : 'left');
            },
            position() {
                let position =
                    (this.anchor.includes('right') ? 'right-0' : 'left-0')
                    + ' '
                    + (this.anchor.includes('bottom') ? 'bottom-full' : 'top-full');

                if (this.offset) {
                    if (this.anchor.includes('bottom')) {
                        position += ` mb-${this.offset}`;
                    } else {
                        position += ` mt-${this.offset}`;
                    }
                }

                return position;
            },
        },
        data() {
            return {
                show: false,
            };
        },
        emits: [
            'state',
        ],
        watch: {
            show() {
                this.$emit('state', this.show);
            },
        },
    };
</script>
