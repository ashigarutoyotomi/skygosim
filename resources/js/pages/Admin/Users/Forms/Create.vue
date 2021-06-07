<template>
    <div id="users-create">

        <div class="section bg-white shadow-sm rounded-3 py-4 px-4">
            <div class="row">
                <div class="col-12">
                    <form autocomplete="off" @submit.prevent="submit">
                        <div class="mb-3">
                            <label class="fw-bold text-black-50" for="last_name">First Name</label>
                            <input
                                type="text"
                                class="form-control form-control-sm"
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
                            <label class="fw-bold text-black-50" for="first_name">Last Name</label>
                            <input
                                type="text"
                                class="form-control form-control-sm"
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
                            <label class="fw-bold text-black-50" for="email">Email address</label>
                            <input
                                type="email"
                                class="form-control form-control-sm"
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
                            <label class="fw-bold text-black-50" for="password">Password</label>
                            <input
                                type="password"
                                class="form-control form-control-sm"
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
                            <label class="fw-bold text-black-50" for="confirm-password">Confirm Password</label>
                            <input
                                type="password"
                                class="form-control form-control-sm"
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
                        <div v-if="user.role === userRoles[1].id" class="mb-3">
                            <label class="fw-bold text-black-50" for="role">Role</label>
                            <select
                                class="form-control form-control-sm"
                                :class="{'is-invalid': errors.role}"
                                id="role"
                                v-model="form.role"
                            >
                                <option
                                    v-for="role in userRoles"
                                    :value="role.id"
                                >
                                    {{ role.label }}
                                </option>
                            </select>
                            <div
                                v-if="errors.role"
                                class="invalid-feedback"
                            >
                                {{ errors.role[0] }}
                            </div>
                        </div>

                        <button v-if="!loading" type="submit" class="btn btn-success btn-sm">Create user</button>

                        <template v-if="loading">
                            <button
                                type="button"
                                class="btn btn-success btn-sm"
                                disabled
                            >
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                Creating...
                            </button>
                        </template>
                    </form>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
    import { USER_ROLES } from "../constants";
    import {mapGetters} from "vuex";

    export default {
        name: "UserCreate",

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
                    role: USER_ROLES[2].id,
                },
                errors: {},
                loading: false,
            }
        },

        computed: {
            ...mapGetters({
                user: 'getUser'
            }),
        },

        methods: {
            submit() {
                this.loading = true;
                let formData = new FormData();

                for ( let key in this.form ) {
                    formData.append(key, this.form[key]);
                }

                axios.post('/users/create', formData)
                    .then(res => {
                        this.loading = false;

                        if (res) {
                            this.$toast.open({
                                message: 'User created successfully',
                                type: 'success',
                                position: 'bottom-left'
                            });

                            this.$router.push('/users');
                            this.$root.$emit('users.load');
                        }
                    })
                    .catch(e => {
                        this.loading = false;

                        if (e.response ) {
                            if (e.response.status === 422) {
                                this.errors = e.response.data.errors;
                            } else {
                                this.$toast.open({
                                    message: e.response.data.message,
                                    type: 'error',
                                    position: 'bottom-left'
                                });
                            }
                        }
                    });
            }
        }
    }
</script>

<style lang="scss">
    #users-create {
        label {
            font-size: .8rem;
        }
    }
</style>
