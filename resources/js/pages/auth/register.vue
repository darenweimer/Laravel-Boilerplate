<template>
    <form @submit.prevent="submit">
        <div class="flex h-screen p-4">
            <v-card class="w-full max-w-lg m-auto">
                <template v-slot:header>
                    <div class="text-center">
                        Account Registration
                    </div>
                </template>

                <div class="mt-4">
                    <v-label label="First Name"/>
                    <v-input type="text" v-model="form.first_name" :invalid="form.errors.first_name" @input="form.clearErrors('first_name')" placeholder="Enter first name..." required autofocus/>
                    <v-label :error="form.errors.first_name" :below="true"/>
                </div>

                <div class="mt-4">
                    <v-label label="Last Name"/>
                    <v-input type="text" v-model="form.last_name" :invalid="form.errors.last_name" @input="form.clearErrors('last_name')" placeholder="Enter last name..." required/>
                    <v-label :error="form.errors.last_name" :below="true"/>
                </div>

                <div class="mt-4">
                    <v-label label="Email Address"/>
                    <v-input type="email" v-model="form.email" :invalid="form.errors.email" @input="form.clearErrors('email')" placeholder="Enter email address..." required/>
                    <v-label :error="form.errors.email" :below="true"/>
                </div>

                <div class="mt-4">
                    <v-label label="Password"/>
                    <v-input type="password" v-model="form.password" :invalid="form.errors.password" @input="form.clearErrors('password')" placeholder="Enter password..." required/>
                    <v-label :error="form.errors.password" :below="true"/>
                </div>

                <div class="my-4">
                    <v-label label="Confirm Password"/>
                    <v-input type="password" v-model="form.password_confirmation" :invalid="form.errors.password_confirmation" @input="form.clearErrors('password_confirmation')" placeholder="Confirm password..." required/>
                    <v-label :error="form.errors.password_confirmation" :below="true"/>
                </div>

                <template v-slot:footer>
                    <div class="text-center">
                        <v-button type="submit" color="primary" :disabled="form.processing">
                            Create Account
                        </v-button>

                        <div class="mt-4 text-sm">
                            <v-link :href="route('login')">
                                Return to Application Login
                            </v-link>
                        </div>
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
                    first_name: null,
                    last_name: null,
                    email: null,
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
                        this.route('register'), {
                            onFinish: () => {
                                this.form.reset('password');
                                this.form.reset('password_confirmation');
                            },
                        }
                    );
            },
        },
    };
</script>
