<template>
    <div class="filters">
        <div class="filters-bg"
             @click="close"
        ></div>

        <div class="filters__container">
            <div class="filters__title mb-4">
                <h5>Filters</h5>
            </div>

            <div class="mb-4">
                <div class="mb-2">
                    <label for="datetime-from" class="form-label">Date from</label>
                    <date-picker
                        id="datetime-from"
                        mode="dateTime"
                        :popover="{visibility: 'click'}"
                        v-model="filters.date_from"
                    >
                        <template v-slot="{ inputValue, inputEvents }">
                            <input
                                class="form-control px-2 py-1 border rounded focus:outline-none focus:border-blue-300"
                                :value="inputValue"
                                v-on="inputEvents"
                            />
                        </template>
                    </date-picker>
                </div>

                <div class="mb-2">
                    <label for="datetime-to" class="form-label">Date to</label>
                    <date-picker
                        id="datetime-to"
                        mode="dateTime"
                        :popover="{visibility: 'click'}"
                        v-model="filters.date_to"
                    >
                        <template v-slot="{ inputValue, inputEvents }">
                            <input
                                class="form-control px-2 py-1 border rounded focus:outline-none focus:border-blue-300"
                                :value="inputValue"
                                v-on="inputEvents"
                            />
                        </template>
                    </date-picker>
                </div>
            </div>

            <div class="mb-4">
                <label for="dealer" class="form-label">Dealer</label>
                <v-select
                    id="dealer"
                    :options="dealers"
                    label="full_name"
                    :reduce="dealer => dealer.id"
                    v-model="filters.dealer_id"
                ></v-select>
            </div>

            <div class="filters__buttons">
                <button
                    type="button"
                    class="btn btn-light btn-sm"
                    @click="clearFilters"
                >
                    Clear
                </button>
                <button
                    type="button"
                    class="btn btn-success btn-sm"
                    @click="applyFilters"
                >
                    Save
                </button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "PurchasesInternetPackagesFilters",

        data() {
            return {
                filters: {
                    date_from: '',
                    date_to: '',
                    dealer_id: null,
                },
                dealers: [],
            }
        },

        created() {
            this.loadDealers();
        },

        methods: {
            close() {
                this.$emit('close');
            },

            applyFilters() {
                Vue.nextTick(() => {
                    this.$emit('applied', this.filters);
                });

                this.close();
            },

            clearFilters() {
                Vue.set(this.filters, 'date_from', null);
                Vue.set(this.filters, 'date_to', null);
                Vue.set(this.filters, 'dealer_id', null);

                this.applyFilters();
            },

            loadDealers() {
                axios.get('/dealers/all')
                    .then(({data}) => {
                        this.dealers = data
                    });
            }
        }
    }
</script>

<style lang="scss">
    .filters {
        position: fixed;
        width: 100%;
        height: 100vh;
        z-index: 100;
        left: 0;
        top: 0;
        display: flex;
        justify-content: flex-end;

        &-bg {
            background: rgba(0,0,0,0.1);
            width: 100%;
            height: 100%;
            position: absolute;
            top: 0;
            left: 0;
        }

        &__container {
            position: relative;
            z-index: 1;
            background: #fff;
            height: 100%;
            width: 400px;
            padding: .7rem 1.5rem;
        }

        &__buttons {
            display: flex;

            button {
                margin-right: .5rem;
            }
        }
    }
</style>
