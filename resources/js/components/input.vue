<template>
    <input :type="type" class="block w-full border border-input-normal rounded-md shadow-sm bg-input-normal font-normal text-base text-input-normal placeholder-input tracking-wide px-2 pt-1.5 pb-1 focus:outline-none focus:border-input-focused focus:ring focus:ring-input disabled:bg-input-disabled disabled:text-input-disabled" :class="invalid ? 'border-input-invalid bg-input-invalid text-input-invalid' : null" :value="modelValue" @input="$emit('update:modelValue', $event.target.value)"/>
</template>

<script>
    export default {
        props: {
            type: {
                type: String,
                default: 'text',
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
    };
</script>
