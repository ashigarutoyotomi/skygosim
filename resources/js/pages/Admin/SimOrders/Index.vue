<template>
    <div id="sim_orders">
        <sim-orders-filters
            v-if="filters.show"
            @applied="applyFilters"
            @close="closeFilters"
        />

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
                            <h5>Sim Orders ({{data ? data.total : 0}})</h5>
                        </div>
                    </div>
                    <div class="col-8">
                        <ul class="internet-packages__actions-list">
                            <li>
                                <button
                                    type="button"
                                    class="btn btn-light btn-sm"
                                    @click="showFilters"
                                >
                                    <i class="bi bi-funnel"></i>
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <template v-if="!data.data.length">
                            <div class="text-muted mb-4">
                                Sim orders not found
                            </div>
                        </template>

                        <template v-if="data.data.length">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Full name</th>
                                        <th scope="col">SIM ICCID</th>
                                        <th scope="col">SIM type</th>
                                        <th scope="col">Order Status</th>
                                        <th scope="col">Order Date</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(item, key) in data.data">
                                        <th scope="row">{{ key + 1 }}</th>
                                        <td>{{ item.user.first_name }} {{ item.user.last_name }}</td>
                                        <td>{{ item.sim ? item.sim.iccid : 'not selected' }}</td>
                                        <td>{{ simTypes[item.sim_type].label }}</td>
                                        <td>{{ orderStatuses[item.status].label }}</td>
                                        <td>{{ moment(item.created_at).format('MM/DD/YYYY HH:mm') }}</td>
                                        <td>
                                            <button
                                                type="button"
                                                class="btn btn-light btn-sm"
                                                @click="show(item.id)"
                                            >
                                                <i class="bi bi-eye-fill"></i>
                                            </button>
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
    import { STATUS_TYPES, SIM_TYPES } from "./constants";
    import moment from 'moment';
    import SimOrdersFilters from "./modules/Filters";

    export default {
        name: "SimOrdersIndex",

        components: {
            SimOrdersFilters

        },

        props: {
            userId: {
                type: String,
                default: () => null
            },
            simType: {
                type: String,
                default: () => 'all'
            },
        },

        data () {
            return {
                data: null,
                loading: false,
                orderStatuses: STATUS_TYPES,
                simTypes: SIM_TYPES,
                filters: {
                    show: false
                },
            }
        },

        created() {
            this.loadData();
            this.$root.$on('sims.load', this.loadData);
        },

        beforeDestroy() {
            this.$root.$off('sims.load', this.loadData);
        },

        watch: {
            simType(value) {
                this.loadData();
            },
        },

        methods: {
            loadData(data) {
                this.loading = true;

                let params = {};

                if (data && data.params && data.params.page) {
                    params.page = data.params.page
                }

                params.filters = this.filters;
                params.type = this.simType;

                let url = '/sim-orders';

                if (this.userId) {
                    url = `/users/${this.userId}/orders`;
                }

                axios.get(url, {
                    params
                })
                    .then(({data}) => {
                        this.data = data;
                        this.loading = false;
                    });
            },

            show(simOrderId) {
                this.$router.push('/sim-orders/' + simOrderId + '/show');
            },

            moment(date) {
                return moment(date);
            },

            showFilters() {
                this.filters.show = true;
            },

            /**
             * Устанавливаем фильтры, обновляем данные
             */
            applyFilters(filters) {
                for (let key in filters) {
                    this.filters[key] = filters[key];
                }

                Vue.nextTick(() => {
                    this.loadData();
                });
            },

            closeFilters() {
                this.filters.show = false;
            },
        }
    }
</script>

<style lang="scss">

</style>
