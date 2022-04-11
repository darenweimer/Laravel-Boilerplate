<template>
    <form @submit.prevent="submit">
        <div class="flex h-screen p-4">
            <v-card :box="true" class="w-full max-w-lg m-auto">
                <template v-slot:header>
                    <div class="text-center">
                        Password Confirmation
                    </div>
                </template>

                <v-alert v-if="form.errors.password" color="error" class="mb-8">
                    {{ form.errors.password }}
                </v-alert>

                <div class="mt-4 mb-8">
                    <v-label class="mb-2 text-center">
                        Confirm your password:
                    </v-label>

                    <v-input type="password" v-model="form.password" @input="form.clearErrors()" placeholder="Enter password..." required autofocus/>
                </div>

                <div class="mb-4 text-center">
                    <v-button type="submit" color="primary" :disabled="form.processing">
                        Confirm Password
                    </v-button>
                </div>
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
