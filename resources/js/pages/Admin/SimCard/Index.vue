<template>
    <div id="sim-cards">
        <upload-sim-cards-modal
            modal-id="UploadSimCardsModal"
        />

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
                            <h5>Sim Cards ({{data ? data.total : 0}})</h5>
                        </div>
                    </div>
                    <div class="col-8">
                        <ul class="internet-packages__actions-list">
                            <li>
                                <button
                                    type="button"
                                    class="btn btn-light btn-sm"
                                    title="Upload new packages"
                                    data-toggle="modal"
                                    data-target="#UploadSimCardsModal"
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
                                Packages not found
                            </div>

                            <button
                                type="button"
                                class="btn btn-light btn-sm"
                                data-toggle="modal"
                                data-target="#UploadSimCardsModal"
                            >
                                Upload Sim Cards
                            </button>
                        </template>

                        <template v-if="data.data.length">
                            <table class="table table-striped table-sm">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">ICCID</th>
                                        <th scope="col">SIM TYPE</th>
                                        <th scope="col">IMSI</th>
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
            </div>
        </template>
    </div>
</template>

<script>
import UploadSimCardsModal from "./modals/UploadSimCardsModal";
import { SIM_TYPES } from "./constants";

export default {
    name: "SimCardsIndex",

    components: {
        UploadSimCardsModal,
    },

    data () {
        return {
            data: {},
            loading: false,
            simTypes: SIM_TYPES,
        }
    },

    created() {
        this.$root.$on('sim-cards.load', this.loadData);

        this.loadData();
    },

    beforeDestroy() {
        this.$root.$off('sim-cards.load', this.loadData);
    },

    methods: {
        loadData() {
            this.loading = true;

            axios.get('/sim-cards')
                .then(({data}) => {
                    this.data = data;
                    this.loading = false;
                });
        }
    }
}
</script>

<style lang="scss">
    .internet-packages {
        &__actions-list {
            width: 100%;
            display: flex;
            justify-content: flex-end;
            list-style: none;
        }
    }
</style>
