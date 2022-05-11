<template>
    <div id="internet-package-purchase-index">
        <add-new-internet-package-for-purchase-modal />
        <add-from-file-internet-package-for-purchase-modal />

        <div class="bg-white shadow-sm rounded-3 py-4 px-4">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex justify-content-between">
                        <div class="">
                            <h6 class="text-muted">Purchase internet packages</h6>
                        </div>
                        <div class="d-flex">
                            <button
                                class="btn btn-light btn-sm me-2"
                                @click="openAddNewInternetPackageForPurchaseModal"
                            >
                                Add new
                            </button>

                            <button
                                class="btn btn-light btn-sm me-2"
                                title="Add new user"
                                @click="openAddFromFileInternetPackageForPurchaseModal"
                            >
                                Add from excel file
                            </button>

                            <a
                                class="btn btn-light btn-sm"
                                title="Get example excel file"
                                href="/files/example_excel_file.xlsx"
                                download
                            >
                                Get example excel file
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div v-if="!internetPackages.length" class="row">
                <div class="col-12">
                    <div class="mb-4">
                        <span class="fw-light fst-italic text-muted">
                            No internet packages for purchase
                        </span>
                    </div>
                </div>
                <div class="col-12">
                    <div class="d-flex">
                        <button
                            class="btn btn-light btn-sm me-2"
                            @click="openAddNewInternetPackageForPurchaseModal"
                        >
                            Add new
                        </button>

                        <button
                            class="btn btn-light btn-sm me-2"
                            title="Add from excel file"
                            @click="openAddFromFileInternetPackageForPurchaseModal"
                        >
                            Add from excel file
                        </button>

                        <a
                            class="btn btn-light btn-sm"
                            title="Get example excel file"
                            href="/files/example_excel_file.xlsx"
                            download
                        >
                            Get example excel file
                        </a>
                    </div>
                </div>
            </div>

            <div v-if="internetPackages.length" class="row">
                <div class="col-12">
                    <template>
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th class="fw-bold text-black-50" scope="col">#</th>
                                    <th class="fw-bold text-black-50" scope="col">ICCID</th>
                                    <th class="fw-bold text-black-50" scope="col">Package ID</th>
                                    <th class="fw-bold text-black-50" scope="col">Package Name</th>
                                    <th class="fw-bold text-black-50" scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item, key) in internetPackages">
                                    <th class="fw-bold text-black-50" scope="row">{{ key + 1 }}</th>
                                    <td>{{ item.iccid }}</td>
                                    <td>{{ item.packageId }}</td>
                                    <td>{{ item.packageNameEng }}</td>
                                    <td>
                                        <button
                                            type="button"
                                            class="btn btn-light btn-sm"
                                            @click="removeFromList(key)"
                                        >
                                            <i class="bi bi-x"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </template>
                </div>
            </div>

            <div v-if="internetPackages.length" class="row">
                <div class="col-12">
                    <div class="d-flex justify-content-end">
                        <template v-if="user.role === userRoles[1].id">
                            <button
                                v-if="!loading"
                                type="button"
                                class="btn btn-success btn-sm"
                                @click="activatePackages"
                            >
                                Activate packages
                            </button>
                            <button
                                v-if="loading"
                                type="button"
                                class="btn btn-success btn-sm"
                                disabled
                            >
                                Activating...
                            </button>
                        </template>
                        <template v-if="user.role === userRoles[3].id">
                            <button
                                v-if="!loading"
                                type="button"
                                class="btn btn-success btn-sm"
                                @click="activatePackages"
                            >
                                Checkout packages
                            </button>
                            <button
                                v-if="loading"
                                type="button"
                                class="btn btn-success btn-sm"
                                disabled
                            >
                                Checkouting...
                            </button>
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import AddNewInternetPackageForPurchaseModal from "../modals/purchase/AddNewInternetPackageForPurchaseModal";
    import AddFromFileInternetPackageForPurchaseModal
        from "../modals/purchase/AddFromFileInternetPackageForPurchaseModal";
    import {mapGetters} from "vuex";
    import {USER_ROLES} from "../../Users/constants";

    export default {
        name: "InternetPackagePurchaseIndex",

        components: {AddFromFileInternetPackageForPurchaseModal, AddNewInternetPackageForPurchaseModal},

        data() {
            return {
                internetPackages: [],
                loading: false,
                userRoles: USER_ROLES,
            }
        },

        created() {
            this.$root.$on('internet-packages-purchase.add-internet-packages', this.addInternetPackages);
        },

        beforeDestroy() {
            this.$root.$off('internet-packages-purchase.add-internet-packages');
        },

        computed: {
            ...mapGetters({
                user: 'getUser'
            }),
        },

        methods: {
            openAddNewInternetPackageForPurchaseModal() {
                this.$root.$emit('modal::show::' + 'AddNewInternetPackageForPurchaseModal');
            },

            openAddFromFileInternetPackageForPurchaseModal() {
                this.$root.$emit('modal::show::' + 'AddFromFileInternetPackageForPurchaseModal');
            },

            addInternetPackages(data) {
                this.internetPackages = [...this.internetPackages, ...data];
            },

            removeFromList(key) {
                this.internetPackages.splice(key, 1);
            },

            activatePackages() {
                this.loading = true;

                if (this.user.role === this.userRoles[1].id) {
                    axios.post(`/internet-packages/activate-packages`, this.internetPackages)
                        .then(res => {
                            this.loading = false;

                            this.$toast.open({
                                message: 'Packages successfully activated',
                                type: 'success',
                                position: 'bottom-left'
                            });

                            this.$router.push({name: 'home'})
                        })
                        .catch(e => {
                            this.loading = false;

                            if (e.response ) {
                                this.$toast.open({
                                    message: e.response.data.message,
                                    type: 'error',
                                    position: 'bottom-left'
                                });
                            }
                        })
                } else if (this.user.role === this.userRoles[3].id) {
                    axios.post(`/internet-packages/checkout-packages`, this.internetPackages)
                        .then(res => {
                            this.loading = false;

                            this.$router.push({name: 'internet_packages_purchase_checkout'});
                        })
                        .catch(e => {
                            this.loading = false;

                            if (e.response ) {
                                this.$toast.open({
                                    message: e.response.data.message,
                                    type: 'error',
                                    position: 'bottom-left'
                                });
                            }
                        })
                }
            }
        }
    }
</script>

<style lang="scss">
    #internet-package-purchase-index {
        .table {
            th {
                font-size: .8rem;
            }
        }
    }
</style>
