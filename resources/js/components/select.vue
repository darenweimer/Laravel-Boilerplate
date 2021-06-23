<template>
    <select class="block w-full border border-input-normal rounded-md shadow-sm bg-input-normal font-normal text-base text-input-normal placeholder-input tracking-wide px-1 py-1.5 focus:outline-none focus:border-input-focused focus:ring focus:ring-input disabled:bg-input-disabled disabled:text-input-disabled" :class="invalid ? 'border-input-invalid bg-input-invalid text-input-invalid' : null" :value="modelValue" @input="$emit('update:modelValue', $event.target.value)">
        <option v-if="placeholder" :value="null" disabled selected>
            {{ placeholder }}
        </option>

        <option v-for="(option, key) in options" :value="key" :key="key">
            {{ option }}
        </option>
    </select>
</template>

<script>
    export default {
        props: {
            options: {
                type: [Array, Object],
                required: true,
            },
            modelValue: {
                default: null,
            },
            placeholder: {
                type: String,
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
    };
</script>
