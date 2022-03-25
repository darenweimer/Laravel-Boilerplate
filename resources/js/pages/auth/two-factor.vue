<template>
    <form @submit.prevent="submit">
        <div class="flex h-screen p-4">
            <v-card class="w-full max-w-lg m-auto">
                <template v-slot:header>
                    <div class="text-center">
                        Two-Factor Authentication
                    </div>
                </template>

                <div class="my-4">
                    <v-label class="mb-2 text-center" label="Enter your authenticator code:"/>
                    <v-input type="text" class="w-48 mx-auto text-2xl text-center tracking-[0.25em]" v-model="form.two_factor_code" :invalid="form.errors.two_factor_code" @input="form.clearErrors()" required autofocus/>
                    <v-label class="text-center" :error="form.errors.two_factor_code" :below="true"/>
                </div>

                <template v-slot:footer>
                    <div class="text-center">
                        <v-button type="submit" color="primary" :disabled="form.processing">
                            Authenticate
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
                        this.route('verify-2fa'), {
                            onFinish: () => this.form.reset(),
                        }
                    );
            },
        },
    };
</script>
