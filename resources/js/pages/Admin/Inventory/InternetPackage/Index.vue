<template>
    <div id="internet-packages">
        <upload-packages-modal />

        <template v-if="loading">
            <div class="row">
                <div class="spinner-border mx-auto" style="width: 3rem; height: 3rem;" role="status">
                    <span class="sr-only"></span>
                </div>
            </div>
        </template>

        <template v-if="!loading">
            <div class="internet-packages bg-white shadow-sm rounded-3 py-4 px-4">
                <div class="row">
                    <div class="col-4">
                        <div class="mb-4">
                            <h5>Packages</h5>
                        </div>
                    </div>
                    <div class="col-8">
                        <ul class="internet-packages__actions-list">
                            <li>
                                <button
                                    type="button"
                                    class="btn btn-light btn-sm"
                                    title="Upload new packages"
                                    @click="openUploadModal"
                                >
                                    <i class="bi bi-cloud-arrow-up"></i>
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <template v-if="!data.data.length">
                            <div class="text-muted mb-4">
                                Packages not found
                            </div>

                            <button
                                type="button"
                                class="btn btn-light btn-sm"
                                @click="openUploadModal"
                            >
                                Upload Packages
                            </button>
                        </template>

                        <template v-if="data.data.length">
                            <table class="table table-striped table-sm">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Area ENG</th>
                                        <th scope="col">Data ENG</th>
                                        <th scope="col">Price USD</th>
                                        <th scope="col">GTT Price USD</th>
                                        <th scope="col">Days</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(internetPackage, key) in data.data">
                                        <th scope="row">
                                            {{(key + 1) + (data.per_page * (data.current_page - 1))}}
                                        </th>
                                        <td>{{ internetPackage.area_eng }}</td>
                                        <td>{{ internetPackage.data_eng }}</td>
                                        <td>{{ internetPackage.price_usd }} $</td>
                                        <td>{{ internetPackage.gtt_price_usd }} $</td>
                                        <td>{{ internetPackage.days }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </template>
                    </div>
                </div>

                <pagination
                    :data="data"
                    load-event="inventory-internet-packages.load"
                />
            </div>
        </template>
    </div>
</template>

<script>
    import UploadPackagesModal from "./modals/UploadPackagesModal";
    import Pagination from "../../../../components/admin/pagination";

    export default {
        name: "InternetPackageIndex",

        components: {
            Pagination,
            UploadPackagesModal,
        },

        data () {
            return {
                data: [],
                loading: false,
            }
        },

        created() {
            this.$root.$on('inventory-internet-packages.load', this.loadData);

            this.loadData();
        },

        beforeDestroy() {
            this.$root.$off('inventory-internet-packages.load', this.loadData);
        },

        methods: {
            loadData(data) {
                this.loading = true;
                let params = {};

                if (data && data.params && data.params.page) {
                    params.page = data.params.page
                }

                axios.get(`/internet-packages`, {
                    params
                })
                    .then(({data}) => {
                        this.data = data;
                        this.loading = false;
                    });
            },

            openUploadModal() {
                this.$root.$emit('modal::show::UploadPackagesModal');
            }
        }
    }
</script>

<style lang="scss">
    .internet-packages {
        &__actions-list {
            width: 100%;
            display: flex;
            justify-content: flex-end;
            list-style: none;
        }

        .pagination {
            a {
                cursor: pointer;
            }
        }
    }
</style>
