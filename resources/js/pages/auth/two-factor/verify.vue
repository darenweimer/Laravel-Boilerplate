<template>
    <form @submit.prevent="submit">
        <div class="flex h-screen p-4">
            <v-card class="w-full max-w-lg m-auto">
                <template v-slot:header>
                    <div class="text-center">
                        Two-Factor Authentication
                    </div>
                </template>

                <div class="mt-4 w-32 mx-auto text-center">
                    <v-label label="Two-Factor Authentication Code"/>
                    <v-input type="number" v-model="form.two_factor_code" :error="form.errors.two_factor_code" placeholder="Enter code..." required autofocus/>
                </div>

                <v-label class="text-center" :error="form.errors.two_factor_code"/>

                <template v-slot:footer>
                    <div class="text-center">
                        <v-button type="submit" color="primary" :disabled="form.processing">
                            Submit Code
                        </v-button>
                    </div>
                </template>
            </v-card>
        </div>
    </form>
</template>

<script>
    export default {
        data() {
            return {
                form: this.useForm({
                    two_factor_code: null,
                }),
            };
        },
        methods: {
            submit() {
                this.form
                    .clearErrors()
                    .post(
                        this.route('two-factor.verify'), {
                            onFinish: () => this.form.reset(),
                        }
                    );
            },
        },
    };
</script>
