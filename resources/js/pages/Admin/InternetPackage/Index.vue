<template>
    <div id="internet-packages">
        <upload-packages-modal
            modal-id="uploadPackagesModal"
        />

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
                                    data-toggle="modal"
                                    data-target="#uploadPackagesModal"
                                >
                                    <i class="bi bi-cloud-arrow-up"></i>
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <template v-if="!internetPackages.data.length">
                            <div class="text-muted mb-4">
                                Packages not found
                            </div>

                            <button
                                type="button"
                                class="btn btn-light btn-sm"
                                data-toggle="modal"
                                data-target="#uploadPackagesModal"
                            >
                                Upload Packages
                            </button>
                        </template>

                        <template v-if="internetPackages.data.length">
                            <table class="table table-striped table-sm">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Area ENG</th>
                                        <th scope="col">Data ENG</th>
                                        <th scope="col">Price USD</th>
<!--                                        <th scope="col">GTT Price USD</th>-->
                                        <th scope="col">Days</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(internetPackage, key) in internetPackages.data">
                                        <th scope="row">{{ key + 1 }}</th>
                                        <td>{{ internetPackage.area_eng }}</td>
                                        <td>{{ internetPackage.data_eng }}</td>
                                        <td>{{ internetPackage.price_usd }} $</td>
<!--                                        <td>{{ internetPackage.gtt_price_usd }} $</td>-->
                                        <td>{{ internetPackage.days }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </template>
                    </div>
                </div>

                <div
                    v-if="internetPackages.data.length"
                    class="row"
                >
                    <nav>
                        <ul class="pagination justify-content-end">
<!--                            <li class="page-item disabled">-->
<!--                                <a class="page-link" href="#" aria-label="Previous">-->
<!--                                    <span aria-hidden="true">&laquo;</span>-->
<!--                                </a>-->
<!--                            </li>-->
                            <li
                                v-for="(page, key) in internetPackages.last_page"
                                class="page-item"
                            >
                                <a class="page-link" @click="setPage(key + 1)">
                                    {{ key + 1 }}
                                </a>
                            </li>
<!--                            <li class="page-item">-->
<!--                                <a class="page-link" href="#" aria-label="Next">-->
<!--                                    <span aria-hidden="true">&raquo;</span>-->
<!--                                </a>-->
<!--                            </li>-->
                        </ul>
                    </nav>
                </div>
            </div>
        </template>
    </div>
</template>

<script>
    import UploadPackagesModal from "./modals/UploadPackagesModal";

    export default {
        name: "InternetPackageIndex",

        components: {
            UploadPackagesModal,
        },

        data () {
            return {
                internetPackages: [],
                loading: false,
                page: 1,
            }
        },

        created() {
            this.$root.$on('internet-packages.load', this.loadData);

            this.loadData();
        },

        beforeDestroy() {
            this.$root.$off('internet-packages.load', this.loadData);
        },

        methods: {
            loadData() {
                this.loading = true;

                axios.get(`/internet-packages?page=${this.page}`)
                    .then(({data}) => {
                        this.internetPackages = data;
                        this.loading = false;
                    });
            },

            setPage(page) {
                this.page = page;

                this.loadData();
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
