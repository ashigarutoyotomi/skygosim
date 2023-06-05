<template>
    <div id="dealers_show">
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
                                    Full name
                                </dt>
                                <dd class="col-sm-9">
                                    {{ data.first_name }} {{ data.last_name }}
                                </dd>

                                <dt class="col-sm-3">
                                    Email
                                </dt>
                                <dd class="col-sm-9">
                                    {{ data.email }}
                                </dd>

                                <dt class="col-sm-3">
                                    Role
                                </dt>
                                <dd class="col-sm-9">
                                    {{ userRoles[data.role].label }}
                                </dd>

                                <template v-if="!data.address">
                                    <h6 class="mt-4">
                                        <u><small>Dealer Address</small></u>
                                    </h6>

                                    <span class="text-muted mb-2">
                                        <em><small>Address not added</small></em>
                                    </span>

                                    <div class="col-4">
                                        <button
                                            type="button"
                                            class="btn btn-outline-info btn-sm"
                                            @click="addAddress()"
                                        >
                                            Add address
                                        </button>
                                    </div>
                                </template>

                                <template v-if="data.address">
                                    <h6 class="mt-4">
                                        <u><small>Dealer Address</small></u>
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
                            </dl>
                        </div>
                    </div>
                </div>
            </section>

            <dealer-physical-sim-orders
                :dealer-id="userId"
            />

            <dealer-physical-sims
                :dealer-id="userId"
            />
        </template>
    </div>
</template>

<script>
    import {USER_ROLES} from "../Users/constants";
    import DealerPhysicalSims from "./Sims/PhysicalSims";
    import DealerPhysicalSimOrders from "./Sims/PhysicalSimOrders";

    export default {
        name: "DealerShow",

        components: {
            DealerPhysicalSimOrders,
            DealerPhysicalSims

        },

        props: {
            userId: {
                type: String,
                default: () => null,
            }
        },

        data () {
            return {
                data: null,
                loading: false,
                userRoles: USER_ROLES,
            }
        },

        created() {
            this.loadData();
            this.$root.$on('dealer.load', this.loadData);
        },

        beforeDestroy() {
            this.$root.$off('dealer.load', this.loadData);
        },

        methods: {
            loadData() {
                this.loading = true;

                axios.get('/users/' + this.userId + '/show')
                    .then(({data}) => {
                        this.data = data;
                        this.loading = false;
                    });
            },

            addAddress() {
                this.$router.push(`/dealers/${this.data.id}/address/create`);
            }
        }
    }
</script>

<style scoped>

</style>
