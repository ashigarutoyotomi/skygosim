<template>
    <div id="sim_orders">
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
                                    <td>{{ moment(item.created_at).format('DD/MM/YYYY HH:mm') }}</td>
                                    <td>
                                        <template
                                            v-if="item.sim_type === simTypes[1].id"
                                        >
                                            <button
                                                type="button"
                                                class="btn btn-light btn-sm"
                                                @click="show(item.id)"
                                            >
                                                <i class="bi bi-eye-fill"></i>
                                            </button>
                                        </template>
<!--                                        <button type="button" class="btn btn-light btn-sm">-->
<!--                                            <i class="bi bi-pencil-square"></i>-->
<!--                                        </button>-->
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
    import { STATUS_TYPES, SIM_TYPES } from "./constants";
    import moment from 'moment'

    export default {
        name: "SimOrdersIndex",

        components: {

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
            }
        },

        created() {
            this.loadData();
        },

        watch: {
            simType(value) {
                this.loadData();
            },
        },

        methods: {
            loadData() {
                this.loading = true;

                let url = '/sim-orders';

                if (this.userId) {
                    url = `/users/${this.userId}/orders`;
                }

                axios.get(url, {
                    params: {
                        type: this.simType,
                    }
                })
                    .then(({data}) => {
                        this.data = data;
                        this.loading = false;
                    });
            },

            show(simOrderId) {
                this.$router.push('/sim-orders/' + userId + '/show');
            },

            moment(date) {
                return moment(date);
            }
        }
    }
</script>

<style lang="scss">

</style>
