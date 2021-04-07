<template>
    <div v-if="label || error">
        <label v-if="label" class="block w-full font-medium text-sm text-primary" :class="below ? 'mt-1' : 'mb-1'">
            {{ label }}
        </label>

        <label v-if="error" class="block w-full font-normal text-xs text-input-error" :class="below ? 'mt-1' : 'mb-1'">
            {{ error }}
        </label>
    </div>
</template>

<script>
    export default {
        props: {
            label: String,
            error: String,
            below: {
                type: Boolean,
                default: false,
            },
        },
    };
</script>
