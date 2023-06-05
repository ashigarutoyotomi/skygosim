<template>
    <div id="inventory-e-sims">

        <upload-physical-sims-modal />

        <template v-if="loading">
            <div class="row">
                <div class="spinner-border mx-auto" style="width: 3rem; height: 3rem;" role="status">
                    <span class="sr-only"></span>
                </div>
            </div>
        </template>

        <template v-if="!loading">
            <div class="internet-packages bg-white shadow-sm rounded-lg py-4 px-4">
                <div class="row">
                    <div class="col-4">
                        <div class="mb-4">
                            <h5>E-SIMs ({{data ? data.total : 0}})</h5>
                        </div>
                    </div>
                    <div class="col-8">
                        <ul class="internet-packages__actions-list">
                            <li>
                                <button
                                    type="button"
                                    class="btn btn-light btn-sm"
                                    title="Upload new packages"
                                    @click="openUploadModal"
                                >
                                    <i class="bi bi-cloud-arrow-up"></i>
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <template v-if="!data.data.length">
                            <div class="text-muted mb-4">
                                E-SIMs not found
                            </div>

                            <button
                                type="button"
                                class="btn btn-light btn-sm"
                                @click="openUploadModal"
                            >
                                Upload E-SIMs
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
                                    <th scope="row">
                                        {{(key + 1) + (data.per_page * (data.current_page - 1))}}
                                    </th>
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

                <template v-if="data.data.length">
                    <pagination
                        :data="data"
                        load-event="inventory-e-sims.load"
                    />
                </template>
            </div>
        </template>
    </div>
</template>

<script>
    import {SIM_TYPES} from "./constants";
    import UploadPhysicalSimsModal from "./modals/UploadPhysicalSimsModal";
    import Pagination from "../../../../components/admin/pagination";

    export default {
        name: "InventoryESims",

        components: {Pagination, UploadPhysicalSimsModal},

        data () {
            return {
                data: {},
                loading: false,
                simTypes: SIM_TYPES,
            }
        },

        created() {
            this.$root.$on('inventory-e-sims.load', this.loadData);

            this.loadData();
        },

        beforeDestroy() {
            this.$root.$off('inventory-e-sims.load', this.loadData);
        },

        methods: {
            loadData(data) {
                this.loading = true;
                let params = {};

                if (data && data.params && data.params.page) {
                    params.page = data.params.page
                }

                axios.get('/sims/e-sims', {
                    params
                })
                    .then(({data}) => {
                        this.data = data;
                        this.loading = false;
                    });
            },

            openUploadModal() {
                this.$root.$emit('modal::show::UploadPhysicalSimsModal');
            },
        }
    }
</script>

<style lang="scss">

</style>
