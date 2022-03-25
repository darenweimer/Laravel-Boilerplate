<template>
    <form @submit.prevent="submit">
        <div class="flex h-screen p-4">
            <v-card class="w-full max-w-lg m-auto">
                <template v-slot:header>
                    <div class="text-center">
                        Password Confirmation
                    </div>
                </template>

                <div class="w-96 mx-auto my-4">
                    <v-label class="mb-2 text-center" label="Confirm your password:"/>
                    <v-input type="password" v-model="form.password" :invalid="form.errors.password" @input="form.clearErrors()" required autofocus/>
                    <v-label class="text-center" :error="form.errors.password" :below="true"/>
                </div>

                <template v-slot:footer>
                    <div class="text-center">
                        <v-button type="submit" color="primary" :disabled="form.processing">
                            Confirm Password
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
                    password: null,
                }),
            };
        },
        methods: {
            submit() {
                this.form
                    .clearErrors()
                    .post(
                        this.route('confirm-password'), {
                            onFinish: () => this.form.reset(),
                        }
                    );
            },
        },
    };
</script>
