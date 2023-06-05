<template>
    <div id="internet-package-orders">
        <template v-if="loading">
            <div class="row">
                <div class="spinner-border mx-auto" style="width: 3rem; height: 3rem;" role="status">
                    <span class="sr-only"></span>
                </div>
            </div>
        </template>

        <template v-if="!loading">
            <div class="section bg-white shadow-sm rounded-3 py-4 px-4">
                <div class="row">
                    <div class="col-4">
                        <div class="mb-4">
                            <h6 class="">Users ({{data ? data.total : 0}})</h6>
                        </div>
                    </div>
                    <div class="col-8">
                        <ul class="internet-packages__actions-list">
                            <li>
                                <router-link
                                    to="/users/create"
                                    class="btn btn-light btn-sm"
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
                        <template v-if="!data.data.length">
                            <p class="fw-light fst-italic text-muted mb-4">
                                Users not found
                            </p>

                            <router-link
                                to="/users/create"
                                class="btn btn-light btn-sm"
                                title="Add new user"
                            >
                                Create new user
                            </router-link>
                        </template>

                        <template v-if="data.data.length">
                            <table class="table table-sm">
                                <thead>
                                <tr>
                                    <th class="fw-bold text-black-50" scope="col">#</th>
                                    <th class="fw-bold text-black-50" scope="col">Name</th>
                                    <th class="fw-bold text-black-50" scope="col">Email</th>
                                    <th class="fw-bold text-black-50" scope="col">Role</th>
                                    <th class="fw-bold text-black-50" scope="col"></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="(item, key) in data.data">
                                    <th class="fw-bold text-black-50" scope="row">{{ key + 1 }}</th>
                                    <td>{{ item.first_name }} {{ item.last_name }}</td>
                                    <td>{{ item.email }}</td>
                                    <td>{{ userRoles[item.role].label }}</td>
                                    <td>
                                        <button
                                            type="button"
                                            class="btn btn-light btn-sm"
                                            @click="show(item.id)"
                                        >
                                            <i class="bi bi-eye-fill"></i>
                                        </button>
                                        <button
                                            type="button"
                                            class="btn btn-light btn-sm"
                                            @click="edit(item.id)"
                                        >
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
                                        <button
                                            type="button"
                                            class="btn btn-light btn-sm"
                                            @click="remove(item.id)"
                                        >
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </template>
                    </div>
                </div>
            </div>
        </template>
    </div>
</template>

<script>
    import {USER_ROLES} from "../Users/constants";

    export default {
        name: "InternetPackageOrders",

        data () {
            return {
                data: null,
                loading: false,
            }
        },

        created() {
            this.$root.$on('internet-package-orders.load', this.loadData);

            this.loadData();
        },

        beforeDestroy() {
            this.$root.$off('internet-package-orders.load', this.loadData);
        },

        methods: {
            loadData() {
                this.loading = true;

                axios.get('/users')
                    .then(({data}) => {
                        this.data = data;
                        this.loading = false;
                    });
            },

            // remove(userId) {
            //     this.$root.$emit('modal::show::ConfirmUserDeleteModal', {
            //         userId: userId,
            //     });
            // }
        }
    }
</script>

<style lang="scss">

</style>
