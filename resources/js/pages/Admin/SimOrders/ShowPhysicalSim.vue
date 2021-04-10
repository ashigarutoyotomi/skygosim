<template>
    <div id="users_show">

        <choose-physical-sim-modal
            v-if="!loading"
            modal-id="ChoosePhysicalSimModal"
            :order-id="data.id"
        />

        <confirm-close-sim-order-modal
            v-if="!loading"
            modal-id="ConfirmCloseSimOrderModal"
            :order-id="data.id"
        />

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
                                    Order ID
                                </dt>
                                <dd class="col-sm-9">
                                    {{ data.key }}
                                </dd>

                                <dt class="col-sm-3">
                                    Status
                                </dt>
                                <dd class="col-sm-9">
                                    {{ orderStatuses[data.status].label }}
                                </dd>

                                <template v-if="!data.sim">
                                    <h6 class="mt-4">
                                        <u><small>Ordered physical SIM info</small></u>
                                    </h6>

                                    <div class="text-muted mb-4">
                                        SIM not selected
                                    </div>

                                    <div class="col-4">
                                        <button
                                            type="button"
                                            class="btn btn-outline-info btn-sm"
                                            @click="openChoosePhysicalSimModal()"
                                        >
                                            Choose physical SIM
                                        </button>
                                    </div>
                                </template>

                                <template v-if="data.sim">
                                    <h6 class="mt-4">
                                        <u><small>Ordered physical SIM info</small></u>
                                    </h6>

                                    <dt class="col-sm-3">
                                        IMSI
                                    </dt>
                                    <dd class="col-sm-9">
                                        {{ data.sim.imsi }}
                                    </dd>

                                    <dt class="col-sm-3">
                                        ICCID
                                    </dt>
                                    <dd class="col-sm-9">
                                        {{ data.sim.iccid }}
                                    </dd>

                                    <dt class="col-sm-3">
                                        PIN 2
                                    </dt>
                                    <dd class="col-sm-9">
                                        {{ data.sim.pin_2 }}
                                    </dd>

                                    <dt class="col-sm-3">
                                        PUK 1
                                    </dt>
                                    <dd class="col-sm-9">
                                        {{ data.sim.puk_1 }}
                                    </dd>
                                </template>

                                <template v-if="data.address">
                                    <h6 class="mt-4">
                                        <u><small>Order Address</small></u>
                                    </h6>

                                    <dt class="col-sm-3">
                                        Street
                                    </dt>
                                    <dd class="col-sm-9">
                                        {{ data.address.street }}
                                    </dd>

                                    <dt class="col-sm-3">
                                        City
                                    </dt>
                                    <dd class="col-sm-9">
                                        {{ data.address.city }}
                                    </dd>

                                    <dt class="col-sm-3">
                                        State
                                    </dt>
                                    <dd class="col-sm-9">
                                        {{ data.address.state }}
                                    </dd>

                                    <dt class="col-sm-3">
                                        ZIP code
                                    </dt>
                                    <dd class="col-sm-9">
                                        {{ data.address.zip_code }}
                                    </dd>
                                </template>

                                <template v-if="data.user">
                                    <h6 class="mt-4">
                                        <u><small>User info</small></u>
                                    </h6>

                                    <dt class="col-sm-3">
                                        First Name
                                    </dt>
                                    <dd class="col-sm-9">
                                        {{ data.user.first_name }}
                                    </dd>

                                    <dt class="col-sm-3">
                                        Last Name
                                    </dt>
                                    <dd class="col-sm-9">
                                        {{ data.user.last_name }}
                                    </dd>

                                    <dt class="col-sm-3">
                                        Email
                                    </dt>
                                    <dd class="col-sm-9">
                                        {{ data.user.email }}
                                    </dd>
                                </template>
                            </dl>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <button
                                type="button"
                                class="btn btn-outline-primary btn-sm"
                                @click="finishOrder"
                            >
                                Close order
                            </button>
                        </div>
                    </div>
                </div>
            </section>
        </template>
    </div>
</template>

<script>
    import { STATUS_TYPES, SIM_TYPES } from "./constants";
    import ChoosePhysicalSimModal from "./modals/ChoosePhysicalSimModal";
    import ConfirmCloseSimOrderModal from "./modals/ConfirmCloseSimOrderModal";

    export default {
        name: "ShowPhysicalSim",

        components: {
            ConfirmCloseSimOrderModal,
            ChoosePhysicalSimModal
        },

        props: {
            simOrderId: {
                type: String,
                default: () => null,
            }
        },

        data () {
            return {
                data: null,
                loading: false,
                orderStatuses: STATUS_TYPES,
            }
        },

        created() {
            this.loadData();
            this.$root.$on('sim.load', this.loadData);
        },

        beforeDestroy() {
            this.$root.$off('sim.load', this.loadData);
        },

        methods: {
            loadData() {
                this.loading = true;

                axios.get('/sim-orders/' + this.simOrderId + '/show')
                    .then(({data}) => {
                        this.data = data;
                        this.loading = false;
                    });
            },

            openChoosePhysicalSimModal() {
                this.$root.$emit('modal::show::ChoosePhysicalSimModal');
            },

            finishOrder() {
                this.$root.$emit('modal::show::ConfirmCloseSimOrderModal');
            }
        }
    }
</script>

<style lang="scss">

</style>
