<template>
    <div id="dashboard">
        <purchase-internet-packages-modal />

        <div class="row">
            <div class="col-12">
                <h6>Dashboard</h6>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-3">
                <div class="info-cart bg-white shadow-sm rounded-3 py-3 px-3">
                    <div class="info-cart__title">
                        <h6 class="text-secondary">Customers</h6>
                    </div>

                    <div class="info-cart__body">
                        <h1 class="display-6">
                            {{ customersCount }}
                        </h1>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="info-cart bg-white shadow-sm rounded-3 py-3 px-3">
                    <div class="info-cart__title">
                        <h6 class="text-secondary">Sim Orders</h6>
                    </div>

                    <div class="info-cart__body">
                        <h1 class="display-6">
                            {{ simOrderCount }}
                        </h1>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="info-cart bg-white shadow-sm rounded-3 py-3 px-3">
                    <div class="info-cart__title">
                        <h6 class="text-secondary">Bought packages</h6>
                    </div>

                    <div class="info-cart__body">
                        <h1 class="display-6">
                            {{ packageOrderCount }}
                        </h1>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="info-cart bg-white shadow-sm rounded-3 py-3 px-3">
                    <div class="info-cart__title">
                        <h6 class="text-secondary">Dealers</h6>
                    </div>

                    <div class="info-cart__body">
                        <h1 class="display-6">
                            {{ dealersCount }}
                        </h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-6">
                <internet-packages-card />
            </div>
        </div>
    </div>
</template>

<script>
    import InternetPackagesCard from "./modules/InternetPackagesCard";
    import PurchaseInternetPackagesModal from "./modals/PurchaseInternetPackagesModal";

    export default {
        name: "DashboardIndex",

        components: {
            PurchaseInternetPackagesModal,
            InternetPackagesCard
        },

        data() {
            return {
                customersCount: 0,
                simOrderCount: 0,
                packageOrderCount: 0,
                dealersCount: 0,
            }
        },

        created() {
            this.loadData();
        },

        methods: {
            loadData() {
                axios.get('/dashboard/load-data')
                    .then(({data}) => {
                         this.customersCount = data.customersCount;
                         this.simOrderCount = data.simOrderCount;
                         this.packageOrderCount = data.packageOrderCount;
                         this.dealersCount = data.dealersCount;
                    });
            }
        }
    }
</script>

<style scoped>

</style>
