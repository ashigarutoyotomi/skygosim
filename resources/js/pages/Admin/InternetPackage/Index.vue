<template>
    <admin-layout>
        <upload-packages-modal
            modal-id="uploadPackagesModal"
        />

        <div class="bg-white shadow-sm rounded-lg py-4 px-4">
            <div class="row">
                <div class="col-12">
                    <div class="mb-4">
                        <h5>Packages</h5>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <template v-if="!internetPackages.length">
                        <div class="text-muted mb-4">
                            Packages not found
                        </div>

                        <button
                            type="button"
                            class="btn btn-primary"
                            data-toggle="modal"
                            data-target="#uploadPackagesModal"
                        >
                            Import Packages
                        </button>
                    </template>

                    <template v-if="internetPackages.length">
                        <table class="table table-striped table-sm">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Area ENG</th>
                                    <th scope="col">Data ENG</th>
                                    <th scope="col">Price USD</th>
                                    <th scope="col">Days</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(internetPackage, key) in internetPackages">
                                    <th scope="row">{{ key + 1 }}</th>
                                    <td>{{ internetPackage.area_eng }}</td>
                                    <td>{{ internetPackage.data_eng }}</td>
                                    <td>{{ internetPackage.price_usd }} $</td>
                                    <td>{{ internetPackage.days }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </template>
                </div>
            </div>
        </div>
    </admin-layout>
</template>

<script>
    import AdminLayout from "../../../layouts/AdminLayout";
    import UploadPackagesModal from "./modals/UploadPackagesModal";

    export default {
        name: "InternetPackageIndex",

        components: {
            AdminLayout,
            UploadPackagesModal,
        },

        data () {
            return {
                internetPackages: []
            }
        },

        created() {
            this.loadData();
        },

        methods: {
            loadData() {
                axios.get('/internet-packages')
                    .then(({data}) => {
                        this.internetPackages = data;
                    });
            }
        }
    }
</script>

<style scoped>

</style>
