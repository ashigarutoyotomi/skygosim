<template>
    <div class="woocommerce-MyAccount-content">
        <h5>Internet packages</h5>

        <template v-if="!user.internet_packages.length">
            <div class="woocommerce-message woocommerce-message--info woocommerce-Message woocommerce-Message--info woocommerce-info">
                No internet packages.
            </div>
        </template>

        <template v-if="user.internet_packages.length">
            <table class="woocommerce-orders-table woocommerce-MyAccount-orders shop_table shop_table_responsive my_account_orders account-orders-table">
                <thead>
                    <tr>
                        <th class="woocommerce-orders-table__header woocommerce-orders-table__header-order-number">
                            <span class="nobr">Area</span>
                        </th>
                        <th class="woocommerce-orders-table__header woocommerce-orders-table__header-order-date">
                            <span class="nobr">Data</span>
                        </th>
                        <th class="woocommerce-orders-table__header woocommerce-orders-table__header-order-status">
                            <span class="nobr">ICCID</span>
                        </th>
<!--                        <th class="woocommerce-orders-table__header woocommerce-orders-table__header-order-total">-->
<!--                            <span class="nobr">Price</span>-->
<!--                        </th>-->
                        <th class="woocommerce-orders-table__header woocommerce-orders-table__header-order-total">
                            <span class="nobr">Expiration Date</span>
                        </th>
                    </tr>
                </thead>

                <tbody>
                    <tr v-for="internet in user.internet_packages"
                        class="woocommerce-orders-table__row woocommerce-orders-table__row--status-processing order"
                    >
                        <td class="woocommerce-orders-table__cell woocommerce-orders-table__cell-order-number" data-title="Order">
                            {{internet.internet_package.area_eng}}
                        </td>
                        <td class="woocommerce-orders-table__cell woocommerce-orders-table__cell-order-date" data-title="Date">
                            {{internet.internet_package.data_eng}}
                        </td>
                        <td class="woocommerce-orders-table__cell woocommerce-orders-table__cell-order-status" data-title="Status">
                            {{internet.sim.iccid}}
                        </td>
<!--                        <td class="woocommerce-orders-table__cell woocommerce-orders-table__cell-order-total" data-title="Total">-->
<!--                            <span class="woocommerce-Price-amount amount">-->
<!--                                <span class="woocommerce-Price-currencySymbol">$</span>{{ internet.bought_price }}</span>-->
<!--                        </td>-->
                        <td class="woocommerce-orders-table__cell woocommerce-orders-table__cell-order-status" data-title="Status">
                            {{ getExpirationDate(internet.created_at) }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </template>

    </div>
</template>

<script>
    import moment from "moment";

    export default {
        name: "ProfileInternetPackages",

        props: ['user'],

        methods: {
            getExpirationDate(date) {
               return moment(date).add(180, 'days').format('MM/DD/YYYY');
            }
        }
    }
</script>

<style scoped>

</style>
