<template>
    <input :type="type" :value="modelValue" class="block w-full focus:outline-none focus:ring focus:ring-input rounded-md disabled:bg-input-disabled font-default font-normal text-base disabled:text-input-disabled disabled:placeholder-input-disabled tracking-wide px-2.5 pt-2 pb-1.5" :class="{ 'bg-input text-input placeholder-input': valid, 'bg-input-invalid text-input-invalid placeholder-input-invalid': !valid }" @input="$emit('update:modelValue', $event.target.value)"/>
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
            valid: {
                type: Boolean,
                default: true,
            },
        },
        emits: [
            'update:modelValue',
        ],
    };
</script>
