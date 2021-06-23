<template>
    <div v-if="label || success || error">
        <label v-if="label" class="block w-full font-medium text-sm text-default" :class="below ? 'mt-1' : 'mb-1'">
            {{ label }}
        </label>

        <label v-if="success" class="block w-full font-normal text-sm text-input-valid" :class="below ? 'mt-1' : 'mb-1'">
            {{ success }}
        </label>

        <label v-if="error" class="block w-full font-normal text-sm text-input-invalid" :class="below ? 'mt-1' : 'mb-1'">
            {{ error }}
        </label>
    </div>
</template>

<script>
    export default {
        props: {
            label: {
                type: String,
                default: null,
            },
            success: {
                type: String,
                default: null,
            },
            error: {
                type: String,
                default: null,
            },
            below: {
                type: Boolean,
                default: false,
            },
        },
    };
</script>
