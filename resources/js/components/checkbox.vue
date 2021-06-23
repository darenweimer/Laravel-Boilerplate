<template>
    <div>
        <label class="inline-flex flex-row items-center">
            <input type="checkbox" class="h-4 w-4 mr-2 appearance-none border border-input-normal rounded-sm shadow-sm bg-input-normal focus:outline-none focus:border-input-focused focus:ring focus:ring-input disabled:bg-input-disabled" v-model="proxyChecked" :disabled="disabled"/>

            <i v-if="modelValue" class="absolute ml-0.5 mb-0.5 fas fa-check text-input-normal" :class="disabled ? 'text-input-disabled' : null"></i>

            <span class="font-medium text-sm text-default">
                {{ label }}
            </span>
        </label>
    </div>
</template>

<script>
    export default {
        props: {
            modelValue: {
                type: Boolean,
                default: false,
            },
            label: {
                type: String,
                default: null,
            },
            disabled: {
                type: Boolean,
                default: false,
            },
        },
        emits: [
            'update:modelValue',
        ],
        computed: {
            proxyChecked: {
                get() {
                    return this.modelValue;
                },
                set(value) {
                    this.$emit('update:modelValue', value);
                },
            },
        },
    };
</script>
