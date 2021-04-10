<template>
    <div id="dealers-edit">
        <template v-if="loading">
            <div class="row">
                <div class="spinner-border mx-auto" style="width: 3rem; height: 3rem;" role="status">
                    <span class="sr-only"></span>
                </div>
            </div>
        </template>

        <template
            v-if="!loading"
        >
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
                                    autocomplete="off"
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
        </template>
    </div>
</template>

<script>
    import {USER_ROLES} from "../../Users/constants";

    export default {
        name: "DealerEdit",

        components: {

        },

        props: {
            userId: {
                type: String,
                default: () => null
            }
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
                errors: {},
                loading: false,
            }
        },

        created() {
            this.loadData();
        },

        methods: {
            loadData() {
                this.loading = true;

                axios.get(`/users/${this.userId}/edit`)
                    .then(res => {
                        this.form = res.data;
                        this.loading = false;
                    })
                    .catch(e => {
                        console.log(e);
                        this.loading = false;
                    });
            },

            submit() {
                let formData = new FormData();

                for ( let key in this.form ) {
                    formData.append(key, this.form[key]);
                }

                axios.post(`/users/${this.userId}/update`, formData)
                    .then(res => {
                        if (res) {
                            this.$router.push('/users');
                            this.$root.$emit('users.load');
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
