<template>
    <select ref="select" class="block w-full border rounded-md font-normal text-base placeholder-input tracking-wide px-2 py-2.5 focus:outline-none focus:border-input-focused focus:ring focus:ring-input disabled:bg-input-disabled disabled:text-input-disabled" :class="{ 'border-input-normal bg-input-normal text-input-normal': !invalid, 'border-input-invalid bg-input-invalid text-input-invalid': invalid }" v-model="modelValue" :multiple="multiple" @input="update($event.target.value)">
        <option v-if="placeholder && (!multiple)" :value="null" disabled selected>
            {{ placeholder }}
        </option>

        <option v-for="option in options" :value="option.id" :key="option.id">
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
            placeholder: {
                type: String,
                default: null,
            },
            modelValue: {
                default: null,
            },
            invalid: {
                type: [Boolean, String],
                default: false,
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
