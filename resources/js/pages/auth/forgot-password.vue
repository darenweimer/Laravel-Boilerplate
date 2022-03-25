<template>
    <form @submit.prevent="submit">
        <div class="flex h-screen p-4">
            <v-card class="w-full max-w-lg m-auto">
                <template v-slot:header>
                    <div class="text-center">
                        Password Reset Request
                    </div>
                </template>

                <div class="w-96 mx-auto my-4">
                    <v-label class="mb-2 text-center" label="Confirm your email address:"/>
                    <v-input type="email" v-model="form.email" :invalid="form.errors.email" @input="form.clearErrors()" placeholder="Enter email address..." required autofocus/>
                    <v-label class="text-center" :success="status" :error="form.errors.email" :below="true"/>
                </div>

                <template v-slot:footer>
                    <div class="text-center">
                        <v-button type="submit" color="primary" :disabled="form.processing">
                            Email Password Reset Link
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
                    email: null,
                }),
            };
        },
        methods: {
            submit() {
                this.$page.props.status = null;

                this.form
                    .clearErrors()
                    .post(
                        this.route('forgot-password')
                    );
            },
        },
    };
</script>
