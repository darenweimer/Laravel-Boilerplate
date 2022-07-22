<template>
    <table class="w-full table-auto border-collapse">
        <tbody>
            <tr v-if="label">
                <td colspan="4" class="pr-4 py-0.5 font-medium text-sm opacity-50 select-none" :style="`padding-left:${1 + (indent * 0.75)}rem`">
                    {{ label }}
                </td>
            </tr>

            <tr v-for="(option, index) in options" :key="index" :class="{ 'hover:bg-dropdown-hover hover:text-dropdown-hover': option.type !== 'group' }">
                <div v-if="option.type === 'group'" class="contents">
                    <td colspan="4" class="p-0">
                        <dropdown-group :options="option.options" :label="option.label" :indent="indentOptions">
                        </dropdown-group>
                    </td>
                </div>

                <component v-else :is="(option.type === 'link') ? 'inertia-link' : 'div'" :href="getLinkOptionHref(option)" class="contents cursor-pointer" @click="handleActionOptionClick(option)">
                    <td class="w-0 pr-0 py-0.5" :style="`padding-left:${1 + (indentOptions * 0.75)}rem`">
                    </td>

                    <td class="w-0 px-0 py-0.5">
                        <i v-if="option.icon" class="fa-fw mr-2" :class="option.icon"></i>
                    </td>

                    <td class="pl-0 pr-4 py-0.5">
                        {{ option.label }}
                    </td>

                    <td class="w-0 px-0 py-0.5">
                        <i v-if="option.checked" class="fa-solid fa-check pr-4"></i>
                    </td>
                </component>
            </tr>
        </tbody>
    </table>
</template>

<script>
    export default {
        props: {
            options: {
                type: Array,
                required: true,
            },
            label: {
                type: String,
                default: null,
            },
            indent: {
                type: Number,
                validator: (v) => v >= 0,
                default: 0,
            },
        },
        computed: {
            indentOptions() {
                return this.label ? (this.indent + 1) : this.indent;
            },
        },
        methods: {
            getLinkOptionHref(option) {
                return (option.type === 'link') ? (option.href ?? '#') : null;
            },
            handleActionOptionClick(option) {
                if (option.type === 'action') {
                    if ((typeof option.click) === 'function') {
                        option.click();
                    }
                }
            },
        },
    };
</script>
