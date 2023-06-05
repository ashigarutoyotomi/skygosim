<template>
    <div id="pages-apn">
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
                            <h5>APNs ({{data ? data.total : 0}})</h5>
                        </div>
                    </div>
                    <div class="col-8">
                        <ul class="internet-packages__actions-list">
                            <li>
                                <router-link
                                    to="/pages/apns/create"
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
                                APNs not found
                            </div>

                            <button
                                type="button"
                                class="btn btn-light btn-sm"
                                @click="$router.push('/pages/apns/create')"
                            >
                                Add new APN
                            </button>
                        </template>

                        <template v-if="data.data.length">
                            <table class="table table-sm">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Country</th>
                                    <th scope="col">Operator</th>
                                    <th scope="col">APN</th>
                                    <th scope="col"></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="(item, key) in data.data">
                                    <th scope="row">{{ key + 1 }}</th>
                                    <td>{{ item.country.name }}</td>
                                    <td>{{ item.operator }}</td>
                                    <td>{{ item.apn }}</td>
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
    export default {
        name: "PagesApnIndex",

        data () {
            return {
                data: null,
                loading: false,
            }
        },

        created() {
            this.$root.$on('pages-apns.load', this.loadData);

            this.loadData();
        },

        beforeDestroy() {
            this.$root.$off('pages-apns.load', this.loadData);
        },

        methods: {
            loadData() {
                this.loading = true;

                axios.get('/pages/apns')
                    .then(({data}) => {
                        this.data = data;
                        this.loading = false;
                    });
            },

            show(dataId) {
                this.$router.push('/pages/apns/' + dataId + '/show');
            },

            edit(dataId) {
                this.$router.push('/pages/apns/' + dataId + '/edit');
            }
        }
    }
</script>

<style scoped>

</style>
