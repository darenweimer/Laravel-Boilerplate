<template>
    <div class="relative">
        <i v-if="icon" class="fa-fw absolute left-3 top-1/2 -translate-y-1/2" :class="iconClass"></i>

        <div v-if="placeholder && (!multiple) && (!modelValue)" class="absolute top-1/2 -translate-y-1/2 overflow-hidden text-ellipsis whitespace-nowrap pointer-events-none" :class="placeholderClass">
            {{ placeholder }}
        </div>

        <select v-bind="$attrs" ref="select" v-model="modelValue" :multiple="multiple" class="ml-0 mr-0 mt-0 mb-0" :class="selectClass" @input="update($event.target.value)" :disabled="disabled">
            <option v-for="(option, index) in options" :key="index" :value="option.value">
                {{ option.label }}
            </option>
        </select>

        <i v-if="(validation === false) && (!disabled)" class="fa-solid fa-xmark fa-fw absolute right-3 top-1/2 -translate-y-1/2 text-xs text-input-error"></i>
        <i v-else-if="(validation === true) && (!disabled)" class="fa-solid fa-check fa-fw absolute right-3 top-1/2 -translate-y-1/2 text-xs text-input-success"></i>
    </div>
</template>

<script>
    export default {
        props: {
            options: {
                type: Array,
                required: true,
            },
            multiple: {
                type: Boolean,
                default: false,
            },
            modelValue: {
                default: null,
            },
            icon: {
                type: String,
                default: null,
            },
            placeholder: {
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
            placeholderClass() {
                let placeholderClass = [];

                if (this.icon) {
                    placeholderClass.push('left-10');
                } else {
                    placeholderClass.push('left-2');
                }

                if (this.disabled) {
                    placeholderClass.push('right-2 text-placeholder-disabled');
                } else {
                    placeholderClass.push('text-placeholder');

                    if ([true, false].includes(this.validation)) {
                        placeholderClass.push('right-10');
                    } else {
                        placeholderClass.push('right-2');
                    }
                }

                return placeholderClass.join(' ');
            },
            selectClass() {
                let selectClass = [
                    'w-full py-1 appearance-none',
                    'focus:outline-none border focus:border-input-focused disabled:border-input-disabled rounded-md',
                    'bg-transparent disabled:bg-input-disabled',
                    'font-default font-normal text-base focus:text-input disabled:text-input-disabled tracking-wide',
                    'opacity-100 transition ease-linear duration-200',
                ];

                if (this.icon) {
                    selectClass.push('pl-10');
                } else {
                    selectClass.push('pl-2');
                }

                if ((this.validation === false) && (!this.disabled)) {
                    selectClass.push('pr-10 border-input-error text-input-error');
                } else if ((this.validation === true) && (!this.disabled)) {
                    selectClass.push('pr-10 border-input-success text-input-success');
                } else {
                    selectClass.push('pr-2 border-input text-input');
                }

                return selectClass.join(' ');
            },
        },
        emits: [
            'update:modelValue',
        ],
        methods: {
            update(value) {
                if (this.multiple) {
                    let values = [];

                    for (const [index, option] of Object.entries(this.$refs.select.options)) {
                        if (option.selected) {
                            values.push(option.value);
                        }
                    }

                    this.$emit('update:modelValue', values);
                } else {
                    this.$emit('update:modelValue', value);
                }
            },
        },
    };
</script>
