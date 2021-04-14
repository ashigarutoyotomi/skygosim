<template>
    <div id="purchases-internet-packages-show">
        <template v-if="loading">
            <div class="row">
                <div class="spinner-border mx-auto" style="width: 3rem; height: 3rem;" role="status">
                    <span class="sr-only"></span>
                </div>
            </div>
        </template>

        <template v-if="!loading">
            <section class="bg-white shadow-sm rounded-3 py-4 px-4 mb-4">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <dl class="row">
                                <h6 class="">
                                    <u><small>Info</small></u>
                                </h6>

                                <dt class="col-sm-3">
                                    Dealer name
                                </dt>
                                <dd class="col-sm-9">
                                    <template v-if="data.sim.dealer">
                                        {{ data.sim.dealer.first_name }} {{ data.sim.dealer.first_name }}
                                    </template>

                                    <template v-else>
                                        No dealer
                                    </template>
                                </dd>

                                <dt class="col-sm-3">
                                    Date
                                </dt>
                                <dd class="col-sm-9">
                                    {{ moment(data.created_at).format('DD/MM/YYYY HH:mm') }}
                                </dd>

                                <h6 class="mt-4">
                                    <u><small>Sim info</small></u>
                                </h6>

                                <dt class="col-sm-3">
                                    ICCID
                                </dt>
                                <dd class="col-sm-9">
                                    {{ data.sim.iccid }}
                                </dd>

                                <dt class="col-sm-3">
                                    Type
                                </dt>
                                <dd class="col-sm-9">
                                    {{ simTypes[data.sim.sim_type].label }}
                                </dd>

                                <h6 class="mt-4">
                                    <u><small>Buyer info</small></u>
                                </h6>

                                <dt class="col-sm-3">
                                    Full name
                                </dt>
                                <dd class="col-sm-9">
                                    {{ data.user.first_name }} {{ data.user.last_name }}
                                </dd>

                                <dt class="col-sm-3">
                                    Email
                                </dt>
                                <dd class="col-sm-9">
                                    {{ data.user.email }}
                                </dd>

                                <dt class="col-sm-3">
                                    Role
                                </dt>
                                <dd class="col-sm-9">
                                    {{ userRoles[data.user.role].label }}
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </section>
        </template>
    </div>
</template>

<script>
    import {SIM_TYPES} from "../../Inventory/Sims/constants";
    import {USER_ROLES} from "../../Users/constants";
    import moment from "moment";

    export default {
        name: "ShowPurchasesInternetPackage",

        components: {

        },

        props: {
            dataId: {
                type: String,
                default: () => null,
            }
        },

        data () {
            return {
                data: null,
                loading: false,
                simTypes: SIM_TYPES,
                userRoles: USER_ROLES,
            }
        },

        created() {
            this.loadData();
        },

        methods: {
            loadData() {
                this.loading = true;

                axios.get(`/purchases/internet-packages/${this.dataId}/show`)
                    .then(({data}) => {
                        this.data = data;
                        this.loading = false;
                    });
            },

            moment(date) {
                return moment(date);
            }
        }
    }
</script>

<style scoped>

</style>
