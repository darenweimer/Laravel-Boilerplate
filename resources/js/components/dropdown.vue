<template>
    <div class="inline relative">
        <button type="button" class="inline focus:outline-none" @click="show = !show" @blur="show = false">
            <slot>
            </slot>
        </button>

        <transition enter-active-class="transition ease-out duration-150" enter-from-class="scale-0" enter-to-class="scale-100" leave-active-class="transition ease-in duration-150" leave-from-class="scale-100" leave-to-class="scale-0" :class="originClass">
            <div v-show="show" class="absolute inline z-[100] py-2 overflow-hidden rounded bg-dropdown font-default font-normal text-base text-dropdown tracking-wide whitespace-nowrap" :class="positionClass">
                <dropdown-group :options="options">
                </dropdown-group>
            </div>
        </transition>
    </div>
</template>

<script>
    import DropdownGroup from './dropdown-group.vue';

    export default {
        components: {
            DropdownGroup,
        },
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
            originClass() {
                let originClass = [
                    this.anchor.includes('bottom') ? 'bottom' : 'top',
                    this.anchor.includes('right') ? 'right' : 'left',
                ];

                return 'origin-' + originClass.join('-');
            },
            positionClass() {
                let positionClass = [
                    this.anchor.includes('right') ? 'right-0' : 'left-0',
                    this.anchor.includes('bottom') ? 'bottom-full' : 'top-full',
                ];

                if (this.offset) {
                    positionClass.push(
                        (this.anchor.includes('bottom') ? 'mb-' : 'mt-') + this.offset
                    );
                }

                return positionClass.join(' ');
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
