<template>
    <select ref="select" v-model="modelValue" :multiple="multiple" class="block w-full focus:outline-none focus:ring focus:ring-input rounded-md disabled:bg-input-disabled font-default font-normal text-base disabled:text-input-disabled disabled:placeholder-input-disabled tracking-wide px-2 py-2.5" :class="{ 'bg-input text-input placeholder-input': valid, 'bg-input-invalid text-input-invalid placeholder-input-invalid': !valid }" @input="update($event.target.value)">
        <option v-if="placeholder && (!multiple)" :value="null" disabled selected>
            {{ placeholder }}
        </option>

        <option v-for="(option, index) in options" :key="index" :value="option.id">
            {{ option.text }}
        </option>
    </select>
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
            valid: {
                type: Boolean,
                default: true,
            },
            placeholder: {
                type: String,
                default: null,
            },
        },
        emits: [
            'update:modelValue',
        ],
        methods: {
            update(value) {
                if (this.multiple) {
                    const values = [];

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
