<template>
    <form @submit.prevent="submit">
        <div class="flex h-screen p-4">
            <v-card class="w-full max-w-lg m-auto">
                <template v-slot:header>
                    <div class="text-center">
                        Password Reset
                    </div>
                </template>

                <div class="mt-4">
                    <v-label label="New Password"/>
                    <v-input type="password" v-model="form.password" :invalid="form.errors.password" @input="form.clearErrors()" placeholder="Enter password..." required autofocus/>
                    <v-label :error="form.errors.password" :below="true"/>
                </div>

                <div class="my-4">
                    <v-label label="Confirm Password"/>
                    <v-input type="password" v-model="form.password_confirmation" :invalid="form.errors.password_confirmation" @input="form.clearErrors()" placeholder="Confirm password..." required/>
                    <v-label :error="form.errors.password_confirmation" :below="true"/>
                </div>

                <v-label class="text-center" :error="form.errors.email"/>

                <template v-slot:footer>
                    <div class="text-center">
                        <v-button type="submit" color="primary" :disabled="form.processing">
                            Reset Password
                        </v-button>
                    </div>
                </template>
            </v-card>
        </div>
    </form>
</template>

<script>
    export default {
        props: {
            token: String,
            email: String,
        },
        data() {
            return {
                form: this.useForm({
                    token: this.token,
                    email: this.email,
                    password: null,
                    password_confirmation: null,
                }),
            };
        },
        methods: {
            submit() {
                this.form
                    .clearErrors()
                    .post(
                        this.route('reset-password'), {
                            onFinish: () => this.form.reset(),
                        }
                    );
            },
        },
    };
</script>
