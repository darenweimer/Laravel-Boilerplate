<template>
    <form @submit.prevent="submit">
        <div class="flex h-screen p-4">
            <v-panel class="w-full max-w-lg m-auto">
                <template v-slot:header>
                    <div class="text-center">
                        Password Reset Request
                    </div>
                </template>

                <v-form-group class="mt-6 mb-8">
                    <template v-slot:label>
                        Email Address
                    </template>

                    <v-input type="email" v-model="form.email" :validation="status ? true : (form.errors.email ? false : null)" @input="form.clearErrors()" placeholder="Enter email address..." required autofocus/>

                    <template v-slot:success>
                        {{ status }}
                    </template>

                    <template v-slot:error>
                        {{ form.errors.email }}
                    </template>
                </v-form-group>

                <template v-slot:footer>
                    <div class="text-center">
                        <v-button type="submit" color="primary" :disabled="form.processing">
                            Email Password Reset Link
                        </v-button>
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
                    email: null,
                }),
            };
        },
        methods: {
            submit() {
                this.form
                    .clearErrors()
                    .post(
                        this.route('forgot-password')
                    );
            },
        },
    };
</script>
