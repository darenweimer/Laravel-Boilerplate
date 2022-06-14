<template>
    <form @submit.prevent="submit">
        <div class="flex h-screen p-4">
            <v-panel class="w-full max-w-lg m-auto">
                <template v-slot:header>
                    <div class="text-center">
                        Account Registration
                    </div>
                </template>

                <v-form-group class="mt-6">
                    <template v-slot:label>
                        First Name
                    </template>

                    <v-input type="text" v-model="form.first_name" :validation="form.errors.first_name ? false : null" @input="form.clearErrors('first_name')" placeholder="Enter first name..." required autofocus/>

                    <template v-slot:error>
                        {{ form.errors.first_name }}
                    </template>
                </v-form-group>

                <v-form-group class="mt-4">
                    <template v-slot:label>
                        Last Name
                    </template>

                    <v-input type="text" v-model="form.last_name" :validation="form.errors.last_name ? false : null" @input="form.clearErrors('last_name')" placeholder="Enter last name..." required/>

                    <template v-slot:error>
                        {{ form.errors.last_name }}
                    </template>
                </v-form-group>

                <v-form-group class="mt-4">
                    <template v-slot:label>
                        Email Address
                    </template>

                    <v-input type="email" v-model="form.email" :validation="form.errors.email ? false : null" @input="form.clearErrors('email')" placeholder="Enter email address..." required/>

                    <template v-slot:error>
                        {{ form.errors.email }}
                    </template>
                </v-form-group>

                <v-form-group class="mt-4">
                    <template v-slot:label>
                        Password
                    </template>

                    <v-input type="password" v-model="form.password" :validation="form.errors.password ? false : null" @input="form.clearErrors('password')" placeholder="Enter password..." required/>

                    <template v-slot:error>
                        {{ form.errors.password }}
                    </template>
                </v-form-group>

                <v-form-group class="mt-4 mb-8">
                    <template v-slot:label>
                        Confirm Password
                    </template>

                    <v-input type="password" v-model="form.password_confirmation" :validation="form.errors.password_confirmation ? false : null" @input="form.clearErrors('password_confirmation')" placeholder="Confirm password..." required/>

                    <template v-slot:error>
                        {{ form.errors.password_confirmation }}
                    </template>
                </v-form-group>

                <template v-slot:footer>
                    <div class="text-center">
                        <v-button type="submit" color="primary" :disabled="form.processing">
                            Create Account
                        </v-button>

                        <div class="mt-3 mb-1">
                            <v-link :href="route('login')" class="text-sm">
                                Return to Application Login
                            </v-link>
                        </div>
                    </div>
                </template>
            </v-panel>
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
