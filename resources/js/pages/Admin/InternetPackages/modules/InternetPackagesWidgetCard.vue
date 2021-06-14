<template>
    <div class="dashboard-article-card bg-white shadow-sm rounded-3 py-3 px-3">
        <div class="dashboard-article-card__title">
            <h6 class="text-secondary">
                Internet packages
            </h6>
        </div>

        <div class="dashboard-article-card__body">
            <ul class="dashboard-article-card__info-list">
                <li>
                    <span class="text-secondary">
                        Purchased
                    </span>
                    <span>
                        {{ purchased }}
                    </span>
                </li>
                <li>
                    <span class="text-secondary">
                        Total purchased price
                    </span>
                    <span>
                        $ {{ totalPurchasedPrice }}
                    </span>
                </li>
                <li>
                    <span class="text-secondary">
                        In inventory
                    </span>
                    <span>
                        {{ inventoryCount }}
                    </span>
                </li>
            </ul>
        </div>

        <div class="dashboard-article-card__actions">
            <button
                type="submit"
                class="btn btn-light btn-sm"
                @click="$router.push({name: 'internet_packages_purchase'})"
            >
                Purchase new
            </button>
        </div>
    </div>
</template>

<script>
    export default {
        name: "InternetPackagesWidgetCard",

        data() {
            return {
                inventoryCount: 0,
                purchased: 0,
                totalPurchasedPrice: 0
            }
        },

        created() {
            this.loadData();
        },

        methods: {
            loadData() {
                axios.get('/internet-packages/widget/load-data')
                    .then(({data}) => {
                        if (data) {
                            this.inventoryCount = data.inventoryCount;
                            this.purchased = data.purchased;
                            this.totalPurchasedPrice = data.totalPurchasedPrice;
                        }
                    })
            },

            openPurchaseInternetPackagesModal() {
                this.$root.$emit('modal::show::' + 'PurchaseInternetPackagesModal');
            }
        }
    }
</script>

<style lang="scss">
    .dashboard-article-card {
        &__body {
            margin: 0 0 1rem 0;
        }

        &__info-list {
            list-style: none;
            padding: 0;
            margin: 0;

            li {
                border-bottom: 1px solid #ccc;
                display: flex;
                justify-content: space-between;
                padding: 0 .3rem;

                span {
                    font-size: .85rem;
                }
            }

            li:nth-child(2) {
                background: #eee;
            }
        }
    }
</style>
