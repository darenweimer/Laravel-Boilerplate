<template>
    <input class="block w-full border border-input rounded-md shadow-sm bg-input font-normal text-base text-input placeholder-input tracking-wide px-2 py-1 focus:outline-none focus:border-input-focus focus:ring-2 focus:ring-input disabled:bg-input-disabled" :class="classInvalid" :value="modelValue" @input="$emit('update:modelValue', $event.target.value)"/>
</template>

<script>
    export default {
        props: {
            error: String,
            modelValue: null,
        },
        emits: [
            'update:modelValue',
        ],
        computed: {
            classInvalid() {
                return this.error
                    ? 'border-input-invalid bg-input-invalid text-input-invalid'
                    : null;
            },
        },
    };
</script>
