<template>
    <admin-layout
        :user="$attrs.user"
    >
        <template v-if="loading">
            <div class="row">
                <div class="spinner-border mx-auto" style="width: 3rem; height: 3rem;" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
        </template>

        <template v-if="!loading">
            <div class="section bg-white shadow-sm rounded-lg py-4 px-4">
                <div class="row">
                    <div class="col-4">
                        <div class="mb-4">
                            <h5>Users ({{data ? data.total : 0}})</h5>
                        </div>
                    </div>
                    <div class="col-8">
                        <ul class="internet-packages__actions-list">
                            <li>
                                <router-link
                                    to="/users/create"
                                    class="btn btn-primary btn-sm"
                                    title="Add new user"
                                >
                                    Add new
                                </router-link>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <template v-if="!data">
                            <div class="text-muted mb-4">
                                Users not found
                            </div>

                            <button
                                type="button"
                                class="btn btn-light btn-sm"
                            >
                                Create new user
                            </button>
                        </template>

                        <template v-if="data">
                            <table class="table table-striped table-sm">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Role</th>
                                    <th scope="col"></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="(item, key) in data.data">
                                    <th scope="row">{{ key + 1 }}</th>
                                    <td>{{ item.first_name }} {{ item.last_name }}</td>
                                    <td>{{ item.email }}</td>
                                    <td>{{ userRoles[item.role].label }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </template>
                    </div>
                </div>
            </div>
        </template>
    </admin-layout>
</template>

<script>
    import AdminLayout from "../../../layouts/AdminLayout";
    import { USER_ROLES } from "./constants";

    export default {
        name: "UsersIndex",

        components: {
            AdminLayout,
        },

        data () {
            return {
                data: null,
                loading: false,
                userRoles: USER_ROLES,
            }
        },

        created() {
            this.$root.$on('users.load', this.loadData);

            this.loadData();
        },

        beforeDestroy() {
            this.$root.$off('users.load', this.loadData);
        },

        methods: {
            loadData() {
                this.loading = true;

                axios.get('/users')
                    .then(({data}) => {
                        this.data = data;
                        this.loading = false;
                    });
            }
        }
    }
</script>

<style lang="scss">
    .section {
        &__actions-list {
            width: 100%;
            display: flex;
            justify-content: flex-end;
            list-style: none;
        }
    }
</style>
