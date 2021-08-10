<template>
    <input :type="type" class="block w-full border rounded-md font-normal text-base placeholder-input tracking-wide px-2.5 pt-2 pb-1.5 focus:outline-none focus:border-input-focused focus:ring focus:ring-input disabled:bg-input-disabled disabled:text-input-disabled" :class="{ 'border-input-normal bg-input-normal text-input-normal': !invalid, 'border-input-invalid bg-input-invalid text-input-invalid': invalid }" :value="modelValue" @input="$emit('update:modelValue', $event.target.value)"/>
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
