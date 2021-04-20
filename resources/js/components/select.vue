<template>
    <select class="block w-full border border-input rounded-md shadow-sm bg-input font-normal text-base text-input placeholder-input tracking-wide px-1 py-1.5 focus:outline-none focus:border-input-focus focus:ring focus:ring-input disabled:bg-input-disabled disabled:text-input-disabled" :class="classInvalid" :value="modelValue" @input="$emit('update:modelValue', $event.target.value)">
        <option v-for="(option, key) in options" :value="key" :key="key">
            {{ option }}
        </option>
    </select>
</template>

<script>
    export default {
        props: {
            options: Object,
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
