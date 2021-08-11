<template>
    <form @submit.prevent="submit">
        <div class="flex h-screen content-center items-center">
            <v-card class="w-full max-w-lg m-auto">
                <template v-slot:header>
                    <div class="text-center">
                        Application Login
                    </div>
                </template>

                <div class="my-4">
                    <v-label label="Email Address"/>
                    <v-input type="email" v-model="form.email" :error="form.errors.email" placeholder="Enter email address..." required autofocus/>
                    <v-label :error="form.errors.email" :below="true"/>
                </div>

                <div class="my-4">
                    <v-label label="Password"/>
                    <v-input type="password" v-model="form.password" :error="form.errors.password" placeholder="Enter password..." required/>
                    <v-label :error="form.errors.password" :below="true"/>
                </div>

                <div class="mt-6 mb-4">
                    <v-checkbox label="Remember Me" class="text-center" v-model="form.remember"/>
                </div>

                <template v-slot:footer>
                    <div class="text-center">
                        <v-button type="submit" color="primary" :disabled="form.processing">
                            Authenticate
                        </v-button>

                        <v-link :href="route('password.request')" class="ml-4">
                            Forgot password?
                        </v-link>
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
                    email: null,
                    password: null,
                    remember: false,
                }),
            };
        },
        methods: {
            submit() {
                this.form
                    .clearErrors()
                    .post(this.route('login'), {
                        onFinish: () => this.form.reset('password'),
                    });
            },
        },
    };
</script>
