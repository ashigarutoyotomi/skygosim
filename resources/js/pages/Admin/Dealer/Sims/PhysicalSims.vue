<template>
    <div id="dealer-physical-sims">

        <select-physical-sim-range-modal />

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
                            <h5>Physical SIMs ({{data ? data.total : 0}})</h5>
                        </div>
                    </div>
                    <div class="col-8">
                        <ul class="internet-packages__actions-list">
                            <li>
                                <button
                                    type="button"
                                    class="btn btn-light btn-sm"
                                    title="Select sim ICCID range"
                                    @click="openSelectSimRangeModal"
                                >
                                    <i class="bi bi-sim-fill"></i>
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <template v-if="!data.data.length">
                            <div class="text-muted mb-4">
                                Physical SIMs not found
                            </div>

                            <button
                                type="button"
                                class="btn btn-light btn-sm"
                                @click="openSelectSimRangeModal"
                            >
                                Select Physical SIMs
                            </button>
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
                                        <th scope="row">{{ key + 1 }}</th>
                                        <td>{{ item.imsi }}</td>
                                        <td>{{ simTypes[item.sim_type].label }}</td>
                                        <td>{{ item.iccid }}</td>
                                        <td>{{ item.pin_2 }}</td>
                                        <td>{{ item.puk_1 }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </template>
                    </div>
                </div>

                <pagination
                    :data="data"
                    load-event="dealer-physical-sims.load"
                />
            </div>
        </template>
    </div>
</template>

<script>
    import { SIM_TYPES } from "../../Inventory/Sims/constants";
    import Pagination from "../../../../components/admin/pagination";
    import SelectPhysicalSimRangeModal from "./modals/SelectPhysicalSimRangeModal";

    export default {
        name: "DealerPhysicalSims",
        components: {SelectPhysicalSimRangeModal, Pagination},
        props: {
            dealerId: {
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
            this.$root.$on('dealer-physical-sims.load', this.loadData);

            this.loadData();
        },

        beforeDestroy() {
            this.$root.$off('dealer-physical-sims.load', this.loadData);
        },

        methods: {
            loadData() {
                this.loading = true;

                axios.get(`/dealers/${this.dealerId}/physical-sims`)
                    .then(({data}) => {
                        this.data = data;
                        this.loading = false;
                    });
            },

            openSelectSimRangeModal() {
                this.$root.$emit('modal::show::SelectPhysicalSimRangeModal', {
                    dealer_id: this.dealerId,
                })
            }
        }
    }
</script>

<style lang="scss">

</style>
