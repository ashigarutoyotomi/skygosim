<template>
    <div id="user-sims" class="mb-4">

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
                            <h5>User SIMs ({{data ? data.total : 0}})</h5>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <template v-if="!data.data.length">
                            <div class="text-muted mb-4">
                                User SIMs not found
                            </div>
                        </template>

                        <template v-if="data.data.length">
                            <table class="table table-striped table-sm">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">IMSI</th>
                                    <th scope="col">SIM TYPE</th>
                                    <th scope="col">ICCID</th>
                                    <th scope="col">PIN2</th>
                                    <th scope="col">PUK1</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="(item, key) in data.data">
                                    <th scope="row">
                                        {{(key + 1) + (data.per_page * (data.current_page - 1))}}
                                    </th>
                                    <td>{{ item.sim.imsi }}</td>
                                    <td>{{ simTypes[item.sim.sim_type].label }}</td>
                                    <td>{{ item.sim.iccid }}</td>
                                    <td>{{ item.sim.pin_2 }}</td>
                                    <td>{{ item.sim.puk_1 }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </template>
                    </div>
                </div>

                <template v-if="data.data.length">
                    <pagination
                        :data="data"
                        load-event="user-sims.load"
                    />
                </template>
            </div>
        </template>
    </div>
</template>

<script>
    import { SIM_TYPES } from "../../Inventory/Sims/constants";
    import Pagination from "../../../../components/admin/pagination";

    export default {
        name: "UserSims",
        components: {Pagination},

        props: {
            userId: {
                type: String,
                default: () => null,
            }
        },

        data () {
            return {
                data: {},
                loading: false,
                simTypes: SIM_TYPES,
            }
        },

        created() {
            this.$root.$on('user-sims.load', this.loadData);

            this.loadData();
        },

        beforeDestroy() {
            this.$root.$off('user-sims.load', this.loadData);
        },

        methods: {
            loadData(data) {
                this.loading = true;
                let params = {};

                if (data && data.params && data.params.page) {
                    params.page = data.params.page
                }

                axios.get(`/users/${this.userId}/sims`, {
                    params
                })
                    .then(({data}) => {
                        this.data = data;
                        this.loading = false;
                    });
            },
        }
    }
</script>

<style lang="scss">

</style>
