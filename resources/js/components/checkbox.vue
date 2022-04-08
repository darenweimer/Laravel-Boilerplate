<template>
    <div>
        <label class="inline-flex flex-row items-center cursor-pointer">
            <input type="checkbox" v-model="proxyChecked" class="h-5 w-5 mr-3 appearance-none focus:outline-none focus:ring focus:ring-input rounded bg-input disabled:bg-input-disabled cursor-pointer" :disabled="disabled"/>

            <span v-if="modelValue" class="absolute ml-0.5 mb-2 text-3xl" :class="{ 'text-input': !disabled, 'text-input-disabled': disabled }">
                &check;
            </span>

            <span class="font-default font-normal text-base text-default tracking-wide">
                <slot>
                </slot>
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
