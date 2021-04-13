<template>
    <label class="flex flex-row items-center font-medium text-sm">
        <input type="checkbox" class="h-4 w-4 mr-2 shadow-sm" :value="modelValue" v-model="proxyChecked" :disabled="disabled"/>
        {{ label }}
    </label>
</template>

<script>
    export default {
        props: {
            modelValue: {
                type: Boolean,
                default: false,
            },
            disabled: {
                type: Boolean,
                default: false,
            },
            label: String,
        },
        emits: [
            'update:modelValue',
        ],
        computed: {
            proxyChecked: {
                get() {
                    return this.modelValue;
                },
                set(val) {
                    this.$emit('update:modelValue', val);
                },
            },
        },
    };
</script>
