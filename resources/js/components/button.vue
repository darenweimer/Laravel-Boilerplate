<template>
    <button :type="type" class="active:mt-px active:-mb-px focus:outline-none shadow-[0_3px_6px_rgb(0,0,0,0.25)] active:shadow-[0_1px_2px_rgb(0,0,0,0.25)] font-default font-bold tracking-wide disabled:opacity-40 select-none" :class="buttonClass">
        <span :class="{ 'px-0.5': round }">
            <slot>
            </slot>
        </span>
    </button>
</template>

<script>
    export default {
        props: {
            type: {
                type: String,
                validator: (v) => ['button', 'submit', 'reset'].includes(v),
                default: 'button',
            },
            color: {
                type: String,
                default: 'default',
            },
            size: {
                type: String,
                validator: (v) => ['small', 'regular', 'large'].includes(v),
                default: 'regular',
            },
            round: {
                type: Boolean,
                default: false,
            },
            outline: {
                type: Boolean,
                default: false,
            },
        },
        computed: {
            buttonClass() {
                let buttonClass = [];

                if (this.outline) {
                    buttonClass.push(
                        `border-2 border-${this.color} text-${this.color}`
                    );
                } else {
                    buttonClass.push(
                        `bg-btn-${this.color} text-btn-${this.color}`
                    );
                }

                switch (this.size) {
                    case 'small':
                        buttonClass.push('px-2 py-1.5 text-xs');
                        break;
                    case 'large':
                        buttonClass.push('px-5 py-4 text-lg');
                        break;
                    default:
                        buttonClass.push('px-3 py-2 text-base');
                }

                if (this.round) {
                    buttonClass.push('rounded-full');
                } else {
                    buttonClass.push('rounded');
                }

                return buttonClass.join(' ');
            },
        },
    };
</script>
