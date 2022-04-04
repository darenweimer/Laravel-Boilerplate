<template>
    <div class="relative inline font-default font-normal text-base">
        <button class="inline cursor-pointer focus:outline-none" @click="active = !active" @blur="active = false">
            <slot>
            </slot>
        </button>

        <transition :style="getPositionStyle()" enter-active-class="transition ease-out duration-150" enter-from-class="scale-0" enter-to-class="scale-100" leave-active-class="transition ease-in duration-150" leave-from-class="scale-100" leave-to-class="scale-0">
            <div v-if="active" class="absolute inline z-50 border border-dropdown rounded bg-dropdown-normal text-left whitespace-nowrap py-1" :class="getPositionClass()">
                <ul>
                    <inertia-link v-for="(option, label) in options" :href="option.link" :key="label">
                        <li class="text-dropdown-normal pl-4 pr-12 py-1 hover:bg-dropdown-highlight hover:text-dropdown-highlight">
                            <i v-if="option.icon" class="mr-3 fa-fw text-xl align-middle opacity-50" :class="option.icon"></i>

                            <span class="align-middle">
                                {{ label }}
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
                type: Object,
                required: true,
            },
            position: {
                type: String,
                default: '',
            },
            offset: {
                type: String,
                default: null,
            },
        },
        data() {
            return {
                active: false,
            };
        },
        emits: [
            'state',
        ],
        watch: {
            active() {
                this.$emit('state', this.active);
            },
        },
        methods: {
            getPositionStyle() {
                const xpos = this.position.includes('right') ? 'right' : 'left';
                const ypos = this.position.includes('bottom') ? 'top' : 'bottom';

                return `transform-origin: ${xpos} ${ypos}`;
            },
            getPositionClass() {
                const xpos = this.position.includes('right') ? 'right-0' : 'left-0';
                const ypos = this.position.includes('bottom') ? 'top-full' : 'bottom-full';

                let margin = '';

                if (this.offset) {
                    if (this.position.includes('bottom')) {
                        margin = `mt-${this.offset}`;
                    } else {
                        margin = `mb-${this.offset}`;
                    }
                }

                return `${xpos} ${ypos} ${margin}`;
            },
        },
    };
</script>
