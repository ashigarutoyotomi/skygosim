<template>
    <div id="dealers-create">
        <div class="section bg-white shadow-sm rounded-lg py-4 px-4">
            <div class="row">
                <div class="col-12">
                    <form autocomplete="off" @submit.prevent="submit">
                        <div class="mb-3">
                            <label for="last_name">First Name</label>
                            <input
                                type="text"
                                class="form-control"
                                :class="{'is-invalid': errors.first_name}"
                                id="last_name"
                                v-model="form.first_name"
                            >
                            <div
                                v-if="errors.first_name"
                                class="invalid-feedback"
                            >
                                {{ errors.first_name[0] }}
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="first_name">Last Name</label>
                            <input
                                type="text"
                                class="form-control"
                                :class="{'is-invalid': errors.last_name}"
                                id="first_name"
                                v-model="form.last_name"
                            >
                            <div
                                v-if="errors.last_name"
                                class="invalid-feedback"
                            >
                                {{ errors.last_name[0] }}
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="email">Email address</label>
                            <input
                                type="email"
                                class="form-control"
                                :class="{'is-invalid': errors.email}"
                                id="email"
                                v-model="form.email"
                            >
                            <div
                                v-if="errors.email"
                                class="invalid-feedback"
                            >
                                {{ errors.email[0] }}
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="password">Password</label>
                            <input
                                type="password"
                                class="form-control"
                                :class="{'is-invalid': errors.password}"
                                id="password"
                                v-model="form.password"
                            >
                            <div
                                v-if="errors.password"
                                class="invalid-feedback"
                            >
                                {{ errors.password[0] }}
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="confirm-password">Confirm Password</label>
                            <input
                                type="password"
                                class="form-control"
                                :class="{'is-invalid': errors.confirm_password}"
                                id="confirm-password"
                                v-model="form.confirm_password"
                            >
                            <div
                                v-if="errors.confirm_password"
                                class="invalid-feedback"
                            >
                                {{ errors.confirm_password[0] }}
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {USER_ROLES} from "../../Users/constants";

    export default {
        name: "DealerCreate",

        components: {

        },

        data() {
            return {
                userRoles: USER_ROLES,
                form: {
                    first_name: '',
                    last_name: '',
                    email: '',
                    password: '',
                    confirm_password: '',
                    role: USER_ROLES[3].id,
                },
                errors: {}
            }
        },

        methods: {
            submit() {
                let formData = new FormData();

                for ( let key in this.form ) {
                    formData.append(key, this.form[key]);
                }

                axios.post('/dealers/create', formData)
                    .then(res => {
                        if (res) {
                            this.$router.push('/dealers');
                            this.$root.$emit('dealers.load');
                        }
                    })
                    .catch(e => {
                        this.errors = e.response.data.errors;
                    });
            }
        }
    }
</script>

<style scoped>

</style>
