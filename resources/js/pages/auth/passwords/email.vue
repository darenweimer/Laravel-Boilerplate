<template>
    <form @submit.prevent="submit">
        <div class="flex h-screen p-4">
            <v-card class="w-full max-w-lg m-auto">
                <template v-slot:header>
                    <div class="text-center">
                        Reset Password
                    </div>
                </template>

                <div class="my-4">
                    <v-label label="Email Address"/>
                    <v-input type="email" v-model="form.email" :error="form.errors.email" placeholder="Enter email address..." required autofocus/>
                    <v-label :success="status" :error="form.errors.email" :below="true"/>
                </div>

                <template v-slot:footer>
                    <div class="text-center">
                        <v-button type="submit" color="primary" :disabled="form.processing">
                            Send Password Reset Link
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
                    email: this.user ? this.user.email : null,
                }),
            };
        },
        methods: {
            submit() {
                this.form
                    .clearErrors()
                    .post(this.route('password.email'));
            },
        },
    };
</script>
