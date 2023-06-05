<template>
    <div id="internet-packages-from-api">
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
                            <h5>Packages</h5>
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
                                Packages not found
                            </div>
                        </template>

                        <template v-if="data.data.length">
                            <table class="table table-striped table-sm">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Package ID</th>
                                    <th scope="col">Price</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="(internetPackage, key) in data.data">
                                    <th scope="row">
                                        {{(key + 1) + (data.per_page * (data.current_page - 1))}}
                                    </th>
                                    <td>{{ internetPackage.nameValue }}</td>
                                    <td>{{ internetPackage.package_id }}</td>
                                    <td>{{ internetPackage.priceValue }} $</td>
                                </tr>
                                </tbody>
                            </table>
                        </template>
                    </div>
                </div>

                <pagination
                    :data="data"
                    load-event="inventory-internet-packages.load"
                />
            </div>
        </template>
    </div>
</template>

<script>
import Pagination from "../../../../components/admin/pagination";

export default {
    name: "InternetPackagesFromApiIndex",

    components: {Pagination},

    data () {
        return {
            data: [],
            loading: false,
        }
    },

    created() {
        this.$root.$on('inventory-internet-packages.load', this.loadData);

        this.loadData();
    },

    beforeDestroy() {
        this.$root.$off('inventory-internet-packages.load', this.loadData);
    },

    methods: {
        loadData(data) {
            this.loading = true;
            let params = {};

            if (data && data.params && data.params.page) {
                params.page = data.params.page
            }

            axios.get(`/internet-packages-from-api`, {
                params
            })
                .then(({data}) => {
                    this.data = this.parseData(data);
                    this.loading = false;
                });
        },

        openUploadModal() {
            this.$root.$emit('modal::show::UploadPackagesModal');
        },

        parseData(data) {
            data.data = data.data.map(dataItem => {
                dataItem.nameValue = this.findNameByLang(dataItem.name, 'en');
                dataItem.priceValue = this.findPriceByCurrencyCode(dataItem.priceInfo, '840');

                return dataItem;
            });

            return data;
        },

        findNameByLang(data, lang) {
            let name = '';

            data.forEach(dataItem => {
               if (dataItem.langInfo.language === lang) {
                   name = dataItem.value;
               }
            });

            return name;
        },

        findPriceByCurrencyCode(data, code) {
            let price = '';

            data.forEach(dataItem => {
                if (dataItem.currencyCode === code) {
                    price = dataItem.price / 100;
                }
            });

            return price;
        }
    }
}
</script>

<style scoped>

</style>
