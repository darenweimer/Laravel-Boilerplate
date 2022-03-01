<template>
    <form @submit.prevent="submit">
        <div class="flex h-screen p-4">
            <v-card class="w-full max-w-lg m-auto">
                <template v-slot:header>
                    <div class="text-center">
                        Reset Password
                    </div>
                </template>

                <div class="mt-4">
                    <v-label label="Password"/>
                    <v-input type="password" v-model="form.password" :error="form.errors.password" placeholder="Enter password..." required autofocus/>
                    <v-label :error="form.errors.password" :below="true"/>
                </div>

                <div class="mt-4">
                    <v-label label="Confirm Password"/>
                    <v-input type="password" v-model="form.password_confirmation" :error="form.errors.password_confirmation" placeholder="Confirm password..." required/>
                    <v-label :error="form.errors.password_confirmation" :below="true"/>
                </div>

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
            email: String,
            token: String,
        },
        data() {
            return {
                form: this.useForm({
                    email: this.email,
                    token: this.token,
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
                        this.route('password.update'), {
                            onFinish: () => this.form.reset(),
                        }
                    );
            },
        },
    };
</script>
