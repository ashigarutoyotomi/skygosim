<template>
    <div id="purchases-internet-packages">
        <template v-if="loading">
            <div class="row">
                <div class="spinner-border mx-auto" style="width: 3rem; height: 3rem;" role="status">
                    <span class="sr-only"></span>
                </div>
            </div>
        </template>

        <template v-if="!loading">
            <purchases-internet-packages-filters
                v-if="filters.show"
                @applied="applyFilters"
                @close="closeFilters"
            />

            <div class="index bg-white shadow-sm rounded-3 py-4 px-4">
                <div class="row">
                    <div class="col-4">
                        <div class="mb-4">
                            <h5>Packages</h5>
                        </div>
                    </div>
                    <div class="col-8">
                        <ul class="index__actions-list">
                            <li>
                                <a
                                    class="btn btn-sm btn-light"
                                    href="/purchases/internet-packages/download-excel"
                                >
                                    <i class="bi bi-file-earmark-arrow-down"></i>
                                </a>
                            </li>
                            <li class="ml-2">
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
                        <div class="mb-3">
                            <input
                                type="text"
                                class="form-control form-control-sm"
                                id="search"
                                placeholder="Search: name, iccid, package id, price"
                                v-model="search.keywords"
                                @input="debounceQuerySearch"
                            >
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <template v-if="!data.data.length">
                            <div class="text-muted mb-4">
                                Purchased internet packages not found
                            </div>
                        </template>

                        <template v-if="data.data.length">
                            <table class="table table-striped table-sm">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Dealer name</th>
                                    <th scope="col">ICCID</th>
                                    <th scope="col">Package ID</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Date</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="(internetPackage, key) in data.data">
                                    <th scope="row">
                                        {{(key + 1) + (data.per_page * (data.current_page - 1))}}
                                    </th>
                                    <td>
                                        <template v-if="internetPackage.sim.dealer">
                                            {{ internetPackage.sim.dealer.first_name }} {{ internetPackage.sim.dealer.last_name }}
                                        </template>

                                        <template v-else>
                                            No dealer
                                        </template>
                                    </td>
                                    <td>{{ internetPackage.sim.iccid }}</td>
                                    <td>{{ internetPackage.internet_package ? internetPackage.internet_package.package_id : 'Not found' }}</td>
                                    <td>{{ internetPackage.bought_price }} $</td>
                                    <td>{{ moment(internetPackage.created_at).format('DD/MM/YYYY HH:mm') }}</td>
                                    <td>
                                        <button
                                            type="button"
                                            class="btn btn-light btn-sm"
                                            @click="show(internetPackage.id)"
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

                <pagination
                    :data="data"
                    load-event="purchased-internet-packages.load"
                />
            </div>
        </template>
    </div>
</template>

<script>
    import Pagination from "../../../../components/admin/pagination";
    import moment from "moment";
    import PurchasesInternetPackagesFilters from "./modules/Filters";
    import _ from 'lodash';

    export default {
        name: "PurchasesInternetPackages",

        components: {
            PurchasesInternetPackagesFilters,
            Pagination
        },

        data () {
            return {
                data: [],
                loading: false,
                filters: {
                    show: false
                },
                search: {
                    keywords: ''
                },
            }
        },

        created() {
            this.$root.$on('purchased-internet-packages.load', this.loadData);

            this.loadData();
        },

        beforeDestroy() {
            this.$root.$off('purchased-internet-packages.load', this.loadData);
        },

        methods: {
            loadData(data) {
                this.loading = true;
                let params = {};

                if (data && data.params && data.params.page) {
                    params.page = data.params.page
                }

                params.keywords = this.search.keywords;
                params.filters = this.filters;

                axios.get(`/purchases/internet-packages`, {
                    params
                })
                    .then(({data}) => {
                        this.data = data;
                        this.loading = false;
                    });
            },

            show(id) {
                this.$router.push(`/purchases/internet-packages/${id}/show`);
            },

            moment(date) {
                return moment(date);
            },

            showFilters() {
                this.filters.show = true;
            },

            closeFilters() {
                this.filters.show = false;
            },

            /**
             * Поиск с задержкой
             */
            debounceQuerySearch: _.debounce(function() {
                this.loadData();
            }, 500),

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
        }
    }
</script>

<style scoped>

</style>
