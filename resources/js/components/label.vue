<template>
    <div v-if="label || success || error">
        <label v-if="label" class="block w-full font-medium text-sm text-primary" :class="below ? 'mt-1' : 'mb-1'">
            {{ label }}
        </label>

        <label v-if="success" class="block w-full font-normal text-sm text-input-success" :class="below ? 'mt-1' : 'mb-1'">
            {{ success }}
        </label>

        <label v-if="error" class="block w-full font-normal text-sm text-input-error" :class="below ? 'mt-1' : 'mb-1'">
            {{ error }}
        </label>
    </div>
</template>

<script>
    export default {
        props: {
            label: String,
            success: String,
            error: String,
            below: {
                type: Boolean,
                default: false,
            },
        },
    };
</script>
