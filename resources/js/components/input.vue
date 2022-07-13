<template>
    <div class="inline relative">
        <i v-if="icon" class="fa-fw absolute left-3 top-1/2 -translate-y-1/2" :class="iconClass"></i>

        <input v-bind="$attrs" :type="type" :value="modelValue" :class="inputClass" @input="$emit('update:modelValue', $event.target.value)" :disabled="disabled"/>

        <i v-if="(validation === false) && (!disabled)" class="fa-solid fa-xmark fa-fw absolute right-3 top-1/2 -translate-y-1/2 text-xs text-input-error"></i>
        <i v-else-if="(validation === true) && (!disabled)" class="fa-solid fa-check fa-fw absolute right-3 top-1/2 -translate-y-1/2 text-xs text-input-success"></i>
    </div>
</template>

<script>
    export default {
        props: {
            type: {
                type: String,
                validator: (v) => ['text', 'number', 'email', 'password', 'date', 'time'].includes(v),
                default: 'text',
            },
            modelValue: {
                default: null,
            },
            icon: {
                type: String,
                default: null,
            },
            validation: {
                type: Boolean,
                default: null,
            },
            disabled: {
                type: Boolean,
                default: false,
            },
        },
        computed: {
            iconClass() {
                let iconClass = [
                    this.icon,
                ];

                if (this.disabled) {
                    iconClass.push('text-input-disabled');
                } else if (this.validation === false) {
                    iconClass.push('text-input-error');
                } else if (this.validation === true) {
                    iconClass.push('text-input-success');
                } else {
                    iconClass.push('text-input');
                }

                return iconClass.join(' ');
            },
            inputClass() {
                let inputClass = [
                    'w-full py-1 appearance-none',
                    'focus:outline-none border focus:border-input-focused disabled:border-input-disabled rounded-md',
                    'bg-transparent disabled:bg-input-disabled',
                    'font-default font-normal text-base focus:text-input disabled:text-input-disabled tracking-wide',
                    'placeholder:text-placeholder disabled:placeholder:text-placeholder-disabled',
                    'transition ease-linear duration-200',
                ];

                if (this.icon) {
                    inputClass.push('pl-10');
                } else {
                    inputClass.push('pl-2');
                }

                if ((this.validation === false) && (!this.disabled)) {
                    inputClass.push('pr-10 border-input-error text-input-error');
                } else if ((this.validation === true) && (!this.disabled)) {
                    inputClass.push('pr-10 border-input-success text-input-success');
                } else {
                    inputClass.push('pr-2 border-input text-input');
                }

                return inputClass.join(' ');
            },
        },
        emits: [
            'update:modelValue',
        ],
    };
</script>

<style scoped>
    input::-webkit-calendar-picker-indicator {
        position: absolute;
        left: 0;
        right: 0;
        top: 0;
        bottom: 0;
        width: auto;
        height: auto;
        background: transparent;
        color: transparent;
    }
</style>
