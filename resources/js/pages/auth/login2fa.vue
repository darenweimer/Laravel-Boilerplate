<template>
    <form @submit.prevent="submit">
        <div class="flex h-screen p-4">
            <v-card class="w-full max-w-lg m-auto">
                <template v-slot:header>
                    <div class="text-center">
                        Google 2-Factor Authentication
                    </div>
                </template>

                <div class="mt-4 w-32 mx-auto text-center">
                    <v-label label="Google 2FA Code"/>
                    <v-input type="number" v-model="form.google2fa" :error="form.errors.google2fa" placeholder="Enter code..." required autofocus/>
                </div>

                <v-label class="text-center" :error="form.errors.google2fa"/>

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
                    google2fa: null,
                }),
            };
        },
        methods: {
            submit() {
                this.form
                    .clearErrors()
                    .post(
                        this.route('2fa.login'), {
                            onFinish: () => this.form.reset(),
                        }
                    );
            },
        },
    };
</script>
