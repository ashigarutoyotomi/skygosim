<template>
    <div id="dealers">
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
                            <h5>Dealers ({{data ? data.total : 0}})</h5>
                        </div>
                    </div>
                    <div class="col-8">
                        <ul class="internet-packages__actions-list">
                            <li>
                                <router-link
                                    to="/dealers/create"
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
                        <template v-if="!data.data.length">
                            <div class="text-muted mb-4">
                                Dealers not found
                            </div>

                            <button
                                type="button"
                                class="btn btn-light btn-sm"
                                @click="$router.push('/dealers/create')"
                            >
                                Create new dealer
                            </button>
                        </template>

                        <template v-if="data.data.length">
                            <table class="table table-sm">
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
<!--                                        <button type="button" class="btn btn-light btn-sm">-->
<!--                                            <i class="bi bi-trash-fill"></i>-->
<!--                                        </button>-->
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
    import { USER_ROLES } from "../Users/constants";

    export default {
        name: "DealerIndex",

        components: {

        },

        data () {
            return {
                data: null,
                loading: false,
                userRoles: USER_ROLES,
            }
        },

        created() {
            this.$root.$on('dealers.load', this.loadData);

            this.loadData();
        },

        beforeDestroy() {
            this.$root.$off('dealers.load', this.loadData);
        },

        methods: {
            loadData() {
                this.loading = true;

                axios.get('/dealers')
                    .then(({data}) => {
                        this.data = data;
                        this.loading = false;
                    });
            },

            show(userId) {
                this.$router.push('/dealers/' + userId + '/show');
            },

            edit(userId) {
                this.$router.push('/dealers/' + userId + '/edit');
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
