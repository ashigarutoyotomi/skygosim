<template>
    <div class="woocommerce-MyAccount-content">
        <h5>Orders</h5>

        <template v-if="!user.orders.length">
            <div class="woocommerce-message woocommerce-message--info woocommerce-Message woocommerce-Message--info woocommerce-info">
                No orders yet.
            </div>
        </template>

        <template v-if="user.orders.length">
            <table class="woocommerce-orders-table woocommerce-MyAccount-orders shop_table shop_table_responsive my_account_orders account-orders-table">
                <thead>
                    <tr>
                        <th class="woocommerce-orders-table__header woocommerce-orders-table__header-order-number">
                            <span class="nobr">Order ID</span>
                        </th>
                        <th class="woocommerce-orders-table__header woocommerce-orders-table__header-order-date">
                            <span class="nobr">ICCID</span>
                        </th>
                        <th class="woocommerce-orders-table__header woocommerce-orders-table__header-order-status">
                            <span class="nobr">Sim type</span>
                        </th>
                        <th class="woocommerce-orders-table__header woocommerce-orders-table__header-order-total">
                            <span class="nobr">Order status</span>
                        </th>
                    </tr>
                </thead>

                <tbody>
                <tr v-for="order in user.orders"
                    class="woocommerce-orders-table__row woocommerce-orders-table__row--status-processing order"
                >
                    <td class="woocommerce-orders-table__cell woocommerce-orders-table__cell-order-number" data-title="Order">
                        {{order.key}}
                    </td>
                    <td class="woocommerce-orders-table__cell woocommerce-orders-table__cell-order-date" data-title="Date">
                        {{order.sim ? order.sim.iccid : 'Not selected'}}
                    </td>
                    <td class="woocommerce-orders-table__cell woocommerce-orders-table__cell-order-status" data-title="Status">
                        {{simTypes[order.sim_type].label}}
                    </td>
                    <td class="woocommerce-orders-table__cell woocommerce-orders-table__cell-order-total" data-title="Total">
                        {{orderStatuses[order.status].label}}
                    </td>
                </tr>
                </tbody>
            </table>
        </template>

    </div>
</template>

<script>
    import {SIM_TYPES} from "../../Admin/Inventory/Sims/constants";
    import {STATUS_TYPES} from "../../Admin/SimOrders/constants";

    export default {
        name: "Orders",

        props: ['user'],

        data() {
            return {
                simTypes: SIM_TYPES,
                orderStatuses: STATUS_TYPES,
            }
        }
    }
</script>

<style scoped>

</style>
